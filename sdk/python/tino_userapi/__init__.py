"""Official Python SDK for the Tino UserAPI (https://api.tino.vn).

    from tino_userapi import TinoClient

    client = TinoClient()
    client.request_login_otp("you@example.com")
    client.verify_login_otp("you@example.com", "123456")
    print(client.billing.get_balance())
"""
from .client import DEFAULT_BASE_URL, SDK_VERSION, TinoClient
from .errors import (
    TinoApiError,
    TinoAuthError,
    TinoError,
    TinoNotFoundError,
    TinoRateLimitError,
    TinoTransportError,
    TinoValidationError,
)
from .http import build_url, encode_query

__version__ = SDK_VERSION

__all__ = [
    "TinoClient",
    "DEFAULT_BASE_URL",
    "SDK_VERSION",
    "TinoError",
    "TinoTransportError",
    "TinoApiError",
    "TinoAuthError",
    "TinoNotFoundError",
    "TinoRateLimitError",
    "TinoValidationError",
    "encode_query",
    "build_url",
    "__version__",
]
