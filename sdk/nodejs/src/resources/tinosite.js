// TinoSite (managed WordPress).
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** TinoSite (managed WordPress) — 10 operations. */
export class TinositeResource extends Resource {
  /**
   * Auto Login
   *
   * POST /tinosite/{id}/autologin — Bearer token required, verified against the live API.
   *
   * Body fields:
   *   - email (string, required)
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  autoLogin(id, body = undefined, query = {}) {
    const path = this._path('/tinosite/{id}/autologin', { id: id });
    return this._call('POST', path, { query, body });
  }

  /**
   * Backups
   *
   * POST /tinosite/{id}/backups — Bearer token required, verified against the live API.
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  backup(id, body = undefined, query = {}) {
    const path = this._path('/tinosite/{id}/backups', { id: id });
    return this._call('POST', path, { query, body });
  }

  /**
   * Add User
   *
   * POST /tinosite/{id}/users — Bearer token required, verified against the live API.
   *
   * Body fields:
   *   - email (string, required)
   *   - role (string, required)
   *   - password (string, required)
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  createUser(id, body = undefined, query = {}) {
    const path = this._path('/tinosite/{id}/users', { id: id });
    return this._call('POST', path, { query, body });
  }

  /**
   * Domain Pointer
   *
   * POST /tinosite/{id}/domainpointers — Bearer token required, verified against the live API.
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  domainPointerAction(id, body = undefined, query = {}) {
    const path = this._path('/tinosite/{id}/domainpointers', { id: id });
    return this._call('POST', path, { query, body });
  }

  /**
   * Metrics
   *
   * GET /tinosite/{id}/metrics — Bearer token required, verified against the live API.
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getMetrics(id, query = {}) {
    const path = this._path('/tinosite/{id}/metrics', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * List plugins
   *
   * GET /tinosite/{id}/plugins — Bearer token required, verified against the live API.
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listPlugins(id, query = {}) {
    const path = this._path('/tinosite/{id}/plugins', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * List themes
   *
   * GET /tinosite/{id}/themes — Bearer token required, verified against the live API.
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listThemes(id, query = {}) {
    const path = this._path('/tinosite/{id}/themes', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * List User
   *
   * GET /tinosite/{id}/users — Bearer token required, verified against the live API.
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listUsers(id, query = {}) {
    const path = this._path('/tinosite/{id}/users', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Action SSL
   *
   * POST /tinosite/{id}/sslcerts — Bearer token required, verified against the live API.
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  sslCertificateAction(id, body = undefined, query = {}) {
    const path = this._path('/tinosite/{id}/sslcerts', { id: id });
    return this._call('POST', path, { query, body });
  }

  /**
   * on/off ssl certs
   *
   * POST /tinosite/{id}/sslcerts/onoff — Bearer token required, verified against the live API.
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  toggleSslCertificate(id, body = undefined, query = {}) {
    const path = this._path('/tinosite/{id}/sslcerts/onoff', { id: id });
    return this._call('POST', path, { query, body });
  }

}
