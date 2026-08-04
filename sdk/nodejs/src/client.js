// The Tino UserAPI client: transport policy, authentication and resource wiring.

import { buildUrl, send } from './http.js';
import {
  AUTH_ERROR_CODES,
  TinoApiError,
  TinoAuthError,
  TinoNotFoundError,
  TinoRateLimitError,
  TinoValidationError,
} from './errors.js';
import { RESOURCE_CLASSES } from './resources/index.js';

export const DEFAULT_BASE_URL = 'https://api.tino.vn';
export const SDK_VERSION = '1.1.0';

/**
 * Pull the error strings out of a response body, whatever shape it uses.
 *
 * Observed shapes: `{"error":["unauthorized"]}`, `{"error":"query is required"}`,
 * `{"success":false,"error":"..."}` and bare `["file_not_found"]`.
 */
function extractErrors(body) {
  let raw = null;
  if (Array.isArray(body) && body.length && body.every((item) => typeof item === 'string')) {
    raw = body;
  } else if (body && typeof body === 'object') {
    raw = body.error ?? body.errors ?? null;
  }
  if (raw === null || raw === undefined) return [];
  if (typeof raw === 'string') return [raw];
  if (Array.isArray(raw)) return raw.map(String);
  if (typeof raw === 'object') return Object.values(raw).map(String);
  return [String(raw)];
}

/**
 * Entry point for every Tino UserAPI call.
 *
 * `client.domains.list()`, `client.billing.getBalance()`, and so on — one property
 * per resource group, mirroring `spec/tino-userapi-catalog.json`.
 */
export class TinoClient {
  constructor({
    baseUrl = DEFAULT_BASE_URL,
    token = null,
    refreshToken = null,
    timeout = 60000,
    autoRefresh = true,
    userAgent = `tino-sdk-node/${SDK_VERSION}`,
    defaultHeaders = {},
    onTokenRefresh = null,
    transport = null,
  } = {}) {
    this.baseUrl = baseUrl.replace(/\/+$/, '');
    this.token = token;
    this.refreshToken = refreshToken;
    this.timeout = timeout;
    this.autoRefresh = autoRefresh;
    this.userAgent = userAgent;
    this.defaultHeaders = { ...defaultHeaders };
    this.onTokenRefresh = onTokenRefresh;
    // Overrides the built-in fetch transport. Same signature as http.send — plug in
    // undici/axios, add retries, or stub the network in tests.
    this.transport = transport ?? send;

    for (const [property, ResourceClass] of Object.entries(RESOURCE_CLASSES)) {
      this[property] = new ResourceClass(this);
    }
  }

  // ---------------------------------------------------------------- auth

  /** Store the credentials returned by a login call. */
  setTokens(token, refreshToken) {
    this.token = token;
    if (refreshToken !== undefined) this.refreshToken = refreshToken;
    if (this.onTokenRefresh && token) this.onTokenRefresh(token, this.refreshToken ?? '');
  }

  /** Password login. Stores the returned tokens on success. */
  async login(username, password, remember = false) {
    const result = await this.request('POST', '/login', {
      body: { username, password, remember },
      authenticated: false,
    });
    this.setTokens(result?.token, result?.refresh);
    return result;
  }

  /**
   * Ask Tino to send a one-time login code.
   *
   * The response reports the delivery channel in `via` (`zalo` or `email`). For
   * privacy the API answers the same way whether or not the account exists.
   */
  requestLoginOtp(email) {
    return this.request('POST', '/login-otp', { body: { email }, authenticated: false });
  }

  /** Exchange a one-time code for tokens. Stores them on success. */
  async verifyLoginOtp(email, otp) {
    const result = await this.request('POST', '/verify-login-otp', {
      body: { email, otp },
      authenticated: false,
    });
    this.setTokens(result?.token, result?.refresh);
    return result;
  }

  /** Exchange the refresh token for a new access token. */
  async refreshAccessToken() {
    if (!this.refreshToken) return null;
    const result = await this.request('POST', '/token', {
      body: { refresh_token: this.refreshToken },
      authenticated: false,
      allowRefresh: false,
    });
    const token = result?.token ?? null;
    if (token) this.setTokens(token, result?.refresh ?? this.refreshToken);
    return token;
  }

  /** Invalidate the access token server-side and forget it locally. */
  async logout() {
    try {
      return await this.request('POST', '/logout');
    } finally {
      this.token = null;
    }
  }

  // ------------------------------------------------------------- request

  /**
   * Send one API call and resolve with the decoded body.
   *
   * Pass `raw: true` to receive `{status, headers, text, json}` instead — useful
   * for endpoints that answer with a PDF or another non-JSON payload.
   */
  async request(method, path, {
    query, body, authenticated = true, allowRefresh = true, raw = false,
  } = {}) {
    const headers = { Accept: 'application/json', 'User-Agent': this.userAgent, ...this.defaultHeaders };
    if (authenticated && this.token) headers.Authorization = `Bearer ${this.token}`;

    const url = buildUrl(this.baseUrl, path, query);
    const response = await this.transport(method, url, { headers, body, timeout: this.timeout });

    const errors = extractErrors(response.json);
    const isAuthError = errors.some((code) => AUTH_ERROR_CODES.has(code)) || response.status === 401;

    if (isAuthError && allowRefresh && this.autoRefresh && this.refreshToken) {
      if (await this.refreshAccessToken()) {
        return this.request(method, path, { query, body, authenticated, allowRefresh: false, raw });
      }
    }

    if (errors.length || response.status >= 400) throwFor(response, errors, method, path);
    if (raw) return response;
    return response.json ?? response.text;
  }
}

function throwFor(response, errors, method, path) {
  const message = errors.length ? errors.join('; ') : response.text.slice(0, 200) || `HTTP ${response.status}`;
  const context = { status: response.status, errors, method, path, body: response.json };
  const lowered = errors.join(' ').toLowerCase();

  if (errors.some((code) => AUTH_ERROR_CODES.has(code)) || response.status === 401) {
    throw new TinoAuthError(message, context);
  }
  if (response.status === 404 || lowered.includes('invalid method') || lowered.includes('not_found')) {
    throw new TinoNotFoundError(message, context);
  }
  if (response.status === 429 || lowered.includes('rate limit')) {
    throw new TinoRateLimitError(message, context);
  }
  if (response.status === 400 || response.status === 422 || lowered.includes('required') || lowered.includes('_error')) {
    throw new TinoValidationError(message, context);
  }
  throw new TinoApiError(message, context);
}
