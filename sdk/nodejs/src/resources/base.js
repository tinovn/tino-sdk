// Shared plumbing for the generated resource classes.

import { encodePathParam } from '../http.js';

/** Base class for every resource group (`client.domains`, `client.billing`, ...). */
export class Resource {
  constructor(client) {
    this._client = client;
  }

  _call(method, path, { query, body, authenticated = true, raw = false } = {}) {
    const options = { authenticated, raw };
    if (query && Object.keys(query).length) options.query = query;
    if (body !== undefined && body !== null) options.body = body;
    return this._client.request(method, path, options);
  }

  /** Fill `{placeholder}` segments, percent-encoding each value. */
  _path(template, params = {}) {
    let path = template;
    for (const [name, value] of Object.entries(params)) {
      path = path.replace(`{${name}}`, encodePathParam(value));
    }
    return path;
  }
}
