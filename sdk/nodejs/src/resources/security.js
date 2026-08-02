// Account security (SSH keys, IP access).
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Account security (SSH keys, IP access) — 5 operations. */
export class SecurityResource extends Resource {
  /**
   * Add IP access
   *
   * POST /security/ipaccess — Bearer token required, verified against the live API.
   *
   * all - keyword matching all
   * IPs xxx.xxx.xxx.xxx - IP single
   * xxx.xxx.xxx.xxx/M - IP with Mask in CIDR format
   * xxx.xxx.xxx.xxx/mmm.mmm.mmm.mmm - IP with Mask in dotted quad format
   *
   * Note: The first rule switches the account into whitelist mode: every address that is not
   * listed is refused, including the one you are calling from. Add your own address before
   * adding any other, and remove it last.
   *
   * Body fields:
   *   - rule (string): Rule Access
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  addIpAccess(body = undefined, query = {}) {
    return this._call('POST', '/security/ipaccess', { query, body });
  }

  /**
   * Add SSH Key
   *
   * POST /security/sshkey — Bearer token required, from the API specification.
   *
   * Body fields:
   *   - ssh_key_name (string): SSH Name
   *   - ssh_key_key (string): SSh Key
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  addSshKey(body = undefined, query = {}) {
    return this._call('POST', '/security/sshkey', { query, body });
  }

  /**
   * List security
   *
   * GET /security — Bearer token required, verified against the live API.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  get(query = {}) {
    return this._call('GET', '/security', { query });
  }

  /**
   * Remove IP access
   *
   * DELETE /security/ipaccess/{id} — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Rule id
   * @param {string|number} id Rule id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  removeIpAccess(id, body = undefined, query = {}) {
    const path = this._path('/security/ipaccess/{id}', { id: id });
    return this._call('DELETE', path, { query, body });
  }

  /**
   * Remove SSH Key
   *
   * DELETE /security/sshkey/{id} — Bearer token required, from the API specification.
   *
   * Đang test chưa xong
   *
   * Path parameters:
   *   - id: sshkey id
   * @param {string|number} id sshkey id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  removeSshKey(id, body = undefined, query = {}) {
    const path = this._path('/security/sshkey/{id}', { id: id });
    return this._call('DELETE', path, { query, body });
  }

}
