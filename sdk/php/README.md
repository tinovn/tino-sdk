# Tino UserAPI — PHP SDK

Zero-dependency client for `https://api.tino.vn`. PHP 7.4+, PSR-4, `ext-curl` only.

```bash
composer require tinovn/tino-sdk
```

Not on Packagist yet? Point Composer at the repository:

```json
{
  "repositories": [
    { "type": "vcs", "url": "https://github.com/tinovn/tino-sdk" }
  ],
  "require": { "tinovn/tino-sdk": "dev-main" }
}
```

Without Composer, the bundled autoloader is enough:

```php
require '/path/to/tino-sdk/sdk/php/autoload.php';
```

## Log in

```php
use Tino\UserApi\TinoClient;

$client = new TinoClient();

$sent = $client->requestLoginOtp('you@example.com');
echo "Code sent via {$sent['via']}\n";        // 'zalo' or 'email'

$client->verifyLoginOtp('you@example.com', $code);
echo $client->account->getDetails()['client']['email'];
```

Password login and resuming a stored session:

```php
$client->login('you@example.com', $password, true);

$client = new TinoClient(['token' => $storedToken, 'refreshToken' => $storedRefresh]);
```

## Persist rotating tokens

A refresh invalidates both the old refresh token **and** the old access token, so store
whatever the callback hands you:

```php
$client = new TinoClient([
    'token' => $token,
    'refreshToken' => $refresh,
    'onTokenRefresh' => function (string $token, string $refresh): void {
        saveCredentials($token, $refresh);
    },
]);
```

When a call fails with `unauthorized` / `token_expired`, the client refreshes once and
replays the request. If the refresh also fails it throws `TinoAuthException`.

## Call the API

Every resource group is a lazily-created property; method names are `camelCase`.

```php
$client->billing->getBalance();
$client->billing->listInvoices(['page' => 0, 'perpage' => 25, 'orderby' => 'date|DESC']);
$client->domains->list();
$client->domains->get(200001);
$client->services->list(['filter' => ['hide_cancelled' => 1]]);
$client->dns->createRecord($serviceId, $zoneId, ['name' => 'www', 'type' => 'A', 'content' => '203.0.113.10']);
$client->support->createTicket(['dept_id' => 2, 'subject' => 'Hello', 'body' => '…']);
$client->vms->reboot($serviceId, $vmId);
```

Signature rules:

* **Path parameters come first**, in URL order, percent-encoded for you.
* **Read operations** end with an optional `array $query`.
* **Write operations** take `(…$pathParams, array $body = [], array $query = [])`.
* **Responses are associative arrays** — the decoded JSON, unmodified.

## Handle errors

```php
use Tino\UserApi\Exception\{TinoApiException, TinoAuthException,
    TinoNotFoundException, TinoValidationException, TinoTransportException};

try {
    $client->domains->get(999999);
} catch (TinoNotFoundException $e) {
    // unknown route or record
} catch (TinoAuthException $e) {
    // re-authenticate
} catch (TinoValidationException $e) {
    print_r($e->errors);                 // ['Please enter taxid']
} catch (TinoApiException $e) {
    printf("%d %s %s\n", $e->status, $e->path, implode('; ', $e->errors));
} catch (TinoTransportException $e) {
    // never reached the server
}
```

The API reports most failures with HTTP 200 and an `error` key in the body, so throwing
on the body — not the status — is the whole point of this layer.

## Binary payloads

```php
$response = $client->request('GET', '/clientarea/downloadprofile', ['raw' => true]);
file_put_contents('profile.pdf', $response['text']);   // raw bytes
```

## Escape hatch

```php
$client->request('GET', '/some/new/endpoint', ['query' => ['page' => 0]]);
$client->request('POST', '/some/new/endpoint', ['body' => ['field' => 'value']]);
```

## Laravel

Bind the client as a singleton and let the session carry the tokens:

```php
// AppServiceProvider::register()
$this->app->singleton(TinoClient::class, fn () => new TinoClient([
    'token' => session('tino.token'),
    'refreshToken' => session('tino.refresh'),
    'defaultHeaders' => [
        'X-Real-IP' => request()->ip(),
        'X-Forwarded-For' => request()->ip(),
    ],
    'onTokenRefresh' => fn ($token, $refresh) => session([
        'tino.token' => $token, 'tino.refresh' => $refresh,
    ]),
]));
```

## Configuration

| Option | Default | Purpose |
| --- | --- | --- |
| `baseUrl` | `https://api.tino.vn` | Point at a staging deployment |
| `token`, `refreshToken` | `null` | Resume a stored session |
| `timeout` | `60` | Seconds per request |
| `autoRefresh` | `true` | Refresh once and retry on an auth error |
| `userAgent` | `tino-sdk-php/<version>` | Identify your integration |
| `defaultHeaders` | `[]` | Forward `X-Real-IP` etc. when proxying |
| `onTokenRefresh` | `null` | `callable(string $token, string $refresh)` persistence hook |

## Reference

* [Getting started](../../docs/getting-started.md)
* [API conventions](../../docs/conventions.md)
* [Endpoint reference](../../docs/api-contract/README.md)
