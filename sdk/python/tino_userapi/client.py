"""The Tino UserAPI client: transport policy, authentication and resource wiring."""
from __future__ import annotations

from typing import Any, Callable, Mapping, Optional

from . import http
from .errors import (
    AUTH_ERROR_CODES,
    TinoApiError,
    TinoAuthError,
    TinoNotFoundError,
    TinoRateLimitError,
    TinoValidationError,
)
from .resources import RESOURCE_CLASSES

DEFAULT_BASE_URL = "https://api.tino.vn"
SDK_VERSION = "1.0.0"


def _extract_errors(body: Any) -> list[str]:
    """Pull the error strings out of a response body, whatever shape it uses.

    Observed shapes: ``{"error": ["unauthorized"]}``, ``{"error": "query is required"}``,
    ``{"success": false, "error": "..."}`` and bare ``["file_not_found"]``.
    """
    if isinstance(body, Mapping):
        raw = body.get("error", body.get("errors"))
    elif isinstance(body, list) and body and all(isinstance(item, str) for item in body):
        raw = body
    else:
        raw = None
    if raw is None:
        return []
    if isinstance(raw, str):
        return [raw]
    if isinstance(raw, Mapping):
        return [str(value) for value in raw.values()]
    if isinstance(raw, list):
        return [str(item) for item in raw]
    return [str(raw)]


class TinoClient:
    """Entry point for every Tino UserAPI call.

    ``client.domains.list()``, ``client.billing.get_balance()``, and so on — one
    attribute per resource group, mirroring ``spec/tino-userapi-catalog.json``.

    The API answers most failures with HTTP 200 plus an ``error`` key, so this
    client inspects the body, not just the status code, and raises a typed error.
    """

    def __init__(
        self,
        *,
        base_url: str = DEFAULT_BASE_URL,
        token: Optional[str] = None,
        refresh_token: Optional[str] = None,
        timeout: float = 60.0,
        auto_refresh: bool = True,
        user_agent: str = f"tino-sdk-python/{SDK_VERSION}",
        default_headers: Optional[Mapping[str, str]] = None,
        on_token_refresh: Optional[Callable[[str, str], None]] = None,
        transport: Optional[Callable[..., http.HttpResponse]] = None,
    ) -> None:
        self.base_url = base_url.rstrip("/")
        self.token = token
        self.refresh_token = refresh_token
        self.timeout = timeout
        self.auto_refresh = auto_refresh
        self.user_agent = user_agent
        self.default_headers = dict(default_headers or {})
        self.on_token_refresh = on_token_refresh
        # Overrides the built-in urllib transport. Same signature as http.send —
        # plug in requests/httpx, add retries, or stub the network in tests.
        self.transport = transport or http.send

        for attribute, resource_class in RESOURCE_CLASSES.items():
            setattr(self, attribute, resource_class(self))

    # ------------------------------------------------------------------ auth

    def set_tokens(self, token: Optional[str], refresh_token: Optional[str] = None) -> None:
        """Store the credentials returned by a login call."""
        self.token = token
        if refresh_token is not None:
            self.refresh_token = refresh_token
        if self.on_token_refresh and token:
            self.on_token_refresh(token, self.refresh_token or "")

    def login(self, username: str, password: str, remember: bool = False) -> Any:
        """Password login. Stores the returned tokens on success."""
        result = self.request(
            "POST", "/login",
            body={"username": username, "password": password, "remember": remember},
            authenticated=False,
        )
        self.set_tokens(result.get("token"), result.get("refresh"))
        return result

    def request_login_otp(self, email: str) -> Any:
        """Ask Tino to send a one-time login code.

        The response reports the delivery channel in ``via`` (``zalo`` or ``email``).
        For privacy the API answers the same way whether or not the account exists.
        """
        return self.request("POST", "/login-otp", body={"email": email}, authenticated=False)

    def verify_login_otp(self, email: str, otp: str) -> Any:
        """Exchange a one-time code for tokens. Stores them on success."""
        result = self.request(
            "POST", "/verify-login-otp",
            body={"email": email, "otp": otp},
            authenticated=False,
        )
        self.set_tokens(result.get("token"), result.get("refresh"))
        return result

    def refresh_access_token(self) -> Optional[str]:
        """Exchange the refresh token for a new access token."""
        if not self.refresh_token:
            return None
        result = self.request(
            "POST", "/token",
            body={"refresh_token": self.refresh_token},
            authenticated=False,
            allow_refresh=False,
        )
        token = result.get("token") if isinstance(result, Mapping) else None
        if token:
            self.set_tokens(token, result.get("refresh") or self.refresh_token)
        return token

    def logout(self) -> Any:
        """Invalidate the access token server-side and forget it locally."""
        try:
            return self.request("POST", "/logout")
        finally:
            self.token = None

    # --------------------------------------------------------------- request

    def request(
        self,
        method: str,
        path: str,
        *,
        query: Optional[Mapping[str, Any]] = None,
        body: Optional[Any] = None,
        authenticated: bool = True,
        allow_refresh: bool = True,
        raw: bool = False,
    ) -> Any:
        """Send one API call and return the decoded body.

        Set ``raw=True`` to receive the :class:`~tino_userapi.http.HttpResponse`
        instead — useful for endpoints that answer with a PDF or another
        non-JSON payload.
        """
        headers = {
            "Accept": "application/json",
            "User-Agent": self.user_agent,
            **self.default_headers,
        }
        if authenticated and self.token:
            headers["Authorization"] = f"Bearer {self.token}"

        url = http.build_url(self.base_url, path, query)
        response = self.transport(method, url, headers=headers, body=body, timeout=self.timeout)

        errors = _extract_errors(response.json)
        is_auth_error = any(code in AUTH_ERROR_CODES for code in errors) or response.status == 401

        if is_auth_error and allow_refresh and self.auto_refresh and self.refresh_token:
            if self.refresh_access_token():
                return self.request(
                    method, path, query=query, body=body,
                    authenticated=authenticated, allow_refresh=False, raw=raw,
                )

        if raw:
            if errors or response.status >= 400:
                self._raise(response, errors, method, path)
            return response

        if errors or response.status >= 400:
            self._raise(response, errors, method, path)
        return response.json if response.json is not None else response.text

    # ---------------------------------------------------------------- errors

    @staticmethod
    def _raise(response: http.HttpResponse, errors: list[str], method: str, path: str) -> None:
        message = "; ".join(errors) if errors else (response.text[:200] or f"HTTP {response.status}")
        kwargs = dict(
            status=response.status, errors=errors, method=method, path=path, body=response.json,
        )
        lowered = " ".join(errors).lower()
        if any(code in AUTH_ERROR_CODES for code in errors) or response.status == 401:
            raise TinoAuthError(message, **kwargs)
        if response.status == 404 or "invalid method" in lowered or "not_found" in lowered:
            raise TinoNotFoundError(message, **kwargs)
        if response.status == 429 or "rate limit" in lowered:
            raise TinoRateLimitError(message, **kwargs)
        if response.status in (400, 422) or "required" in lowered or "_error" in lowered:
            raise TinoValidationError(message, **kwargs)
        raise TinoApiError(message, **kwargs)
