<?php

declare(strict_types=1);

namespace Tino\UserApi\Tests;

use PHPUnit\Framework\TestCase;
use Tino\UserApi\Exception\TinoApiException;
use Tino\UserApi\Exception\TinoAuthException;
use Tino\UserApi\Exception\TinoNotFoundException;
use Tino\UserApi\Exception\TinoValidationException;
use Tino\UserApi\Http;
use Tino\UserApi\TinoClient;

/**
 * Offline tests for the parts of the SDK that encode the API's quirks.
 *
 * The transport is injected, so the tests assert on what the client would send
 * and on how it interprets what comes back — no network access.
 */
final class TinoClientContractTest extends TestCase
{
    /** @var list<array{method:string,url:string,headers:array,body:mixed}> */
    private $calls = [];

    /**
     * Build a transport that replies with the given [status, payload] pairs in order.
     *
     * @param array<int,array{0:int,1:mixed}> $responses
     */
    private function transport(array $responses): callable
    {
        $this->calls = [];

        return function (string $method, string $url, array $headers, $body, int $timeout) use (&$responses): array {
            $this->calls[] = compact('method', 'url', 'headers', 'body');
            [$status, $payload] = array_shift($responses);
            $text = json_encode($payload);

            return ['status' => $status, 'headers' => [], 'text' => $text, 'json' => $payload];
        };
    }

    /** @param array<int,array{0:int,1:mixed}> $responses */
    private function client(array $responses, array $options = []): TinoClient
    {
        return new TinoClient($options + ['transport' => $this->transport($responses)]);
    }

    // ----------------------------------------------------------- query encoding

    public function testEncodeQueryFollowsApiConventions(): void
    {
        self::assertSame('page=0', Http::encodeQuery(['page' => 0]));
        self::assertSame('perpage=25', Http::encodeQuery(['page' => null, 'perpage' => 25]));
        self::assertSame('active=1&hidden=0', Http::encodeQuery(['active' => true, 'hidden' => false]));
        self::assertSame(
            'filter%5Bhide_cancelled%5D=1',
            Http::encodeQuery(['filter' => ['hide_cancelled' => 1]])
        );
        self::assertSame(
            'tlds%5B%5D=.com&tlds%5B%5D=.vn',
            Http::encodeQuery(['tlds' => ['.com', '.vn']])
        );
    }

    public function testPathParametersArePercentEncoded(): void
    {
        $client = $this->client([[200, []]]);
        $client->location->listCitiesByStateName('Thành phố Hồ Chí Minh');
        self::assertStringContainsString('Th%C3%A0nh%20ph%E1%BB%91', $this->calls[0]['url']);
    }

    // --------------------------------------------------------- error detection

    public function testErrorInBodyOfHttp200StillThrows(): void
    {
        $this->expectException(TinoAuthException::class);
        $this->client([[200, ['error' => ['unauthorized']]]], ['token' => 't'])
            ->account->getDetails();
    }

    public function testUnknownRouteThrowsNotFound(): void
    {
        $this->expectException(TinoNotFoundException::class);
        $this->client([[404, ['error' => ['invalid method']]]], ['token' => 't'])
            ->services->listOsTemplates(1);
    }

    public function testStringErrorNextToSuccessFlag(): void
    {
        try {
            $this->client([[200, ['success' => false, 'error' => 'query is required']]], ['token' => 't'])
                ->domains->suggest(['query' => '']);
            self::fail('expected TinoValidationException');
        } catch (TinoValidationException $e) {
            self::assertSame(['query is required'], $e->errors);
        }
    }

    public function testBareArrayErrorThrows(): void
    {
        $this->expectException(TinoNotFoundException::class);
        $this->client([[200, ['file_not_found']]], ['token' => 't'])
            ->support->getAttachment('1');
    }

    public function testSuccessfulBodyIsReturnedUntouched(): void
    {
        $payload = ['success' => true, 'invoices' => [['id' => '1', 'total' => '10.00']]];
        $result = $this->client([[200, $payload]], ['token' => 't'])->billing->listInvoices();
        self::assertSame($payload, $result);
    }

    // ------------------------------------------------------- token management

    public function testAuthErrorTriggersOneRefreshThenReplays(): void
    {
        $saved = [];
        $client = $this->client(
            [
                [200, ['error' => ['token_expired']]],
                [200, ['token' => 'new-access', 'refresh' => 'new-refresh']],
                [200, ['details' => ['acc_balance' => 1]]],
            ],
            [
                'token' => 'old',
                'refreshToken' => 'old-refresh',
                'onTokenRefresh' => function (string $t, string $r) use (&$saved): void {
                    $saved = ['token' => $t, 'refresh' => $r];
                },
            ]
        );

        self::assertSame(['details' => ['acc_balance' => 1]], $client->billing->getBalance());
        self::assertSame('new-access', $client->token);
        self::assertSame(['token' => 'new-access', 'refresh' => 'new-refresh'], $saved);
        self::assertStringEndsWith('/token', $this->calls[1]['url']);
        self::assertSame('Bearer new-access', $this->calls[2]['headers']['Authorization']);
    }

    public function testDeadRefreshTokenIsNotRetriedForever(): void
    {
        $this->expectException(TinoApiException::class);
        $this->client(
            [
                [200, ['error' => ['token_expired']]],
                [200, ['error' => ['refresh_token_invalid']]],
            ],
            ['token' => 'old', 'refreshToken' => 'dead']
        )->billing->getBalance();
    }

    public function testVerifyLoginOtpStoresBothTokens(): void
    {
        $client = $this->client([[200, ['token' => 'a', 'refresh' => 'b', 'client' => ['id' => '1']]]]);
        $client->verifyLoginOtp('user@example.com', '123456');
        self::assertSame('a', $client->token);
        self::assertSame('b', $client->refreshToken);
    }

    public function testPublicEndpointsSendNoAuthorizationHeader(): void
    {
        $this->client([[200, []]], ['token' => 'secret'])->location->listCountries();
        self::assertArrayNotHasKey('Authorization', $this->calls[0]['headers']);
    }

    public function testProtectedEndpointsSendTheToken(): void
    {
        $this->client([[200, []]], ['token' => 'secret'])->account->getDetails();
        self::assertSame('Bearer secret', $this->calls[0]['headers']['Authorization']);
    }

    // --------------------------------------------------------- body handling

    public function testRequestBodyIsForwarded(): void
    {
        $this->client([[200, []]], ['token' => 't'])
            ->support->createTicket(['dept_id' => 2, 'subject' => 'Hi']);
        self::assertSame(['dept_id' => 2, 'subject' => 'Hi'], $this->calls[0]['body']);
    }

    public function testNoBodyIsSentWhenNoneSupplied(): void
    {
        $this->client([[200, []]], ['token' => 't'])->services->manualRenew(1);
        self::assertNull($this->calls[0]['body']);
    }

    public function testUnknownResourceGroupIsRejected(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->client([])->nosuchgroup;
    }
}
