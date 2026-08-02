<?php

declare(strict_types=1);

namespace Tino\UserApi;

use Tino\UserApi\Exception\TinoApiException;
use Tino\UserApi\Exception\TinoAuthException;
use Tino\UserApi\Exception\TinoNotFoundException;
use Tino\UserApi\Exception\TinoRateLimitException;
use Tino\UserApi\Exception\TinoValidationException;
use Tino\UserApi\Resources\ResourceRegistry;

/**
 * Entry point for every Tino UserAPI call.
 *
 * `$client->domains->list()`, `$client->billing->getBalance()`, and so on — one
 * property per resource group, mirroring spec/tino-userapi-catalog.json.
 *
 * The API answers most failures with HTTP 200 plus an `error` key, so this client
 * inspects the body, not just the status code, and throws a typed exception.
 *
 * @property-read Resources\Account      $account
 * @property-read Resources\Affiliate    $affiliate
 * @property-read Resources\Auth         $auth
 * @property-read Resources\Billing      $billing
 * @property-read Resources\Cart         $cart
 * @property-read Resources\Certificates $certificates
 * @property-read Resources\Cpanel       $cpanel
 * @property-read Resources\Dns          $dns
 * @property-read Resources\Domains      $domains
 * @property-read Resources\Ekyc         $ekyc
 * @property-read Resources\Languages    $languages
 * @property-read Resources\Location     $location
 * @property-read Resources\Security     $security
 * @property-read Resources\Services     $services
 * @property-read Resources\Support      $support
 * @property-read Resources\Tinosite     $tinosite
 * @property-read Resources\Vms          $vms
 */
class TinoClient
{
    public const DEFAULT_BASE_URL = 'https://api.tino.vn';
    public const SDK_VERSION = '1.0.0';

    /** Error strings the API uses to signal an authentication problem. */
    private const AUTH_ERROR_CODES = ['unauthorized', 'token_expired', 'invalid_token', 'notloggedin'];

    /** @var string */
    public $baseUrl;

    /** @var string|null */
    public $token;

    /** @var string|null */
    public $refreshToken;

    /** @var int */
    private $timeout;

    /** @var bool */
    private $autoRefresh;

    /** @var string */
    private $userAgent;

    /** @var array<string,string> */
    private $defaultHeaders;

    /** @var callable|null */
    private $onTokenRefresh;

    /**
     * Overrides the built-in cURL transport.
     *
     * Signature: fn(string $method, string $url, array $headers, mixed $body, int $timeout)
     *   => array{status:int,headers:array<string,string>,text:string,json:mixed}
     *
     * Use it to plug in Guzzle/PSR-18, add retries, or stub the network in tests.
     *
     * @var callable|null
     */
    private $transport;

    /** @var array<string,Resources\Resource> */
    private $resources = [];

    /**
     * @param array{
     *     baseUrl?: string,
     *     token?: string|null,
     *     refreshToken?: string|null,
     *     timeout?: int,
     *     autoRefresh?: bool,
     *     userAgent?: string,
     *     defaultHeaders?: array<string,string>,
     *     onTokenRefresh?: callable|null,
     *     transport?: callable|null
     * } $options
     */
    public function __construct(array $options = [])
    {
        $this->baseUrl = rtrim($options['baseUrl'] ?? self::DEFAULT_BASE_URL, '/');
        $this->token = $options['token'] ?? null;
        $this->refreshToken = $options['refreshToken'] ?? null;
        $this->timeout = $options['timeout'] ?? 60;
        $this->autoRefresh = $options['autoRefresh'] ?? true;
        $this->userAgent = $options['userAgent'] ?? 'tino-sdk-php/' . self::SDK_VERSION;
        $this->defaultHeaders = $options['defaultHeaders'] ?? [];
        $this->onTokenRefresh = $options['onTokenRefresh'] ?? null;
        $this->transport = $options['transport'] ?? null;
    }

    /** Lazily instantiate the resource group behind `$client->domains` and friends. */
    public function __get(string $name)
    {
        if (isset($this->resources[$name])) {
            return $this->resources[$name];
        }
        $classes = ResourceRegistry::CLASSES;
        if (!isset($classes[$name])) {
            throw new \InvalidArgumentException("Unknown resource group: {$name}");
        }

        return $this->resources[$name] = new $classes[$name]($this);
    }

    // ----------------------------------------------------------------- auth

    /** Store the credentials returned by a login call. */
    public function setTokens(?string $token, ?string $refreshToken = null): void
    {
        $this->token = $token;
        if ($refreshToken !== null) {
            $this->refreshToken = $refreshToken;
        }
        if ($this->onTokenRefresh !== null && $token !== null) {
            ($this->onTokenRefresh)($token, $this->refreshToken ?? '');
        }
    }

    /**
     * Password login. Stores the returned tokens on success.
     *
     * @return mixed
     */
    public function login(string $username, string $password, bool $remember = false)
    {
        $result = $this->request('POST', '/login', [
            'body' => ['username' => $username, 'password' => $password, 'remember' => $remember],
            'authenticated' => false,
        ]);
        $this->setTokens($result['token'] ?? null, $result['refresh'] ?? null);

        return $result;
    }

    /**
     * Ask Tino to send a one-time login code.
     *
     * The response reports the delivery channel in `via` (`zalo` or `email`). For
     * privacy the API answers the same way whether or not the account exists.
     *
     * @return mixed
     */
    public function requestLoginOtp(string $email)
    {
        return $this->request('POST', '/login-otp', ['body' => ['email' => $email], 'authenticated' => false]);
    }

    /**
     * Exchange a one-time code for tokens. Stores them on success.
     *
     * @return mixed
     */
    public function verifyLoginOtp(string $email, string $otp)
    {
        $result = $this->request('POST', '/verify-login-otp', [
            'body' => ['email' => $email, 'otp' => $otp],
            'authenticated' => false,
        ]);
        $this->setTokens($result['token'] ?? null, $result['refresh'] ?? null);

        return $result;
    }

    /** Exchange the refresh token for a new access token. */
    public function refreshAccessToken(): ?string
    {
        if ($this->refreshToken === null || $this->refreshToken === '') {
            return null;
        }
        $result = $this->request('POST', '/token', [
            'body' => ['refresh_token' => $this->refreshToken],
            'authenticated' => false,
            'allowRefresh' => false,
        ]);
        $token = is_array($result) ? ($result['token'] ?? null) : null;
        if ($token !== null) {
            $this->setTokens($token, $result['refresh'] ?? $this->refreshToken);
        }

        return $token;
    }

    /**
     * Invalidate the access token server-side and forget it locally.
     *
     * @return mixed
     */
    public function logout()
    {
        try {
            return $this->request('POST', '/logout');
        } finally {
            $this->token = null;
        }
    }

    // -------------------------------------------------------------- request

    /**
     * Send one API call and return the decoded body.
     *
     * Pass `'raw' => true` to receive the full response array instead — useful for
     * endpoints that answer with a PDF or another non-JSON payload.
     *
     * @param array{
     *     query?: array<string,mixed>,
     *     body?: mixed,
     *     authenticated?: bool,
     *     allowRefresh?: bool,
     *     raw?: bool
     * } $options
     *
     * @return mixed
     */
    public function request(string $method, string $path, array $options = [])
    {
        $query = $options['query'] ?? [];
        $body = $options['body'] ?? null;
        $authenticated = $options['authenticated'] ?? true;
        $allowRefresh = $options['allowRefresh'] ?? true;
        $raw = $options['raw'] ?? false;

        $headers = array_merge(
            ['Accept' => 'application/json', 'User-Agent' => $this->userAgent],
            $this->defaultHeaders
        );
        if ($authenticated && $this->token !== null && $this->token !== '') {
            $headers['Authorization'] = 'Bearer ' . $this->token;
        }

        $url = Http::buildUrl($this->baseUrl, $path, $query);
        $send = $this->transport ?? [Http::class, 'send'];
        $response = $send($method, $url, $headers, $body, $this->timeout);

        $errors = self::extractErrors($response['json']);
        $isAuthError = $response['status'] === 401 || array_intersect($errors, self::AUTH_ERROR_CODES) !== [];

        if ($isAuthError && $allowRefresh && $this->autoRefresh && $this->refreshToken) {
            if ($this->refreshAccessToken() !== null) {
                $retry = $options;
                $retry['allowRefresh'] = false;

                return $this->request($method, $path, $retry);
            }
        }

        if ($errors !== [] || $response['status'] >= 400) {
            self::fail($response, $errors, $method, $path);
        }

        if ($raw) {
            return $response;
        }

        return $response['json'] ?? $response['text'];
    }

    // --------------------------------------------------------------- errors

    /**
     * Pull the error strings out of a response body, whatever shape it uses.
     *
     * Observed shapes: `{"error":["unauthorized"]}`, `{"error":"query is required"}`,
     * `{"success":false,"error":"..."}` and bare `["file_not_found"]`.
     *
     * @param mixed $body
     *
     * @return list<string>
     */
    private static function extractErrors($body): array
    {
        $raw = null;
        if (is_array($body)) {
            $isList = $body !== [] && array_keys($body) === range(0, count($body) - 1);
            if ($isList && count(array_filter($body, 'is_string')) === count($body)) {
                $raw = $body;
            } else {
                $raw = $body['error'] ?? $body['errors'] ?? null;
            }
        }
        if ($raw === null) {
            return [];
        }
        if (is_string($raw)) {
            return [$raw];
        }
        if (is_array($raw)) {
            return array_values(array_map('strval', $raw));
        }

        return [(string) $raw];
    }

    /**
     * @param array{status:int,text:string,json:mixed} $response
     * @param list<string>                             $errors
     */
    private static function fail(array $response, array $errors, string $method, string $path): void
    {
        $message = $errors !== []
            ? implode('; ', $errors)
            : (substr($response['text'], 0, 200) ?: 'HTTP ' . $response['status']);
        $lowered = strtolower(implode(' ', $errors));
        $args = [$message, $response['status'], $errors, $method, $path, $response['json']];

        if ($response['status'] === 401 || array_intersect($errors, self::AUTH_ERROR_CODES) !== []) {
            throw new TinoAuthException(...$args);
        }
        if ($response['status'] === 404 || strpos($lowered, 'invalid method') !== false || strpos($lowered, 'not_found') !== false) {
            throw new TinoNotFoundException(...$args);
        }
        if ($response['status'] === 429 || strpos($lowered, 'rate limit') !== false) {
            throw new TinoRateLimitException(...$args);
        }
        if (in_array($response['status'], [400, 422], true) || strpos($lowered, 'required') !== false || strpos($lowered, '_error') !== false) {
            throw new TinoValidationException(...$args);
        }

        throw new TinoApiException(...$args);
    }
}
