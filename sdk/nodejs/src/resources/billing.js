// Billing, invoices & payments.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Billing, invoices & payments — 21 operations. */
export class BillingResource extends Resource {
  /**
   * Add Funds
   *
   * POST /billing/addfunds — Bearer token required, from the API specification.
   *
   * Create Invoice Add Credits
   *
   * Body fields:
   *   - funds (integer): Amount of money
   *   - gateway (integer): Payment Method
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  addFunds(body = undefined, query = {}) {
    return this._call('POST', '/billing/addfunds', { query, body });
  }

  /**
   * Add Funds
   *
   * POST /addfunds — Bearer token required, from the API specification.
   *
   * Generate add funds invoice
   *
   * Body fields:
   *   - amount (number): Amount to add to account
   *   - gateway (number): Payment gateway ID, use `GET /addfunds` to list available gateways
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  addFundsLegacy(body = undefined, query = {}) {
    return this._call('POST', '/addfunds', { query, body });
  }

  /**
   * Apply Credit
   *
   * POST /invoice/{id}/credit — Bearer token required, from the API specification.
   *
   * Calculate order cost and recurring prices for selected items.
   * Use the same parameters as for `POST /order`
   *
   * Body fields:
   *   - id (integer): Payment method ID
   *   - amount (string)
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  applyCredit(id, body = undefined, query = {}) {
    const path = this._path('/invoice/{id}/credit', { id: id });
    return this._call('POST', path, { query, body });
  }

  /**
   * Delete Invoice
   *
   * DELETE /invoice/{id} — Bearer token required, from the API specification.
   *
   * Path parameters:
   *   - id: Invoice id
   * @param {string|number} id Invoice id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  deleteInvoice(id, body = undefined, query = {}) {
    const path = this._path('/invoice/{id}', { id: id });
    return this._call('DELETE', path, { query, body });
  }

  /**
   * Get Add Funds Information
   *
   * GET /addfunds — Bearer token required, verified against the live API.
   *
   * Get add funds configuration: minimum and maximum deposit amounts and available payment
   * gateways
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getAddFundsInfo(query = {}) {
    return this._call('GET', '/addfunds', { query });
  }

  /**
   * Account balance
   *
   * GET /balance — Bearer token required, verified against the live API.
   *
   * Get current account balance(unpaid invoices total), account credit
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getBalance(query = {}) {
    return this._call('GET', '/balance', { query });
  }

  /**
   * Credit logs
   *
   * GET /billing/creditlogs — Bearer token required, verified against the live API.
   *
   * Query parameters:
   *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
   *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
   *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
   *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getCreditLogs(query = {}) {
    return this._call('GET', '/billing/creditlogs', { query });
  }

  /**
   * Currencies List
   *
   * GET /currencies — no authentication required, verified against the live API.
   *
   * Return currencies details
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getCurrencies(query = {}) {
    return this._call('GET', '/currencies', { query, authenticated: false });
  }

  /**
   * Estimates Details
   *
   * GET /estimates/{id} — Bearer token required, from the API specification.
   *
   * Path parameters:
   *   - id: Estimates id
   * @param {string|number} id Estimates id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getEstimate(id, query = {}) {
    const path = this._path('/estimates/{id}', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Download Invoice Pdf
   *
   * GET /estimate/{id}/pdf — Bearer token required, from the API specification.
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getEstimatePdf(id, query = {}) {
    const path = this._path('/estimate/{id}/pdf', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Invoice Details
   *
   * GET /invoice/{id} — Bearer token required, verified against the live API.
   *
   * Get invoice details
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getInvoiceDetails(id, query = {}) {
    const path = this._path('/invoice/{id}', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Invoice PDF
   *
   * GET /invoice/{id}/pdf — Bearer token required, verified against the live API.
   *
   * Get specific invoice PDF as base64 string
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getInvoicePdf(id, query = {}) {
    const path = this._path('/invoice/{id}/pdf', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Payment link
   *
   * GET /billing/{invoice_id}/pay/{gateway_id} — Bearer token required, verified against the live API.
   *
   * Get Payment link from Gateways.
   *
   * Path parameters:
   *   - invoice_id: Invoice ID
   *   - gateway_id: Gateway ID
   * @param {string|number} invoiceId Invoice ID
   * @param {string|number} gatewayId Gateway ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getPaymentLink(invoiceId, gatewayId, query = {}) {
    const path = this._path('/billing/{invoice_id}/pay/{gateway_id}', { invoice_id: invoiceId, gateway_id: gatewayId });
    return this._call('GET', path, { query });
  }

  /**
   * List Estimates
   *
   * GET /estimates — Bearer token required, verified against the live API.
   *
   * List all estimates under my account
   * Using: &page=&perpage= for pagination. page start 0.
   * filter[service_status]= search invoice by service status, filter[service]= search
   * invoice by service id
   *
   * Query parameters:
   *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
   *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
   *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
   *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listEstimates(query = {}) {
    return this._call('GET', '/estimates', { query });
  }

  /**
   * List Invoices
   *
   * GET /invoices — Bearer token required, verified against the live API.
   *
   * List all invoices under my account
   * Using: &page=&perpage= for pagination. page start 0.
   * filter[service_status]= search invoice by service status, filter[service]= search
   * invoice by service id
   *
   * Query parameters:
   *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
   *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
   *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
   *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listInvoices(query = {}) {
    return this._call('GET', '/invoices', { query });
  }

  /**
   * List Invoices Due
   *
   * GET /invoices/due — Bearer token required, verified against the live API.
   *
   * List all invoices due under my account
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
  listInvoicesDue(query = {}) {
    return this._call('GET', '/invoices/due', { query });
  }

  /**
   * List Invoices
   *
   * GET /invoice — Bearer token required, verified against the live API.
   *
   * List all invoices under my account
   *
   * Query parameters:
   *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
   *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
   *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
   *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listInvoicesLegacy(query = {}) {
    return this._call('GET', '/invoice', { query });
  }

  /**
   * Payment Methods Fees
   *
   * GET /payment/fees — no authentication required, verified against the live API.
   *
   * List available payment methods with fees
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listPaymentMethodFees(query = {}) {
    return this._call('GET', '/payment/fees', { query, authenticated: false });
  }

  /**
   * Payment Methods
   *
   * GET /payment — no authentication required, verified against the live API.
   *
   * List available payment methods
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listPaymentMethods(query = {}) {
    return this._call('GET', '/payment', { query, authenticated: false });
  }

  /**
   * Payall Invoice
   *
   * POST /invoices/payall — Bearer token required, from the API specification.
   *
   * Body fields:
   *   - selected (array): selected invoice id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  payAllInvoices(body = undefined, query = {}) {
    return this._call('POST', '/invoices/payall', { query, body });
  }

  /**
   * Redeem a voucher
   *
   * POST /billing/creditvoucher — Bearer token required, from the API specification.
   *
   * Using Redeem a voucher
   *
   * Body fields:
   *   - code (string): Voucher Code
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  redeemCreditVoucher(body = undefined, query = {}) {
    return this._call('POST', '/billing/creditvoucher', { query, body });
  }

}
