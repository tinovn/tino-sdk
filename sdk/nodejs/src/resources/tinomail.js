// TinoMail.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** TinoMail — 2 operations. */
export class TinomailResource extends Resource {
  /**
   * Email Summary
   *
   * GET /service/{idtinomail}/summary — Bearer token required, from the API specification.
   *
   * Email details
   *
   * Note: Only valid for a TinoMail service id. Calling it on another service type returns
   * 404 invalid method.
   * @param {string|number} idtinomail
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getSummary(idtinomail, id, query = {}) {
    const path = this._path('/service/{idtinomail}/summary', { idtinomail: idtinomail, id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Email logs
   *
   * GET /service/{idtinomail}/logs — Bearer token required, from the API specification.
   *
   * Note: Only valid for a TinoMail service id. Calling it on another service type returns
   * 404 invalid method.
   * @param {string|number} idtinomail
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listLogs(idtinomail, id, query = {}) {
    const path = this._path('/service/{idtinomail}/logs', { idtinomail: idtinomail, id: id });
    return this._call('GET', path, { query });
  }

}
