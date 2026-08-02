// Services (hosting, VPS, ...).
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Services (hosting, VPS, ...) — 26 operations. */
export class ServicesResource extends Resource {
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
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  cancel(id, body = undefined, query = {}) {
    const path = this._path('/service/{id}/cancel', { id: id });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} id Service ID
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  createEmailAccount(id, body = undefined, query = {}) {
    const path = this._path('/service/{id}/emails', { id: id });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} id Service ID
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  deleteEmailAccount(id, body = undefined, query = {}) {
    const path = this._path('/service/{id}/emails/delete', { id: id });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} id Service id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  get(id, query = {}) {
    const path = this._path('/service/{id}', { id: id });
    return this._call('GET', path, { query });
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
   * @param {string|number} id Service id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getBillingCycles(id, query = {}) {
    const path = this._path('/service/{id}/cycle', { id: id });
    return this._call('GET', path, { query });
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
   * @param {string|number} id Service id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getLabel(id, query = {}) {
    const path = this._path('/service/{id}/label', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Resources
   *
   * GET /service/{id}/resources — Bearer token required, verified against the live API.
   *
   * Show available and used resources
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getResources(id, query = {}) {
    const path = this._path('/service/{id}/resources', { id: id });
    return this._call('GET', path, { query });
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
   * @param {string|number} id Service ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getReverseDns(id, query = {}) {
    const path = this._path('/service/{id}/rdns', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Upgrade Options
   *
   * GET /service/{id}/upgrade — Bearer token required, verified against the live API.
   *
   * List upgrade options
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getUpgradeOptions(id, query = {}) {
    const path = this._path('/service/{id}/upgrade', { id: id });
    return this._call('GET', path, { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  list(query = {}) {
    return this._call('GET', '/service', { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listActive(query = {}) {
    return this._call('GET', '/services/active', { query });
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
   * @param {string|number} cid Category id, 0 to get all
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listByCategory(cid, query = {}) {
    const path = this._path('/services/{cid}', { cid: cid });
    return this._call('GET', path, { query });
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
   * @param {string|number} id Service ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listEmailAccounts(id, query = {}) {
    const path = this._path('/service/{id}/emails', { id: id });
    return this._call('GET', path, { query });
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
   * @param {string|number} id Service ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listInvoices(id, query = {}) {
    const path = this._path('/service/{id}/invoices', { id: id });
    return this._call('GET', path, { query });
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
   * @param {string|number} id Service ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listIps(id, query = {}) {
    const path = this._path('/service/{id}/ip', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * List service methods
   *
   * GET /service/{id}/methods — Bearer token required, verified against the live API.
   *
   * List methods available for service
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listMethods(id, query = {}) {
    const path = this._path('/service/{id}/methods', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * List available networks
   *
   * GET /service/{id}/networks — Bearer token required, verified against the live API.
   *
   * List of networks and IP pools that can be used for VM creation
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listNetworks(id, query = {}) {
    const path = this._path('/service/{id}/networks', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * List OS templates
   *
   * GET /service/{id}/templates — Bearer token required, verified against the live API.
   *
   * List templates that can be used to create virtual server
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listOsTemplates(id, query = {}) {
    const path = this._path('/service/{id}/templates', { id: id });
    return this._call('GET', path, { query });
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
   * @param {string|number} id Service id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listWidgets(id, query = {}) {
    const path = this._path('/service/{id}/widgets', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Manual renew Service
   *
   * POST /service/{id}/manualrenew — Bearer token required, verified against the live API.
   *
   * Check if domain is available for registration. Returns status: "ok" if domain is
   * available, empty response otherwise
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  manualRenew(id, body = undefined, query = {}) {
    const path = this._path('/service/{id}/manualrenew', { id: id });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  renew(id, body = undefined, query = {}) {
    const path = this._path('/service/{id}/renew', { id: id });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  requestUpgrade(id, body = undefined, query = {}) {
    const path = this._path('/service/{id}/upgrade', { id: id });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  setBillingCycle(id, body = undefined, query = {}) {
    const path = this._path('/service/{id}/cycle', { id: id });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  setLabel(id, body = undefined, query = {}) {
    const path = this._path('/service/{id}/label', { id: id });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} id Service ID
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateEmailAccount(id, body = undefined, query = {}) {
    const path = this._path('/service/{id}/emails/change', { id: id });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateReverseDns(id, body = undefined, query = {}) {
    const path = this._path('/service/{id}/rdns', { id: id });
    return this._call('POST', path, { query, body });
  }

}
