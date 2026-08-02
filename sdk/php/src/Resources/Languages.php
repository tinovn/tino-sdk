<?php

declare(strict_types=1);

/**
 * Languages & translations.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Languages & translations — 3 operations.
 */
class Languages extends Resource
{
    /**
     * Billing cycle labels in the active language
     *
     * GET /languages/translate — no authentication required, verified against the live API.
     *
     * Return languages translate
     *
     * Query parameters:
     *   - key (required): lang keyword
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getBillingCycleLabels(array $query = [])
    {
        return $this->call('GET', '/languages/translate', ['query' => $query, 'authenticated' => false]);
    }

    /**
     * Get Language File
     *
     * GET /languages/file/{langname} — no authentication required, verified against the live API.
     *
     * List support tickets under my account
     *
     * Path parameters:
     *   - langname: lang name
     *
     * @param string|int $langname lang name
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getFile($langname, array $query = [])
    {
        $path = $this->path('/languages/file/{langname}', ['langname' => $langname]);
        return $this->call('GET', $path, ['query' => $query, 'authenticated' => false]);
    }

    /**
     * List language
     *
     * GET /languages — no authentication required, verified against the live API.
     *
     * Return languages details
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function list(array $query = [])
    {
        return $this->call('GET', '/languages', ['query' => $query, 'authenticated' => false]);
    }

}
