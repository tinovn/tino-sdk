<?php

declare(strict_types=1);

/**
 * Affiliate programme.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Affiliate programme — 12 operations.
 */
class Affiliate extends Resource
{
    /**
     * Active Affiliate
     *
     * POST /affiliate/active — Bearer token required, from the API specification.
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function activate(array $body = [], array $query = [])
    {
        return $this->call('POST', '/affiliate/active', ['query' => $query, 'body' => $body]);
    }

    /**
     * Add Vouchers
     *
     * POST /affiliates/addvoucher — Bearer token required, from the API specification.
     *
     * Body fields:
     *   - plan (integer): Plan ID Requested</b>
     *   - cycle (string, one of once, recurring): Voucher cycle Requested</b>
     *   - audience (string, one of new, all, existing): Voucher audience
     *   - max_usage_limit (boolean): max_usage_limit
     *   - max_usage (string): max_usage
     *   - expires (string): Expires Date
     *   - discount (string, one of Min: 1, Max: Commission Rate): Discount value
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function addVoucher(array $body = [], array $query = [])
    {
        return $this->call('POST', '/affiliates/addvoucher', ['query' => $query, 'body' => $body]);
    }

    /**
     * Add Vouchers
     *
     * POST /affiliate/addvoucher — Bearer token required, from the API specification.
     *
     * Body fields:
     *   - plan (integer): Plan ID Requested</b>
     *   - cycle (string, one of once, recurring): Voucher cycle Requested</b>
     *   - audience (string, one of new, all, existing): Voucher audience
     *   - max_usage_limit (boolean): max_usage_limit
     *   - max_usage (string): max_usage
     *   - expires (string): Expires Date
     *   - discount (string, one of Min: 1, Max: Commission Rate): Discount value
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function addVoucherLegacy(array $body = [], array $query = [])
    {
        return $this->call('POST', '/affiliate/addvoucher', ['query' => $query, 'body' => $body]);
    }

    /**
     * View Commision Plan
     *
     * GET /affiliates/plans/{id} — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Plan ID
     *
     * @param string|int $id Plan ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getCommissionPlan($id, array $query = [])
    {
        $path = $this->path('/affiliates/plans/{id}', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Affiliate Info
     *
     * GET /affiliates/summary — Bearer token required, verified against the live API.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getSummary(array $query = [])
    {
        return $this->call('GET', '/affiliates/summary', ['query' => $query]);
    }

    /**
     * Get Affiliate campaigns
     *
     * GET /affiliates/campaigns — Bearer token required, verified against the live API.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listCampaigns(array $query = [])
    {
        return $this->call('GET', '/affiliates/campaigns', ['query' => $query]);
    }

    /**
     * Get Affiliate commission plans
     *
     * GET /affiliates/commissionplans — Bearer token required, verified against the live API.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listCommissionPlans(array $query = [])
    {
        return $this->call('GET', '/affiliates/commissionplans', ['query' => $query]);
    }

    /**
     * Affiliate Commissions
     *
     * GET /affiliates/commissions — Bearer token required, verified against the live API.
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listCommissions(array $query = [])
    {
        return $this->call('GET', '/affiliates/commissions', ['query' => $query]);
    }

    /**
     * Affiliate Payouts
     *
     * GET /affiliates/payouts — Bearer token required, verified against the live API.
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listPayouts(array $query = [])
    {
        return $this->call('GET', '/affiliates/payouts', ['query' => $query]);
    }

    /**
     * Affiliate Vouchers
     *
     * GET /affiliates/vouchers — Bearer token required, verified against the live API.
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listVouchers(array $query = [])
    {
        return $this->call('GET', '/affiliates/vouchers', ['query' => $query]);
    }

    /**
     * Affiliate Delete Vouchers
     *
     * DELETE /affiliates/vouchers/{id}/remove — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - id: Plan ID, Empty if get list plans
     *
     * @param string|int $id Plan ID, Empty if get list plans
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function removeVoucher($id, array $body = [], array $query = [])
    {
        $path = $this->path('/affiliates/vouchers/{id}/remove', ['id' => $id]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Affiliate Delete Vouchers
     *
     * DELETE /affiliate/removevoucher — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - id: Plan ID, Empty if get list plans
     *
     * @param string|int $id Plan ID, Empty if get list plans
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function removeVoucherLegacy($id, array $body = [], array $query = [])
    {
        $path = $this->path('/affiliate/removevoucher', ['id' => $id]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

}
