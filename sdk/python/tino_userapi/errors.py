"""Exception hierarchy for the Tino UserAPI SDK."""
from __future__ import annotations

from typing import Any, List, Optional


class TinoError(Exception):
    """Base class for every error raised by this SDK."""


class TinoTransportError(TinoError):
    """The request never produced an HTTP response (DNS, TCP, TLS, timeout)."""


class TinoApiError(TinoError):
    """The API answered, but the answer describes a failure.

    The Tino UserAPI reports most failures with HTTP 200 and an ``error`` key in
    the body, so the HTTP status alone is not enough to detect them.
    """

    def __init__(
        self,
        message: str,
        *,
        status: int = 0,
        errors: Optional[List[str]] = None,
        method: str = "",
        path: str = "",
        body: Any = None,
    ) -> None:
        super().__init__(message)
        self.message = message
        self.status = status
        self.errors = errors or []
        self.method = method
        self.path = path
        self.body = body

    def __str__(self) -> str:
        where = f"{self.method} {self.path}".strip()
        return f"[{self.status}] {self.message}" + (f" ({where})" if where else "")


class TinoAuthError(TinoApiError):
    """Missing, expired or rejected credentials.

    Raised for ``unauthorized`` / ``token_expired`` once a refresh attempt has
    failed or no refresh token is available.
    """


class TinoNotFoundError(TinoApiError):
    """The route or the addressed record does not exist.

    The API answers unknown routes with HTTP 404 and ``{"error":["invalid method"]}``.
    """


class TinoRateLimitError(TinoApiError):
    """A rate limit was hit (HTTP 429, or a rate-limit message in the body)."""


class TinoValidationError(TinoApiError):
    """The request was understood but the payload was rejected."""


# Error strings the API uses to signal an authentication problem.
AUTH_ERROR_CODES = frozenset({"unauthorized", "token_expired", "invalid_token", "notloggedin"})
