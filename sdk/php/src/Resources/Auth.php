<?php

declare(strict_types=1);

/**
 * Authentication.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Authentication — 14 operations.
 */
class Auth extends Resource
{
    /**
     * Change Password
     *
     * POST /password/change — Bearer token required, from the API specification.
     *
     * Body fields:
     *   - oldpassword (string): old password
     *   - password (string): New password
     *   - password2 (string): New password
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function changePassword(array $body = [], array $query = [])
    {
        return $this->call('POST', '/password/change', ['query' => $query, 'body' => $body]);
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
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function checkEmail(array $body = [], array $query = [])
    {
        return $this->call('POST', '/checkemail', ['query' => $query, 'body' => $body, 'authenticated' => false]);
    }

    /**
     * Forgot Password
     *
     * POST /password/forgot — no authentication required, from the API specification.
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function forgotPassword(array $body = [], array $query = [])
    {
        return $this->call('POST', '/password/forgot', ['query' => $query, 'body' => $body, 'authenticated' => false]);
    }

    /**
     * User Login
     *
     * POST /login — no authentication required, from the API specification.
     *
     * Return Client details
     *
     * Body fields:
     *   - username (string): Your acount email address
     *   - password (string): Account password
     *   - remember (boolean): Remember login session with 360 day
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function login(array $body = [], array $query = [])
    {
        return $this->call('POST', '/login', ['query' => $query, 'body' => $body, 'authenticated' => false]);
    }

    /**
     * Login
     *
     * POST /login-sso — no authentication required, from the API specification.
     *
     * Return Client
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function loginSso(array $body = [], array $query = [])
    {
        return $this->call('POST', '/login-sso', ['query' => $query, 'body' => $body, 'authenticated' => false]);
    }

    /**
     * Logout
     *
     * POST /logout — Bearer token required, from the API specification.
     *
     * Invalidate authorization token
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function logout(array $body = [], array $query = [])
    {
        return $this->call('POST', '/logout', ['query' => $query, 'body' => $body]);
    }

    /**
     * Refresh Token
     *
     * POST /token — no authentication required, from the API specification.
     *
     * Generate new authorization token using refresh token
     *
     * Body fields:
     *   - refresh_token (string): Refresh token previously obtained from `POST /login`
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function refreshToken(array $body = [], array $query = [])
    {
        return $this->call('POST', '/token', ['query' => $query, 'body' => $body, 'authenticated' => false]);
    }

    /**
     * User Request OTP Login
     *
     * POST /login-otp — no authentication required, verified against the live API.
     *
     * Return Client details
     *
     * Body fields:
     *   - email (string): Your acount email address
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function requestLoginOtp(array $body = [], array $query = [])
    {
        return $this->call('POST', '/login-otp', ['query' => $query, 'body' => $body, 'authenticated' => false]);
    }

    /**
     * Resend Verification
     *
     * POST /verification/resend — Bearer token required, from the API specification.
     *
     * Body fields:
     *   - code (string)
     *   - type (string): sms/email
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function resendVerification(array $body = [], array $query = [])
    {
        return $this->call('POST', '/verification/resend', ['query' => $query, 'body' => $body]);
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
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function resetPassword(array $body = [], array $query = [])
    {
        return $this->call('POST', '/password/passreset', ['query' => $query, 'body' => $body, 'authenticated' => false]);
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
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function revokeToken(array $body = [], array $query = [])
    {
        return $this->call('POST', '/revoke', ['query' => $query, 'body' => $body]);
    }

    /**
     * Sign up
     *
     * POST /signup — no authentication required, from the API specification.
     *
     * Create new account
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
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function signup(array $body = [], array $query = [])
    {
        return $this->call('POST', '/signup', ['query' => $query, 'body' => $body, 'authenticated' => false]);
    }

    /**
     * Account Verification
     *
     * POST /verification/verify — Bearer token required, from the API specification.
     *
     * Body fields:
     *   - code (string)
     *   - type (string): sms/email
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function verifyAccount(array $body = [], array $query = [])
    {
        return $this->call('POST', '/verification/verify', ['query' => $query, 'body' => $body]);
    }

    /**
     * User Login OTP
     *
     * POST /verify-login-otp — no authentication required, verified against the live API.
     *
     * Return Client details
     *
     * Body fields:
     *   - email (string): Your acount email address
     *   - otp (string): otp
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function verifyLoginOtp(array $body = [], array $query = [])
    {
        return $this->call('POST', '/verify-login-otp', ['query' => $query, 'body' => $body, 'authenticated' => false]);
    }

}
