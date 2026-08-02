<?php

declare(strict_types=1);

/**
 * Domain names.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Domain names — 31 operations.
 */
class Domains extends Resource
{
    /**
     * Adds the DNSSEC key
     *
     * PUT /domain/{id}/dnssec — Bearer token required, from the API specification.
     *
     * Body fields:
     *   - id (integer): Domain id
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function addDnssecKey($id, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/dnssec', ['id' => $id]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Domain details
     *
     * GET /domain/{id} — Bearer token required, verified against the live API.
     *
     * Get domain details
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function get($id, array $query = [])
    {
        $path = $this->path('/domain/{id}', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get domain autorenew
     *
     * GET /domain/{id}/autorenew — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getAutoRenew($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/autorenew', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Domain details by name
     *
     * GET /domain/name/{name} — Bearer token required, verified against the live API.
     *
     * Get domain details by name
     *
     * Path parameters:
     *   - name: Domain name
     *
     * @param string|int $name Domain name
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getByName($name, array $query = [])
    {
        $path = $this->path('/domain/name/{name}', ['name' => $name]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get domain contact info
     *
     * GET /domain/{id}/contact — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getContacts($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/contact', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Returns the available flags
     *
     * GET /domain/{id}/dnssec/flags — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getDnssecFlags($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/dnssec/flags', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get email forwarding
     *
     * GET /domain/{id}/emforwarding — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getEmailForwarding($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/emforwarding', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get domain EPP Code
     *
     * GET /domain/{id}/epp — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getEppCode($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/epp', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get domain nameservers
     *
     * GET /domain/{id}/ns — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getNameservers($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/ns', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get registered nameservers
     *
     * GET /domain/{id}/reg — Bearer token required, verified against the live API.
     *
     * List registered private/glue nameservers for a domain.
     * Note: Not all domain registrar modules support returning registered nameservers.
     * If the module does not support this feature, an empty list may be returned.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getRegisteredNameservers($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/reg', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get domain lock
     *
     * GET /domain/{id}/reglock — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getRegistrarLock($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/reglock', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Additinal data for TLD
     *
     * GET /domain/order/{id}/form — Bearer token required, verified against the live API.
     *
     * Get additional forms required for some TLDs
     *
     * Note: {id} is the TLD product id returned by cart.listDomainTlds (e.g. 1298 for .io.vn),
     * not the id of a registered domain.
     *
     * Query parameters:
     *   - tld_id: TLD ID
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getTldForm($id, array $query = [])
    {
        $path = $this->path('/domain/order/{id}/form', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List Domains
     *
     * GET /domains — Bearer token required, verified against the live API.
     *
     * List domains under your account
     * Using: &page=&perpage= for pagination. page start 0
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
        return $this->call('GET', '/domains', ['query' => $query]);
    }

    /**
     * Returns the list of DNSSEC keys
     *
     * GET /domain/{id}/dnssec — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listDnssecKeys($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/dnssec', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Domain Invoice Related
     *
     * GET /domain/{id}/invoices — Bearer token required, verified against the live API.
     *
     * Returns details of the DNS zone
     *
     * Path parameters:
     *   - id: Domain ID
     *
     * @param string|int $id Domain ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listInvoices($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/invoices', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List Domains
     *
     * GET /domain — Bearer token required, verified against the live API.
     *
     * List domains under your account
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
    public function listLegacy(array $query = [])
    {
        return $this->call('GET', '/domain', ['query' => $query]);
    }

    /**
     * Domain availability
     *
     * POST /domain/lookup — no authentication required, verified against the live API.
     *
     * Check if domain is available for registration. Returns status: "ok" if domain is
     * available, empty response otherwise
     *
     * Body fields:
     *   - name (string): Domain name, ie. example.com
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function lookup(array $body = [], array $query = [])
    {
        return $this->call('POST', '/domain/lookup', ['query' => $query, 'body' => $body, 'authenticated' => false]);
    }

    /**
     * Order new domain
     *
     * POST /domain/order — Bearer token required, from the API specification.
     *
     * Create new order for a domain, please check if requested domain is available first,
     * otherwise your order may get cancelled.
     *
     * Body fields:
     *   - name (string): Domain name
     *   - years (string): Number of years
     *   - action (string): register|transfer
     *   - tld_id (string): TLD id
     *   - pay_method (integer): Payment method ID
     *   - epp (string): EPP Transfer code, required when transfering some domains
     *   - nameservers (array): Optional array with 2 - 4 nameservers that you want to use
     *   - registrant (integer): Optional contact ID to use for registrant contact this domain
     *   - admin (integer): Optional contact ID to use for admin contact this domain
     *   - tech (integer): Optional contact ID to use for tech contact this domain
     *   - billing (integer): Optional contact ID to use for billing contact this domain
     *   - data (array): Addditional data required for some TLDs
     *   - aff_id (integer): Affiliate ID
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function order(array $body = [], array $query = [])
    {
        return $this->call('POST', '/domain/order', ['query' => $query, 'body' => $body]);
    }

    /**
     * Register domain nameservers
     *
     * POST /domain/{id}/reg — Bearer token required, from the API specification.
     *
     * Manage private/glue nameservers for a domain. Use the `action` parameter to select the
     * operation:
     * - `registerNameServer` – register a new glue record (requires `nameserver` + `ip`)
     * - `modifyNameServer` – update the IP of an existing glue record (requires `nameserver` +
     * `oldip` + `newip`)
     * - `deleteNameServer` – remove a glue record (requires `nameserver`)
     *
     * Body fields:
     *   - id (integer): Domain id
     *   - action (string): Operation: registerNameServer, modifyNameServer, deleteNameServer
     *   - nameserver (string): Full nameserver hostname
     *   - ip (string): IP address for the nameserver – required for registerNameServer
     *   - oldip (string): Current IP address – required for modifyNameServer
     *   - newip (string): New IP address – required for modifyNameServer
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function registerNameserver($id, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/reg', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * removeDnssecKey
     *
     * DELETE /domain/{id}/dnssec/{key} — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param string|int $key
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function removeDnssecKey($id, $key, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/dnssec/{key}', ['id' => $id, 'key' => $key]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Renew domain
     *
     * POST /domain/{id}/renew — Bearer token required, from the API specification.
     *
     * Create new renew order for a domain, please check if requested domain is available
     * first, otherwise your order may get cancelled.
     *
     * Body fields:
     *   - years (string): Number of years
     *   - pay_method (integer): Payment method ID
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function renew($id, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/renew', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Domain suggest
     *
     * POST /domain/suggest — no authentication required, verified against the live API.
     *
     * Check if domain is available for registration. Returns status: "ok" if domain is
     * available, empty response otherwise
     *
     * Body fields:
     *   - name (string): Domain name, ie. example.com
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function suggest(array $body = [], array $query = [])
    {
        return $this->call('POST', '/domain/suggest', ['query' => $query, 'body' => $body, 'authenticated' => false]);
    }

    /**
     * Synchronize domain
     *
     * GET /domain/{id}/sync — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function sync($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/sync', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Enable/disable domain autorenew
     *
     * PUT /domain/{id}/autorenew — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - id: Domain id
     *   - autorenew: true|false
     *
     * @param string|int $id Domain id
     * @param string|int $autorenew true|false
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateAutoRenew($id, $autorenew, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/autorenew', ['id' => $id, 'autorenew' => $autorenew]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Update domain contact (WHOIS) information
     *
     * PUT /domain/{id}/contact — Bearer token required, from the API specification.
     *
     * Update the registrant, admin, tech and billing contacts of a domain.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * Body fields:
     *   - registrant (object): Registrant contact fields
     *   - admin (object): Administrative contact fields
     *   - tech (object): Technical contact fields
     *   - billing (object): Billing contact fields
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateContacts($id, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/contact', ['id' => $id]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Update email forwarding
     *
     * PUT /domain/{id}/emforwarding — Bearer token required, from the API specification.
     *
     * Body fields:
     *   - id (integer): Domain id
     *   - from (string): Email address that you want to forward
     *   - to (string): Email address that will receive forwarded emails
     *   - records (array): Multiple forwarding rules [{"from":"info","to":"dest@domain.com"},{"from":"support","to":"help@domain.com"}]
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateEmailForwarding($id, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/emforwarding', ['id' => $id]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Update domain forwarding
     *
     * PUT /domain/{id}/forwarding — Bearer token required, from the API specification.
     *
     * Body fields:
     *   - id (integer): Domain id
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateForwarding($id, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/forwarding', ['id' => $id]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Update domain ID Protection
     *
     * PUT /domain/{id}/idprotection — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * Body fields:
     *   - switch (boolean): true|false
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateIdProtection($id, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/idprotection', ['id' => $id]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Update domain nameservers
     *
     * PUT /domain/{id}/ns — Bearer token required, from the API specification.
     *
     * Change domain nameservers, if `$nameservers` is left empty, default namesevers will be
     * used
     *
     * Body fields:
     *   - id (integer): Domain id
     *   - nameservers (array): List of nameservers to use
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateNameservers($id, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/ns', ['id' => $id]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Update domain lock
     *
     * PUT /domain/{id}/reglock — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - id: Domain id
     *
     * Body fields:
     *   - switch (boolean): true|false
     *
     * @param string|int $id Domain id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateRegistrarLock($id, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/reglock', ['id' => $id]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Whois Domain
     *
     * GET /whois/{domain} — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - domain: Domain
     *
     * @param string|int $domain Domain
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function whois($domain, array $query = [])
    {
        $path = $this->path('/whois/{domain}', ['domain' => $domain]);
        return $this->call('GET', $path, ['query' => $query]);
    }

}
