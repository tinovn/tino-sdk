// Domain names.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Domain names — 31 operations. */
export class DomainsResource extends Resource {
  /**
   * Adds the DNSSEC key
   *
   * PUT /domain/{id}/dnssec — Bearer token required, from the API specification.
   *
   * Body fields:
   *   - id (integer): Domain id
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  addDnssecKey(id, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/dnssec', { id: id });
    return this._call('PUT', path, { query, body });
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
   * @param {string|number} id Domain id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  get(id, query = {}) {
    const path = this._path('/domain/{id}', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Get domain autorenew
   *
   * GET /domain/{id}/autorenew — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Domain id
   * @param {string|number} id Domain id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getAutoRenew(id, query = {}) {
    const path = this._path('/domain/{id}/autorenew', { id: id });
    return this._call('GET', path, { query });
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
   * @param {string|number} name Domain name
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getByName(name, query = {}) {
    const path = this._path('/domain/name/{name}', { name: name });
    return this._call('GET', path, { query });
  }

  /**
   * Get domain contact info
   *
   * GET /domain/{id}/contact — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Domain id
   * @param {string|number} id Domain id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getContacts(id, query = {}) {
    const path = this._path('/domain/{id}/contact', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Returns the available flags
   *
   * GET /domain/{id}/dnssec/flags — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Domain id
   * @param {string|number} id Domain id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getDnssecFlags(id, query = {}) {
    const path = this._path('/domain/{id}/dnssec/flags', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Get email forwarding
   *
   * GET /domain/{id}/emforwarding — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Domain id
   * @param {string|number} id Domain id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getEmailForwarding(id, query = {}) {
    const path = this._path('/domain/{id}/emforwarding', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Get domain EPP Code
   *
   * GET /domain/{id}/epp — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Domain id
   * @param {string|number} id Domain id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getEppCode(id, query = {}) {
    const path = this._path('/domain/{id}/epp', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Get domain nameservers
   *
   * GET /domain/{id}/ns — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Domain id
   * @param {string|number} id Domain id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getNameservers(id, query = {}) {
    const path = this._path('/domain/{id}/ns', { id: id });
    return this._call('GET', path, { query });
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
   * @param {string|number} id Domain id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getRegisteredNameservers(id, query = {}) {
    const path = this._path('/domain/{id}/reg', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Get domain lock
   *
   * GET /domain/{id}/reglock — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Domain id
   * @param {string|number} id Domain id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getRegistrarLock(id, query = {}) {
    const path = this._path('/domain/{id}/reglock', { id: id });
    return this._call('GET', path, { query });
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
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getTldForm(id, query = {}) {
    const path = this._path('/domain/order/{id}/form', { id: id });
    return this._call('GET', path, { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  list(query = {}) {
    return this._call('GET', '/domains', { query });
  }

  /**
   * Returns the list of DNSSEC keys
   *
   * GET /domain/{id}/dnssec — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Domain id
   * @param {string|number} id Domain id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listDnssecKeys(id, query = {}) {
    const path = this._path('/domain/{id}/dnssec', { id: id });
    return this._call('GET', path, { query });
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
   * @param {string|number} id Domain ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listInvoices(id, query = {}) {
    const path = this._path('/domain/{id}/invoices', { id: id });
    return this._call('GET', path, { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listLegacy(query = {}) {
    return this._call('GET', '/domain', { query });
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
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  lookup(body = undefined, query = {}) {
    return this._call('POST', '/domain/lookup', { query, body, authenticated: false });
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
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  order(body = undefined, query = {}) {
    return this._call('POST', '/domain/order', { query, body });
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
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  registerNameserver(id, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/reg', { id: id });
    return this._call('POST', path, { query, body });
  }

  /**
   * removeDnssecKey
   *
   * DELETE /domain/{id}/dnssec/{key} — Bearer token required, from the API specification.
   *
   * Path parameters:
   *   - id: Domain id
   * @param {string|number} id Domain id
   * @param {string|number} key
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  removeDnssecKey(id, key, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/dnssec/{key}', { id: id, key: key });
    return this._call('DELETE', path, { query, body });
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
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  renew(id, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/renew', { id: id });
    return this._call('POST', path, { query, body });
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
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  suggest(body = undefined, query = {}) {
    return this._call('POST', '/domain/suggest', { query, body, authenticated: false });
  }

  /**
   * Synchronize domain
   *
   * GET /domain/{id}/sync — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Domain id
   * @param {string|number} id Domain id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  sync(id, query = {}) {
    const path = this._path('/domain/{id}/sync', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Enable/disable domain autorenew
   *
   * PUT /domain/{id}/autorenew — Bearer token required, from the API specification.
   *
   * Path parameters:
   *   - id: Domain id
   *   - autorenew: true|false
   * @param {string|number} id Domain id
   * @param {string|number} autorenew true|false
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateAutoRenew(id, autorenew, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/autorenew', { id: id, autorenew: autorenew });
    return this._call('PUT', path, { query, body });
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
   * @param {string|number} id Domain id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateContacts(id, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/contact', { id: id });
    return this._call('PUT', path, { query, body });
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
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateEmailForwarding(id, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/emforwarding', { id: id });
    return this._call('PUT', path, { query, body });
  }

  /**
   * Update domain forwarding
   *
   * PUT /domain/{id}/forwarding — Bearer token required, from the API specification.
   *
   * Body fields:
   *   - id (integer): Domain id
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateForwarding(id, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/forwarding', { id: id });
    return this._call('PUT', path, { query, body });
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
   * @param {string|number} id Domain id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateIdProtection(id, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/idprotection', { id: id });
    return this._call('PUT', path, { query, body });
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
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateNameservers(id, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/ns', { id: id });
    return this._call('PUT', path, { query, body });
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
   * @param {string|number} id Domain id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateRegistrarLock(id, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/reglock', { id: id });
    return this._call('PUT', path, { query, body });
  }

  /**
   * Whois Domain
   *
   * GET /whois/{domain} — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - domain: Domain
   * @param {string|number} domain Domain
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  whois(domain, query = {}) {
    const path = this._path('/whois/{domain}', { domain: domain });
    return this._call('GET', path, { query });
  }

}
