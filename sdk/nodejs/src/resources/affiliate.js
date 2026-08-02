// Affiliate programme.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Affiliate programme — 12 operations. */
export class AffiliateResource extends Resource {
  /**
   * Active Affiliate
   *
   * POST /affiliate/active — Bearer token required, from the API specification.
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  activate(body = undefined, query = {}) {
    return this._call('POST', '/affiliate/active', { query, body });
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
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  addVoucher(body = undefined, query = {}) {
    return this._call('POST', '/affiliates/addvoucher', { query, body });
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
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  addVoucherLegacy(body = undefined, query = {}) {
    return this._call('POST', '/affiliate/addvoucher', { query, body });
  }

  /**
   * View Commision Plan
   *
   * GET /affiliates/plans/{id} — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Plan ID
   * @param {string|number} id Plan ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getCommissionPlan(id, query = {}) {
    const path = this._path('/affiliates/plans/{id}', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Affiliate Info
   *
   * GET /affiliates/summary — Bearer token required, verified against the live API.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getSummary(query = {}) {
    return this._call('GET', '/affiliates/summary', { query });
  }

  /**
   * Get Affiliate campaigns
   *
   * GET /affiliates/campaigns — Bearer token required, verified against the live API.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listCampaigns(query = {}) {
    return this._call('GET', '/affiliates/campaigns', { query });
  }

  /**
   * Get Affiliate commission plans
   *
   * GET /affiliates/commissionplans — Bearer token required, verified against the live API.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listCommissionPlans(query = {}) {
    return this._call('GET', '/affiliates/commissionplans', { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listCommissions(query = {}) {
    return this._call('GET', '/affiliates/commissions', { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listPayouts(query = {}) {
    return this._call('GET', '/affiliates/payouts', { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listVouchers(query = {}) {
    return this._call('GET', '/affiliates/vouchers', { query });
  }

  /**
   * Affiliate Delete Vouchers
   *
   * DELETE /affiliates/vouchers/{id}/remove — Bearer token required, from the API specification.
   *
   * Path parameters:
   *   - id: Plan ID, Empty if get list plans
   * @param {string|number} id Plan ID, Empty if get list plans
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  removeVoucher(id, body = undefined, query = {}) {
    const path = this._path('/affiliates/vouchers/{id}/remove', { id: id });
    return this._call('DELETE', path, { query, body });
  }

  /**
   * Affiliate Delete Vouchers
   *
   * DELETE /affiliate/removevoucher — Bearer token required, from the API specification.
   *
   * Path parameters:
   *   - id: Plan ID, Empty if get list plans
   * @param {string|number} id Plan ID, Empty if get list plans
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  removeVoucherLegacy(id, body = undefined, query = {}) {
    const path = this._path('/affiliate/removevoucher', { id: id });
    return this._call('DELETE', path, { query, body });
  }

}
