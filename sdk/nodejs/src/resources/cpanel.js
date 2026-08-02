// cPanel service actions.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** cPanel service actions — 7 operations. */
export class CpanelResource extends Resource {
  /**
   * Change Passs cPanel
   *
   * GET /service/cpanel2/{id}/changepasss — Bearer token required, verified against the live API.
   *
   * Get the details of a particular virtual server
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  changePassword(id, query = {}) {
    const path = this._path('/service/cpanel2/{id}/changepasss', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Change Domain cPanel
   *
   * POST /service/cpanel2/{id}/changedomain — Bearer token required, from the API specification.
   * @param {string|number} id
   * @param {string|number} domain
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  changePrimaryDomain(id, domain, body = undefined, query = {}) {
    const path = this._path('/service/cpanel2/{id}/changedomain', { id: id, domain: domain });
    return this._call('POST', path, { query, body });
  }

  /**
   * Get cPanel link login
   *
   * GET /service/cpanel2/{id}/login — Bearer token required, verified against the live API.
   *
   * Get the details of a particular virtual server
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getLoginLink(id, query = {}) {
    const path = this._path('/service/cpanel2/{id}/login', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Get cPanel phpmyadmin login
   *
   * GET /service/cpanel2/{id}/phpmyadminlogin — Bearer token required, verified against the live API.
   *
   * Get the details of a particular virtual server
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getPhpMyAdminLink(id, query = {}) {
    const path = this._path('/service/cpanel2/{id}/phpmyadminlogin', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Get cPanel statistics
   *
   * GET /service/cpanel2/{id}/statistics — Bearer token required, verified against the live API.
   *
   * Get the details of a particular virtual server
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getStatistics(id, query = {}) {
    const path = this._path('/service/cpanel2/{id}/statistics', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Reset Acount cPanel
   *
   * POST /service/cpanel2/{id}/resetacount — Bearer token required, from the API specification.
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  resetAccount(id, body = undefined, query = {}) {
    const path = this._path('/service/cpanel2/{id}/resetacount', { id: id });
    return this._call('POST', path, { query, body });
  }

  /**
   * Get cPanel unblock ip
   *
   * POST /service/cpanel2/{id}/unblock — Bearer token required, from the API specification.
   *
   * Get the details of a particular virtual server
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  unblockIp(id, body = undefined, query = {}) {
    const path = this._path('/service/cpanel2/{id}/unblock', { id: id });
    return this._call('POST', path, { query, body });
  }

}
