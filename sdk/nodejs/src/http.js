// Query-string encoding and the single fetch round trip.

import { TinoTransportError } from './errors.js';

/**
 * Encode a query object the way the Tino UserAPI expects it.
 *
 * - `null` / `undefined` values are dropped.
 * - booleans become `1` / `0`.
 * - nested objects become `filter[key]=value` (PHP-style bracket notation).
 * - arrays become repeated `key[]=value` pairs.
 *
 * @param {Record<string, any>} params
 * @returns {string}
 */
export function encodeQuery(params) {
  const parts = [];

  const add = (key, value) => {
    if (value === null || value === undefined) return;
    if (typeof value === 'boolean') {
      parts.push([key, value ? '1' : '0']);
    } else if (Array.isArray(value)) {
      for (const item of value) add(`${key}[]`, item);
    } else if (typeof value === 'object') {
      for (const [subKey, subValue] of Object.entries(value)) add(`${key}[${subKey}]`, subValue);
    } else {
      parts.push([key, String(value)]);
    }
  };

  for (const [name, value] of Object.entries(params ?? {})) add(name, value);
  return parts.map(([k, v]) => `${encodeURIComponent(k)}=${encodeURIComponent(v)}`).join('&');
}

/**
 * @param {string} baseUrl
 * @param {string} path
 * @param {Record<string, any>} [query]
 * @returns {string}
 */
export function buildUrl(baseUrl, path, query) {
  let url = `${baseUrl.replace(/\/+$/, '')}/${String(path).replace(/^\/+/, '')}`;
  const encoded = encodeQuery(query);
  if (encoded) url += (url.includes('?') ? '&' : '?') + encoded;
  return url;
}

/** Percent-encode a value destined for a path segment. */
export function encodePathParam(value) {
  return encodeURIComponent(String(value));
}

/**
 * Perform one HTTP round trip and parse the JSON body when possible.
 *
 * `content` keeps the undecoded bytes so binary payloads (PDF, certificates) survive.
 *
 * @returns {Promise<{status: number, headers: Headers, content: Buffer, text: string, json: any}>}
 */
export async function send(method, url, { headers, body, timeout = 60000 } = {}) {
  const controller = new AbortController();
  const timer = setTimeout(() => controller.abort(), timeout);

  const init = { method: method.toUpperCase(), headers: { ...headers }, signal: controller.signal };
  if (body !== undefined && body !== null) {
    init.body = JSON.stringify(body);
    init.headers['Content-Type'] = init.headers['Content-Type'] ?? 'application/json';
  }

  let response;
  try {
    response = await fetch(url, init);
  } catch (error) {
    const reason = error?.name === 'AbortError' ? `timed out after ${timeout}ms` : error?.message;
    throw new TinoTransportError(`${method} ${url} failed: ${reason}`);
  } finally {
    clearTimeout(timer);
  }

  const content = Buffer.from(await response.arrayBuffer());
  const text = content.toString('utf8');
  let json = null;
  if (text) {
    try {
      json = JSON.parse(text);
    } catch {
      json = null;
    }
  }
  return { status: response.status, headers: response.headers, content, text, json };
}
