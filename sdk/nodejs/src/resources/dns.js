// DNS zones & records.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** DNS zones & records — 12 operations. */
export class DnsResource extends Resource {
  /**
   * Add DNS Record
   *
   * POST /service/{service_id}/dns/{zone_id}/records — Bearer token required, verified against the live API.
   *
   * Creates a new record in the DNS zone
   *
   * Body fields:
   *   - service_id (integer): Service ID
   *   - zone_id (integer): Zone ID
   *   - name (string): Record name
   *   - ttl (integer): Record ttl
   *   - priority (integer): Priority of the record
   *   - type (string): Record type
   *   - content (string): Contents of the record
   * @param {string|number} serviceId
   * @param {string|number} zoneId
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  createRecord(serviceId, zoneId, body = undefined, query = {}) {
    const path = this._path('/service/{service_id}/dns/{zone_id}/records', { service_id: serviceId, zone_id: zoneId });
    return this._call('POST', path, { query, body });
  }

  /**
   * Add DNS Zone
   *
   * POST /service/{service_id}/dns — Bearer token required, from the API specification.
   *
   * Creates a new DNS zone
   *
   * Body fields:
   *   - service_id (integer): Service ID
   *   - name (string): Zone name
   * @param {string|number} serviceId
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  createZone(serviceId, body = undefined, query = {}) {
    const path = this._path('/service/{service_id}/dns', { service_id: serviceId });
    return this._call('POST', path, { query, body });
  }

  /**
   * Remove DNS Record
   *
   * DELETE /service/{service_id}/dns/{zone_id}/records/{record_id} — Bearer token required, verified against the live API.
   *
   * Removes the selected DNS zone record
   *
   * Path parameters:
   *   - service_id: Service ID
   *   - zone_id: Zone ID
   *   - record_id: Record ID
   * @param {string|number} serviceId Service ID
   * @param {string|number} zoneId Zone ID
   * @param {string|number} recordId Record ID
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  deleteRecord(serviceId, zoneId, recordId, body = undefined, query = {}) {
    const path = this._path('/service/{service_id}/dns/{zone_id}/records/{record_id}', { service_id: serviceId, zone_id: zoneId, record_id: recordId });
    return this._call('DELETE', path, { query, body });
  }

  /**
   * Remove DNS zone
   *
   * DELETE /service/{service_id}/dns/{zone_id} — Bearer token required, from the API specification.
   *
   * Deletes the selected DNS zone
   *
   * Path parameters:
   *   - service_id: Service ID
   *   - zone_id: Zone ID
   * @param {string|number} serviceId Service ID
   * @param {string|number} zoneId Zone ID
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  deleteZone(serviceId, zoneId, body = undefined, query = {}) {
    const path = this._path('/service/{service_id}/dns/{zone_id}', { service_id: serviceId, zone_id: zoneId });
    return this._call('DELETE', path, { query, body });
  }

  /**
   * Get DNS details
   *
   * GET /service/{service_id}/dns/{zone_id} — Bearer token required, verified against the live API.
   *
   * Returns details of the DNS zone
   *
   * Path parameters:
   *   - service_id: Service ID
   *   - zone_id: Zone ID
   * @param {string|number} serviceId Service ID
   * @param {string|number} zoneId Zone ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getZone(serviceId, zoneId, query = {}) {
    const path = this._path('/service/{service_id}/dns/{zone_id}', { service_id: serviceId, zone_id: zoneId });
    return this._call('GET', path, { query });
  }

  /**
   * Get DNS DNSSEC
   *
   * GET /service/{service_id}/dns/{zone_id}/dnssec — Bearer token required, verified against the live API.
   *
   * Returns details of the DNS DNSSEC
   *
   * Path parameters:
   *   - service_id: Service ID
   *   - zone_id: Zone ID
   * @param {string|number} serviceId Service ID
   * @param {string|number} zoneId Zone ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getZoneDnssec(serviceId, zoneId, query = {}) {
    const path = this._path('/service/{service_id}/dns/{zone_id}/dnssec', { service_id: serviceId, zone_id: zoneId });
    return this._call('GET', path, { query });
  }

  /**
   * DNS Templates
   *
   * GET /dns/templates — Bearer token required, verified against the live API.
   *
   * Returns details of the DNS zone
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listTemplates(query = {}) {
    return this._call('GET', '/dns/templates', { query });
  }

  /**
   * List DNS for service
   *
   * GET /service/{service_id}/dns — Bearer token required, verified against the live API.
   *
   * Returns a list of DNS zones under the service
   *
   * Path parameters:
   *   - service_id: Service ID
   * @param {string|number} serviceId Service ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listZones(serviceId, query = {}) {
    const path = this._path('/service/{service_id}/dns', { service_id: serviceId });
    return this._call('GET', path, { query });
  }

  /**
   * List DNS
   *
   * GET /dns — Bearer token required, verified against the live API.
   *
   * Returns a list of all DNS
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listZonesAll(query = {}) {
    return this._call('GET', '/dns', { query });
  }

  /**
   * Change Zone DNS
   *
   * GET /service/{service_id}/dns/{zone_id}/password — Bearer token required, verified against the live API.
   *
   * Returns details of the DNS zone
   *
   * Path parameters:
   *   - service_id: Service ID
   *   - zone_id: Zone ID
   * @param {string|number} serviceId Service ID
   * @param {string|number} zoneId Zone ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  resetZonePassword(serviceId, zoneId, query = {}) {
    const path = this._path('/service/{service_id}/dns/{zone_id}/password', { service_id: serviceId, zone_id: zoneId });
    return this._call('GET', path, { query });
  }

  /**
   * Edit DNS Record
   *
   * PUT /service/{service_id}/dns/{zone_id}/records/{record_id} — Bearer token required, verified against the live API.
   *
   * Edits the selected DNS zone record
   *
   * Body fields:
   *   - service_id (integer): Service ID
   *   - zone_id (integer): Zone ID
   *   - record_id (integer): Record ID
   *   - name (string): Record name
   *   - ttl (integer): Record ttl
   *   - priority (integer): Priority of the record
   *   - type (string): Record type
   *   - content (string): Contents of the record
   * @param {string|number} serviceId
   * @param {string|number} zoneId
   * @param {string|number} recordId
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateRecord(serviceId, zoneId, recordId, body = undefined, query = {}) {
    const path = this._path('/service/{service_id}/dns/{zone_id}/records/{record_id}', { service_id: serviceId, zone_id: zoneId, record_id: recordId });
    return this._call('PUT', path, { query, body });
  }

  /**
   * UPDATE DNS DNSSEC
   *
   * PUT /service/{service_id}/dns/{zone_id}/dnssec — Bearer token required, from the API specification.
   *
   * Returns details of the DNS DNSSEC
   *
   * Path parameters:
   *   - service_id: Service ID
   *   - zone_id: Zone ID
   *
   * Body fields:
   *   - widgetdo (string, required): widgetdo action
   * @param {string|number} serviceId Service ID
   * @param {string|number} zoneId Zone ID
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateZoneDnssec(serviceId, zoneId, body = undefined, query = {}) {
    const path = this._path('/service/{service_id}/dns/{zone_id}/dnssec', { service_id: serviceId, zone_id: zoneId });
    return this._call('PUT', path, { query, body });
  }

}
