// Exception hierarchy for the Tino UserAPI SDK.

/** Base class for every error thrown by this SDK. */
export class TinoError extends Error {
  constructor(message) {
    super(message);
    this.name = new.target.name;
  }
}

/** The request never produced an HTTP response (DNS, TCP, TLS, timeout, abort). */
export class TinoTransportError extends TinoError {}

/**
 * The API answered, but the answer describes a failure.
 *
 * The Tino UserAPI reports most failures with HTTP 200 plus an `error` key in the
 * body, so the HTTP status alone is not enough to detect them.
 */
export class TinoApiError extends TinoError {
  constructor(message, { status = 0, errors = [], method = '', path = '', body = null } = {}) {
    super(message);
    this.status = status;
    this.errors = errors;
    this.method = method;
    this.path = path;
    this.body = body;
  }

  toString() {
    const where = `${this.method} ${this.path}`.trim();
    return `${this.name}: [${this.status}] ${this.message}${where ? ` (${where})` : ''}`;
  }
}

/** Missing, expired or rejected credentials. */
export class TinoAuthError extends TinoApiError {}

/** The route or the addressed record does not exist. */
export class TinoNotFoundError extends TinoApiError {}

/** A rate limit was hit. */
export class TinoRateLimitError extends TinoApiError {}

/** The request was understood but the payload was rejected. */
export class TinoValidationError extends TinoApiError {}

/** Error strings the API uses to signal an authentication problem. */
export const AUTH_ERROR_CODES = new Set([
  'unauthorized',
  'token_expired',
  'invalid_token',
  'notloggedin',
]);
