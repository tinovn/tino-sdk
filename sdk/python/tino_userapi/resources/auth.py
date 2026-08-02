"""Authentication.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class AuthResource(Resource):
    """Authentication — 14 operations."""

    def change_password(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Change Password

        POST /password/change — Bearer token required, from the API specification.

        Body fields:
          - oldpassword (string): old password
          - password (string): New password
          - password2 (string): New password
        """
        return self._call("POST", "/password/change", body=self._body(payload, fields))

    def check_email(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Verify Email Exists

        POST /checkemail — no authentication required, verified against the live API.

        Return exists email client

        Body fields:
          - email (string): Your acount email address
        """
        return self._call("POST", "/checkemail", body=self._body(payload, fields), authenticated=False)

    def forgot_password(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Forgot Password

        POST /password/forgot — no authentication required, from the API specification.
        """
        return self._call("POST", "/password/forgot", body=self._body(payload, fields), authenticated=False)

    def login(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """User Login

        POST /login — no authentication required, from the API specification.

        Return Client details

        Body fields:
          - username (string): Your acount email address
          - password (string): Account password
          - remember (boolean): Remember login session with 360 day
        """
        return self._call("POST", "/login", body=self._body(payload, fields), authenticated=False)

    def login_sso(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Login

        POST /login-sso — no authentication required, from the API specification.

        Return Client
        """
        return self._call("POST", "/login-sso", body=self._body(payload, fields), authenticated=False)

    def logout(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Logout

        POST /logout — Bearer token required, from the API specification.

        Invalidate authorization token
        """
        return self._call("POST", "/logout", body=self._body(payload, fields))

    def refresh_token(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Refresh Token

        POST /token — no authentication required, verified against the live API.

        Generate new authorization token using refresh token

        Body fields:
          - refresh_token (string): Refresh token previously obtained from `POST /login`
        """
        return self._call("POST", "/token", body=self._body(payload, fields), authenticated=False)

    def request_login_otp(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """User Request OTP Login

        POST /login-otp — no authentication required, verified against the live API.

        Return Client details

        Body fields:
          - email (string): Your acount email address
        """
        return self._call("POST", "/login-otp", body=self._body(payload, fields), authenticated=False)

    def resend_verification(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Resend Verification

        POST /verification/resend — Bearer token required, from the API specification.

        Body fields:
          - code (string)
          - type (string): sms/email
        """
        return self._call("POST", "/verification/resend", body=self._body(payload, fields))

    def reset_password(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Validate Reset Password

        POST /password/passreset — no authentication required, from the API specification.

        Validate Reset Password From email link active

        Body fields:
          - activate (string): activate code
        """
        return self._call("POST", "/password/passreset", body=self._body(payload, fields), authenticated=False)

    def revoke_token(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Revoke Token

        POST /revoke — Bearer token required, from the API specification.

        Invalidate authorization and refresh token.
        Pass refresh token or call this method with valid access token

        Body fields:
          - refresh_token (string)
        """
        return self._call("POST", "/revoke", body=self._body(payload, fields))

    def signup(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Sign up

        POST /signup — no authentication required, from the API specification.

        Create new account

        Body fields:
          - type (string, one of Private, Company): Account Type
          - companyname (string): Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân
          - taxid (string): Mã số thuế
          - gender (string, one of Male, Female): Danh xưng
          - lastname (string): Last Name
          - firstname (string): First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền.
          - nationalid (string): Số CCCD/Passport
          - email (string): Email Address
          - birthday (string): Ngày sinh - Định dạng đúng dd/mm/yyyy
          - phonenumber (string): Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn.
          - country (string): Country
          - state (string): State
          - city (string): City
          - address1 (string): Address 1
          - password (string): Password
          - currency (string, one of VND): Currency
        """
        return self._call("POST", "/signup", body=self._body(payload, fields), authenticated=False)

    def verify_account(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Account Verification

        POST /verification/verify — Bearer token required, from the API specification.

        Body fields:
          - code (string)
          - type (string): sms/email
        """
        return self._call("POST", "/verification/verify", body=self._body(payload, fields))

    def verify_login_otp(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """User Login OTP

        POST /verify-login-otp — no authentication required, verified against the live API.

        Return Client details

        Body fields:
          - email (string): Your acount email address
          - otp (string): otp
        """
        return self._call("POST", "/verify-login-otp", body=self._body(payload, fields), authenticated=False)
