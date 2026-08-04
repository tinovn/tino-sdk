<?php

declare(strict_types=1);

/**
 * Phone number verification.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Phone number verification — 2 operations.
 */
class Phone extends Resource
{
    /**
     * Send a phone verification code
     *
     * POST /phone/otp — Bearer token required, from the API specification.
     *
     * Send a one-time code over Zalo ZNS to prove the account owner holds the SIM. Omit
     * phonenumber to verify the number already on the account. Accounts that have already
     * verified a number are refused with already_verified — change the number through PUT
     * /details first, which clears the previous verification.
     *
     * Note: Delivery is ZNS only — there is no email fallback, because the point is to prove
     * possession of the SIM. The code lasts 300 seconds, may be resent after 60 seconds, at
     * most 3 times, and is destroyed after 5 wrong attempts.
     *
     * Body fields:
     *   - phonenumber (string): Number to verify. Defaults to the one on the account.
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function requestOtp(array $body = [], array $query = [])
    {
        return $this->call('POST', '/phone/otp', ['query' => $query, 'body' => $body]);
    }

    /**
     * Confirm a phone verification code
     *
     * POST /phone/verify — Bearer token required, from the API specification.
     *
     * Confirm the code sent by phone.requestOtp. On success the number is written to the
     * profile when it changed, and ownership of it is claimed for this account. No new token
     * is issued — the current session continues.
     *
     * Note: Returns {success, phone:{status, verified_at}}. A phone belongs to exactly one
     * account: claiming is guarded by a unique index, so a race loses cleanly with
     * phone_already_verified.
     *
     * Body fields:
     *   - otp (string, required): Six-digit code
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function verify(array $body = [], array $query = [])
    {
        return $this->call('POST', '/phone/verify', ['query' => $query, 'body' => $body]);
    }

}
