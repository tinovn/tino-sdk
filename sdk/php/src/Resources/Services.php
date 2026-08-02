<?php

declare(strict_types=1);

/**
 * Services (hosting, VPS, ...).
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Services (hosting, VPS, ...) — 26 operations.
 */
class Services extends Resource
{
    /**
     * Cancel Service
     *
     * POST /service/{id}/cancel — Bearer token required, verified against the live API.
     *
     * Request service cancellation
     *
     * Body fields:
     *   - id (integer): Service id
     *   - immediate (string): set to false</code> to terminate service at the end of billing date, true</code> - terminate immediately
     *   - reason (string): Reason for this request
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function cancel($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/cancel', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Create Emails Account
     *
     * POST /service/{id}/emails — Bearer token required, verified against the live API.
     *
     * Get the details of a particular virtual server
     *
     * Path parameters:
     *   - id: Service ID
     *
     * Body fields:
     *   - module (string, required): Service type module (Cpanel2|DirectAdmin2|Zimbra|Wilduck)
     *   - name (string, required): Email account without domain
     *   - passmain (string, required): Password for email account
     *   - passcheck (string, required): Password confirm for email account
     *   - quota (integer, required): Email Quote (Megabytes)
     *
     * @param string|int $id Service ID
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function createEmailAccount($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/emails', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Delete Email Account
     *
     * POST /service/{id}/emails/delete — Bearer token required, verified against the live API.
     *
     * Get the details of a particular virtual server
     *
     * Path parameters:
     *   - id: Service ID
     *
     * Body fields:
     *   - module (string, required): Service type module (Cpanel2|DirectAdmin2|Zimbra|Wilduck)
     *   - deluser (string, required): Email account
     *   - domain (string, required): Password for email account
     *
     * @param string|int $id Service ID
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function deleteEmailAccount($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/emails/delete', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Service details
     *
     * GET /service/{id} — Bearer token required, verified against the live API.
     *
     * Return details for service `@id`
     *
     * Path parameters:
     *   - id: Service id
     *
     * @param string|int $id Service id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function get($id, array $query = [])
    {
        $path = $this->path('/service/{id}', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List Billing Cycle
     *
     * GET /service/{id}/cycle — Bearer token required, verified against the live API.
     *
     * Get recurring billing cycle options
     *
     * Path parameters:
     *   - id: Service id
     *
     * @param string|int $id Service id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getBillingCycles($id, array $query = [])
    {
        $path = $this->path('/service/{id}/cycle', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Service label
     *
     * GET /service/{id}/label — Bearer token required, verified against the live API.
     *
     * Show current service label
     *
     * Path parameters:
     *   - id: Service id
     *
     * @param string|int $id Service id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getLabel($id, array $query = [])
    {
        $path = $this->path('/service/{id}/label', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Resources
     *
     * GET /service/{id}/resources — Bearer token required, verified against the live API.
     *
     * Show available and used resources
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getResources($id, array $query = [])
    {
        $path = $this->path('/service/{id}/resources', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Reverse DNS
     *
     * GET /service/{id}/rdns — Bearer token required, verified against the live API.
     *
     * Get reverse DNS entries for service's IP addresses
     *
     * Path parameters:
     *   - id: Service ID
     *
     * @param string|int $id Service ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getReverseDns($id, array $query = [])
    {
        $path = $this->path('/service/{id}/rdns', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Upgrade Options
     *
     * GET /service/{id}/upgrade — Bearer token required, verified against the live API.
     *
     * List upgrade options
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getUpgradeOptions($id, array $query = [])
    {
        $path = $this->path('/service/{id}/upgrade', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List services
     *
     * GET /service — Bearer token required, verified against the live API.
     *
     * List all services under your account
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
    public function list(array $query = [])
    {
        return $this->call('GET', '/service', ['query' => $query]);
    }

    /**
     * Get list services active
     *
     * GET /services/active — Bearer token required, verified against the live API.
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
    public function listActive(array $query = [])
    {
        return $this->call('GET', '/services/active', ['query' => $query]);
    }

    /**
     * List services by category
     *
     * GET /services/{cid} — Bearer token required, verified against the live API.
     *
     * List all services under your account by Category id.
     * filter[hide_terminated]=1 filter[hide_cancelled]=1 filter[hide_suspended]=1
     * filter[hide_fraud]=1 filter[status]=Active
     *
     * Path parameters:
     *   - cid: Category id, 0 to get all
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param string|int $cid Category id, 0 to get all
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listByCategory($cid, array $query = [])
    {
        $path = $this->path('/services/{cid}', ['cid' => $cid]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get Emails Account
     *
     * GET /service/{id}/emails — Bearer token required, verified against the live API.
     *
     * Get the details of a particular virtual server
     *
     * Path parameters:
     *   - id: Service ID
     *
     * Query parameters:
     *   - module (required): Service type module (Cpanel2|DirectAdmin2|Zimbra|Wilduck)
     *
     * @param string|int $id Service ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listEmailAccounts($id, array $query = [])
    {
        $path = $this->path('/service/{id}/emails', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Service Invoice Related
     *
     * GET /service/{id}/invoices — Bearer token required, verified against the live API.
     *
     * Returns details of the DNS zone
     *
     * Path parameters:
     *   - id: Service ID
     *
     * @param string|int $id Service ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listInvoices($id, array $query = [])
    {
        $path = $this->path('/service/{id}/invoices', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * IP Addresses
     *
     * GET /service/{id}/ip — Bearer token required, verified against the live API.
     *
     * List Service IP Addresses
     *
     * Path parameters:
     *   - id: Service ID
     *
     * @param string|int $id Service ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listIps($id, array $query = [])
    {
        $path = $this->path('/service/{id}/ip', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List service methods
     *
     * GET /service/{id}/methods — Bearer token required, verified against the live API.
     *
     * List methods available for service
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listMethods($id, array $query = [])
    {
        $path = $this->path('/service/{id}/methods', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List available networks
     *
     * GET /service/{id}/networks — Bearer token required, verified against the live API.
     *
     * List of networks and IP pools that can be used for VM creation
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listNetworks($id, array $query = [])
    {
        $path = $this->path('/service/{id}/networks', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List OS templates
     *
     * GET /service/{id}/templates — Bearer token required, verified against the live API.
     *
     * List templates that can be used to create virtual server
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listOsTemplates($id, array $query = [])
    {
        $path = $this->path('/service/{id}/templates', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List services widgets
     *
     * GET /service/{id}/widgets — Bearer token required, verified against the live API.
     *
     * List all services widgets
     *
     * Path parameters:
     *   - id: Service id
     *
     * @param string|int $id Service id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listWidgets($id, array $query = [])
    {
        $path = $this->path('/service/{id}/widgets', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Manual renew Service
     *
     * POST /service/{id}/manualrenew — Bearer token required, verified against the live API.
     *
     * Check if domain is available for registration. Returns status: "ok" if domain is
     * available, empty response otherwise
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function manualRenew($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/manualrenew', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Manual Service Renew
     *
     * POST /service/{id}/renew — Bearer token required, from the API specification.
     *
     * Generate an invoice to renew the service.
     *
     * Body fields:
     *   - id (integer): Service id
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function renew($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/renew', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Upgrade Request
     *
     * POST /service/{id}/upgrade — Bearer token required, verified against the live API.
     *
     * Estimate or request upgrade
     *
     * ```json
     * // Format of ''resources'' paremeter
     * {
     * "resource_id" : "qty_value", // sliders & qty fields
     * "resource_id" : "item_id", // dropdown & radio fields
     * "resource_id" : {
     * "item_id": "qty_value" // dropdown with qty field
     * }
     * }
     * ```
     *
     * Body fields:
     *   - id (integer): Service id
     *   - resources (array): array with resource values
     *   - package (integer): New package id, optonal when upgrading resources
     *   - cycle (string): New billing cycle, optonal when upgrading resources
     *   - send (boolean): Set to true when you want to send your upgrade request
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function requestUpgrade($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/upgrade', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Change Billing Cycle
     *
     * POST /service/{id}/cycle — Bearer token required, from the API specification.
     *
     * Change recurring billing cycle for the service
     *
     * Body fields:
     *   - id (integer): Service id
     *   - cycle (string): New billing cycle
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function setBillingCycle($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/cycle', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Change service label
     *
     * POST /service/{id}/label — Bearer token required, verified against the live API.
     *
     * Set new custom label to identify this service
     *
     * Body fields:
     *   - id (integer): Service id
     *   - label (string): New label
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function setLabel($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/label', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Update Emails Account
     *
     * POST /service/{id}/emails/change — Bearer token required, verified against the live API.
     *
     * Get the details of a particular virtual server
     *
     * Path parameters:
     *   - id: Service ID
     *
     * Body fields:
     *   - module (string, required): Service type module (Cpanel2|DirectAdmin2|Zimbra|Wilduck)
     *   - change (Array, required)
     *
     * @param string|int $id Service ID
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateEmailAccount($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/emails/change', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Update rDNS
     *
     * POST /service/{id}/rdns — Bearer token required, from the API specification.
     *
     * Update reverse DNS entries service's IP addresses
     *
     * Body fields:
     *   - id (integer): Service ID
     *   - ipaddress (array): Use Ip address as parameter key and hostname as value
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateReverseDns($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{id}/rdns', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

}
