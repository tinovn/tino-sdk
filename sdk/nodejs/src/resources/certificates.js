// SSL certificates.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** SSL certificates — 6 operations. */
export class CertificatesResource extends Resource {
  /**
   * Download certificate
   *
   * GET /certificate/{service_id}/crt — Bearer token required, from the API specification.
   *
   * Return X.509 certificate data
   *
   * Path parameters:
   *   - service_id: Service id
   * @param {string|number} serviceId Service id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  download(serviceId, query = {}) {
    const path = this._path('/certificate/{service_id}/crt', { service_id: serviceId });
    return this._call('GET', path, { query });
  }

  /**
   * Certificate details
   *
   * GET /certificate/{id} — Bearer token required, from the API specification.
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  get(id, query = {}) {
    const path = this._path('/certificate/{id}', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * List SSL Certificates
   *
   * GET /certificates — Bearer token required, verified against the live API.
   *
   * List all ssl services under your account
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
    return this._call('GET', '/certificates', { query });
  }

  /**
   * List available certificates
   *
   * GET /certificate/order — Bearer token required, verified against the live API.
   *
   * Return a list with certificate available for purchase
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listProducts(query = {}) {
    return this._call('GET', '/certificate/order', { query });
  }

  /**
   * List server software for certificates
   *
   * GET /certificate/order/{product_id}/software — Bearer token required, verified against the live API.
   *
   * Return a list with software IDs required or certificate
   *
   * Path parameters:
   *   - product_id: Certificate product ID
   * @param {string|number} productId Certificate product ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listServerSoftware(productId, query = {}) {
    const path = this._path('/certificate/order/{product_id}/software', { product_id: productId });
    return this._call('GET', path, { query });
  }

  /**
   * Order new certificates
   *
   * POST /certificate/order — Bearer token required, from the API specification.
   *
   * Create new order for a certificate
   *
   * Body fields:
   *   - product_id (integer): Certificate product ID
   *   - csr (string): Domain name
   *   - years (integer): Number of years
   *   - pay_method (integer): Payment method ID
   *   - approver_email (string): Email addres used in domain validation
   *   - admin (integer): Admin contact ID
   *   - tech (integer): Tech contact ID
   *   - billing (integer): Billing contact ID
   *   - organization (array): Organization details
   *   - software (integer): Server/Software ID
   *   - data (array): Addditional data required for some products
   *   - aff_id (integer): Affiliate ID
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  order(body = undefined, query = {}) {
    return this._call('POST', '/certificate/order', { query, body });
  }

}
