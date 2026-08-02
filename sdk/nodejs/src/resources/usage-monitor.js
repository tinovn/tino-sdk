// Proxmox2 usage monitor.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Proxmox2 usage monitor — 5 operations. */
export class UsageMonitorResource extends Resource {
  /**
   * Get usage for a specific account
   *
   * GET /usage-monitor/account/{id} — Bearer token required, from the API specification.
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getAccountUsage(id, query = {}) {
    const path = this._path('/usage-monitor/account/{id}', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Get node status for a server (via Proxmox2 module)
   *
   * GET /usage-monitor/nodes/{server_id} — Bearer token required, from the API specification.
   * @param {string|number} serverId
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getNodeStatus(serverId, query = {}) {
    const path = this._path('/usage-monitor/nodes/{server_id}', { server_id: serverId });
    return this._call('GET', path, { query });
  }

  /**
   * Get overage list with custom thresholds
   *
   * POST /usage-monitor/overage — Bearer token required, from the API specification.
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listOverage(body = undefined, query = {}) {
    return this._call('POST', '/usage-monitor/overage', { query, body });
  }

  /**
   * List available Proxmox2 products
   *
   * GET /usage-monitor/products — Bearer token required, verified against the live API.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listProducts(query = {}) {
    return this._call('GET', '/usage-monitor/products', { query });
  }

  /**
   * Scan by product IDs and return full usage summary
   *
   * POST /usage-monitor/scan — Bearer token required, from the API specification.
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  scan(body = undefined, query = {}) {
    return this._call('POST', '/usage-monitor/scan', { query, body });
  }

}
