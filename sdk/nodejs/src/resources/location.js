// Countries, states & cities.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Countries, states & cities — 8 operations. */
export class LocationResource extends Resource {
  /**
   * Get city by State Name V2
   *
   * GET /location/state/city-v2/{name} — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - name: State name
   * @param {string|number} name State name
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getCityByStateNameV2(name, query = {}) {
    const path = this._path('/location/state/city-v2/{name}', { name: name });
    return this._call('GET', path, { query });
  }

  /**
   * Get All citys
   *
   * GET /location/citys — no authentication required, verified against the live API.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listAllCities(query = {}) {
    return this._call('GET', '/location/citys', { query, authenticated: false });
  }

  /**
   * Get city
   *
   * GET /location/state/{id}/city — no authentication required, verified against the live API.
   *
   * Path parameters:
   *   - id: State id
   * @param {string|number} id State id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listCitiesByStateId(id, query = {}) {
    const path = this._path('/location/state/{id}/city', { id: id });
    return this._call('GET', path, { query, authenticated: false });
  }

  /**
   * Get city V2
   *
   * GET /location/state/{id}/city-v2 — no authentication required, verified against the live API.
   *
   * Path parameters:
   *   - id: State id
   * @param {string|number} id State id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listCitiesByStateIdV2(id, query = {}) {
    const path = this._path('/location/state/{id}/city-v2', { id: id });
    return this._call('GET', path, { query, authenticated: false });
  }

  /**
   * Get city by State Name
   *
   * GET /location/state/city/{name} — no authentication required, verified against the live API.
   *
   * Path parameters:
   *   - name: State name
   * @param {string|number} name State name
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listCitiesByStateName(name, query = {}) {
    const path = this._path('/location/state/city/{name}', { name: name });
    return this._call('GET', path, { query, authenticated: false });
  }

  /**
   * countries List
   *
   * GET /location/countries — no authentication required, verified against the live API.
   *
   * Return currencies details
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listCountries(query = {}) {
    return this._call('GET', '/location/countries', { query, authenticated: false });
  }

  /**
   * Get state
   *
   * GET /location/{code}/state — no authentication required, verified against the live API.
   *
   * Path parameters:
   *   - code: Country Code
   * @param {string|number} code Country Code
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listStates(code, query = {}) {
    const path = this._path('/location/{code}/state', { code: code });
    return this._call('GET', path, { query, authenticated: false });
  }

  /**
   * Get state V2
   *
   * GET /location/{code}/state-v2 — no authentication required, verified against the live API.
   *
   * Path parameters:
   *   - code: Country Code
   * @param {string|number} code Country Code
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listStatesV2(code, query = {}) {
    const path = this._path('/location/{code}/state-v2', { code: code });
    return this._call('GET', path, { query, authenticated: false });
  }

}
