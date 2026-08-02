// Languages & translations.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Languages & translations — 3 operations. */
export class LanguagesResource extends Resource {
  /**
   * Billing cycle labels in the active language
   *
   * GET /languages/translate — no authentication required, verified against the live API.
   *
   * Return languages translate
   *
   * Path parameters:
   *   - key: lang keyword
   * @param {string|number} key lang keyword
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getBillingCycleLabels(key, query = {}) {
    const path = this._path('/languages/translate', { key: key });
    return this._call('GET', path, { query, authenticated: false });
  }

  /**
   * Get Language File
   *
   * GET /languages/file/{langname} — no authentication required, verified against the live API.
   *
   * List support tickets under my account
   *
   * Path parameters:
   *   - langname: lang name
   * @param {string|number} langname lang name
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getFile(langname, query = {}) {
    const path = this._path('/languages/file/{langname}', { langname: langname });
    return this._call('GET', path, { query, authenticated: false });
  }

  /**
   * List language
   *
   * GET /languages — no authentication required, verified against the live API.
   *
   * Return languages details
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  list(query = {}) {
    return this._call('GET', '/languages', { query, authenticated: false });
  }

}
