// Authentication.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Authentication — 14 operations. */
export class AuthResource extends Resource {
  /**
   * Change Password
   *
   * POST /password/change — Bearer token required, from the API specification.
   *
   * Body fields:
   *   - oldpassword (string): old password
   *   - password (string): New password
   *   - password2 (string): New password
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  changePassword(body = undefined, query = {}) {
    return this._call('POST', '/password/change', { query, body });
  }

  /**
   * Verify Email Exists
   *
   * POST /checkemail — no authentication required, verified against the live API.
   *
   * Return exists email client
   *
   * Body fields:
   *   - email (string): Your acount email address
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  checkEmail(body = undefined, query = {}) {
    return this._call('POST', '/checkemail', { query, body, authenticated: false });
  }

  /**
   * Forgot Password
   *
   * POST /password/forgot — no authentication required, from the API specification.
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  forgotPassword(body = undefined, query = {}) {
    return this._call('POST', '/password/forgot', { query, body, authenticated: false });
  }

  /**
   * User Login
   *
   * POST /login — no authentication required, from the API specification.
   *
   * Return Client details
   *
   * Note: The response now carries verify.phone (bool) and a phone block {status,
   * verified_at}. status is one of verified | unverified | taken_by_other | missing. Note
   * that the top-level update_required is about the profile (national id, address), not the
   * phone.
   *
   * Body fields:
   *   - username (string): Your acount email address
   *   - password (string): Account password
   *   - remember (boolean): Remember login session with 360 day
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  login(body = undefined, query = {}) {
    return this._call('POST', '/login', { query, body, authenticated: false });
  }

  /**
   * Login
   *
   * POST /login-sso — no authentication required, from the API specification.
   *
   * Return Client
   *
   * Note: The response now carries verify.phone (bool) and a phone block {status,
   * verified_at}. status is one of verified | unverified | taken_by_other | missing. Note
   * that the top-level update_required is about the profile (national id, address), not the
   * phone.
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  loginSso(body = undefined, query = {}) {
    return this._call('POST', '/login-sso', { query, body, authenticated: false });
  }

  /**
   * Logout
   *
   * POST /logout — Bearer token required, from the API specification.
   *
   * Invalidate authorization token
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  logout(body = undefined, query = {}) {
    return this._call('POST', '/logout', { query, body });
  }

  /**
   * Refresh Token
   *
   * POST /token — no authentication required, verified against the live API.
   *
   * Generate new authorization token using refresh token
   *
   * Body fields:
   *   - refresh_token (string): Refresh token previously obtained from `POST /login`
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  refreshToken(body = undefined, query = {}) {
    return this._call('POST', '/token', { query, body, authenticated: false });
  }

  /**
   * User Request OTP Login
   *
   * POST /login-otp — no authentication required, verified against the live API.
   *
   * Return Client details
   *
   * Note: via reports the delivery channel. It falls back to email when the account's phone
   * number is already verified by a different account, so an OTP is never sent to a SIM the
   * account holder may not control.
   *
   * Body fields:
   *   - email (string): Your acount email address
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  requestLoginOtp(body = undefined, query = {}) {
    return this._call('POST', '/login-otp', { query, body, authenticated: false });
  }

  /**
   * Resend Verification
   *
   * POST /verification/resend — Bearer token required, from the API specification.
   *
   * Body fields:
   *   - code (string)
   *   - type (string): sms/email
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  resendVerification(body = undefined, query = {}) {
    return this._call('POST', '/verification/resend', { query, body });
  }

  /**
   * Validate Reset Password
   *
   * POST /password/passreset — no authentication required, from the API specification.
   *
   * Validate Reset Password From email link active
   *
   * Body fields:
   *   - activate (string): activate code
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  resetPassword(body = undefined, query = {}) {
    return this._call('POST', '/password/passreset', { query, body, authenticated: false });
  }

  /**
   * Revoke Token
   *
   * POST /revoke — Bearer token required, from the API specification.
   *
   * Invalidate authorization and refresh token.
   * Pass refresh token or call this method with valid access token
   *
   * Body fields:
   *   - refresh_token (string)
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  revokeToken(body = undefined, query = {}) {
    return this._call('POST', '/revoke', { query, body });
  }

  /**
   * Sign up
   *
   * POST /signup — no authentication required, from the API specification.
   *
   * Create new account
   *
   * Note: Rejects a duplicate phone number with phone_invalid, phone_already_verified or
   * phone_already_used, so one number registers exactly one account.
   *
   * Body fields:
   *   - type (string, one of Private, Company): Account Type
   *   - companyname (string): Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân
   *   - taxid (string): Mã số thuế
   *   - gender (string, one of Male, Female): Danh xưng
   *   - lastname (string): Last Name
   *   - firstname (string): First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền.
   *   - nationalid (string): Số CCCD/Passport
   *   - email (string): Email Address
   *   - birthday (string): Ngày sinh - Định dạng đúng dd/mm/yyyy
   *   - phonenumber (string): Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn.
   *   - country (string): Country
   *   - state (string): State
   *   - city (string): City
   *   - address1 (string): Address 1
   *   - password (string): Password
   *   - currency (string, one of VND): Currency
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  signup(body = undefined, query = {}) {
    return this._call('POST', '/signup', { query, body, authenticated: false });
  }

  /**
   * Account Verification
   *
   * POST /verification/verify — Bearer token required, from the API specification.
   *
   * Body fields:
   *   - code (string)
   *   - type (string): sms/email
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  verifyAccount(body = undefined, query = {}) {
    return this._call('POST', '/verification/verify', { query, body });
  }

  /**
   * User Login OTP
   *
   * POST /verify-login-otp — no authentication required, verified against the live API.
   *
   * Return Client details
   *
   * Note: The response now carries verify.phone (bool) and a phone block {status,
   * verified_at}. status is one of verified | unverified | taken_by_other | missing. Note
   * that the top-level update_required is about the profile (national id, address), not the
   * phone.
   *
   * Body fields:
   *   - email (string): Your acount email address
   *   - otp (string): otp
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  verifyLoginOtp(body = undefined, query = {}) {
    return this._call('POST', '/verify-login-otp', { query, body, authenticated: false });
  }

}
