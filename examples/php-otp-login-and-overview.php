<?php

declare(strict_types=1);

/**
 * End-to-end walkthrough: log in with a one-time code, then read the account.
 *
 *     php examples/php-otp-login-and-overview.php you@example.com
 *
 * Only read-only endpoints are called, so it is safe to run against a real account.
 */

require __DIR__ . '/../sdk/php/autoload.php';

use Tino\UserApi\Exception\TinoApiException;
use Tino\UserApi\Exception\TinoNotFoundException;
use Tino\UserApi\TinoClient;

$sessionFile = getenv('HOME') . '/.tino-sdk-session.json';

$email = $argv[1] ?? null;
if ($email === null) {
    fwrite(STDERR, "usage: {$argv[0]} <email>\n");
    exit(1);
}

/** A refresh rotates both tokens, so always write the pair back together. */
$save = static function (string $token, string $refresh) use ($sessionFile): void {
    file_put_contents($sessionFile, json_encode(['token' => $token, 'refresh' => $refresh]));
    chmod($sessionFile, 0600);
};

$stored = is_file($sessionFile)
    ? (json_decode((string) file_get_contents($sessionFile), true) ?: [])
    : [];

$client = new TinoClient([
    'token' => $stored['token'] ?? null,
    'refreshToken' => $stored['refresh'] ?? null,
    'onTokenRefresh' => $save,
]);

try {
    if ($client->token === null) {
        $sent = $client->requestLoginOtp($email);
        echo "A one-time code was sent via " . ($sent['via'] ?? 'email') . ".\n";
        echo 'Code: ';
        $code = trim((string) fgets(STDIN));
        $client->verifyLoginOtp($email, $code);
        $save($client->token, $client->refreshToken);
        echo "Signed in.\n\n";
    }

    $account = $client->account->getDetails()['client'];
    printf("Account   %s (id %s)\n", $account['email'], $account['id']);

    $total = $client->account->getSummary()['total'];
    printf(
        "Totals    %d services · %d domains · %d invoices · %d tickets\n",
        $total['services'], $total['domains'], $total['invoices'], $total['tickets']
    );

    $balance = $client->billing->getBalance()['details'];
    printf("Balance   %s %s (credit %s)\n\n", $balance['acc_balance'], $balance['currency'], $balance['acc_credit']);

    echo "Active services\n";
    foreach ($client->services->list(['filter' => ['hide_cancelled' => 1]])['services'] ?? [] as $service) {
        printf(
            "  %8s  %-40s %-10s next due %s\n",
            $service['id'], $service['domain'], $service['status'], $service['next_due']
        );
    }

    echo "\nDomains\n";
    foreach ($client->domains->list()['domains'] ?? [] as $domain) {
        printf("  %8s  %-40s expires %s\n", $domain['id'], $domain['name'], $domain['expires']);
    }

    echo "\nUnpaid invoices\n";
    foreach ($client->billing->listInvoicesDue()['invoices_due'] ?? [] as $invoice) {
        printf("  %8s  %14s  due %s\n", $invoice['id'], $invoice['total'], $invoice['duedate']);
    }

    echo "\nDNS zones\n";
    foreach ($client->dns->listZonesAll()['zones'] ?? [] as $zone) {
        try {
            $records = $client->dns->getZone($zone['service_id'], $zone['domain_id'])['records'];
            printf("  %-40s %d record(s)\n", $zone['name'], count($records));
        } catch (TinoNotFoundException $e) {
            printf("  %-40s (not readable)\n", $zone['name']);
        }
    }
} catch (TinoApiException $e) {
    fwrite(STDERR, "API error: {$e}\n");
    exit(1);
}
