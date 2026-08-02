"""Offline tests for the parts of the SDK that encode the API's quirks.

No network access: the transport is stubbed so the tests assert on what the client
*would* send and on how it interprets what comes back.
"""
from __future__ import annotations

import os
import sys
from typing import Any, List

import pytest

sys.path.insert(0, os.path.join(os.path.dirname(__file__), ".."))

from tino_userapi import TinoClient, http  # noqa: E402
from tino_userapi.errors import (  # noqa: E402
    TinoAuthError,
    TinoNotFoundError,
    TinoValidationError,
)


class FakeTransport:
    """Replaces http.send and records every call."""

    def __init__(self, *responses: Any) -> None:
        self.responses = list(responses)
        self.calls: List[dict] = []

    def __call__(self, method, url, *, headers, body=None, timeout=60.0):
        self.calls.append({"method": method, "url": url, "headers": headers, "body": body})
        status, payload = self.responses.pop(0)
        import json as _json
        text = _json.dumps(payload)
        return http.HttpResponse(status, {}, text.encode(), text, payload)


@pytest.fixture
def transport(monkeypatch):
    def install(*responses):
        fake = FakeTransport(*responses)
        monkeypatch.setattr(http, "send", fake)
        return fake
    return install


# --------------------------------------------------------------- query encoding

@pytest.mark.parametrize("params,expected", [
    ({"page": 0}, "page=0"),
    ({"page": None, "perpage": 25}, "perpage=25"),
    ({"active": True, "hidden": False}, "active=1&hidden=0"),
    ({"filter": {"hide_cancelled": 1}}, "filter%5Bhide_cancelled%5D=1"),
    ({"tlds": [".com", ".vn"]}, "tlds%5B%5D=.com&tlds%5B%5D=.vn"),
])
def test_encode_query(params, expected):
    assert http.encode_query(params) == expected


def test_path_params_are_percent_encoded(transport):
    fake = transport((200, []))
    client = TinoClient()
    client.location.list_cities_by_state_name("Thành phố Hồ Chí Minh")
    assert "Th%C3%A0nh%20ph%E1%BB%91" in fake.calls[0]["url"]


# ------------------------------------------------------------- error detection

def test_error_in_body_with_http_200_raises(transport):
    transport((200, {"error": ["unauthorized"]}))
    client = TinoClient(token="t")          # no refresh token: no retry
    with pytest.raises(TinoAuthError):
        client.account.get_details()


def test_unknown_route_raises_not_found(transport):
    transport((404, {"error": ["invalid method"]}))
    with pytest.raises(TinoNotFoundError):
        TinoClient(token="t").services.list_os_templates(1)


def test_string_error_next_to_success_flag(transport):
    transport((200, {"success": False, "error": "query is required"}))
    with pytest.raises(TinoValidationError) as excinfo:
        TinoClient(token="t").domains.suggest(query="")
    assert excinfo.value.errors == ["query is required"]


def test_bare_array_error(transport):
    transport((200, ["file_not_found"]))
    with pytest.raises(TinoNotFoundError):
        TinoClient(token="t").support.get_attachment("1")


def test_successful_body_is_returned_untouched(transport):
    payload = {"success": True, "invoices": [{"id": "1", "total": "10.00"}]}
    transport((200, payload))
    assert TinoClient(token="t").billing.list_invoices() == payload


# ----------------------------------------------------------- token management

def test_auth_error_triggers_one_refresh_then_replays(transport):
    fake = transport(
        (200, {"error": ["token_expired"]}),          # original call
        (200, {"token": "new-access", "refresh": "new-refresh"}),
        (200, {"details": {"acc_balance": 1}}),       # replay
    )
    saved = {}
    client = TinoClient(
        token="old", refresh_token="old-refresh",
        on_token_refresh=lambda t, r: saved.update(token=t, refresh=r),
    )
    assert client.billing.get_balance() == {"details": {"acc_balance": 1}}
    assert client.token == "new-access"
    assert saved == {"token": "new-access", "refresh": "new-refresh"}
    assert fake.calls[1]["url"].endswith("/token")
    assert fake.calls[2]["headers"]["Authorization"] == "Bearer new-access"


def test_refresh_is_not_retried_forever(transport):
    transport(
        (200, {"error": ["token_expired"]}),
        (200, {"error": ["refresh_token_invalid"]}),
    )
    client = TinoClient(token="old", refresh_token="dead")
    with pytest.raises(Exception):
        client.billing.get_balance()


def test_verify_login_otp_stores_both_tokens(transport):
    transport((200, {"token": "a", "refresh": "b", "client": {"id": "1"}}))
    client = TinoClient()
    client.verify_login_otp("user@example.com", "123456")
    assert (client.token, client.refresh_token) == ("a", "b")


def test_public_endpoints_send_no_authorization_header(transport):
    fake = transport((200, {}))
    TinoClient(token="secret").location.list_countries()
    assert "Authorization" not in fake.calls[0]["headers"]


def test_protected_endpoints_send_the_token(transport):
    fake = transport((200, {}))
    TinoClient(token="secret").account.get_details()
    assert fake.calls[0]["headers"]["Authorization"] == "Bearer secret"


# ------------------------------------------------------------- body handling

def test_body_fields_merge_over_explicit_body(transport):
    fake = transport((200, {}))
    TinoClient(token="t").support.create_ticket(body={"dept_id": 2}, subject="Hi")
    assert fake.calls[0]["body"] == {"dept_id": 2, "subject": "Hi"}


def test_no_body_is_sent_when_none_supplied(transport):
    fake = transport((200, {}))
    TinoClient(token="t").services.manual_renew(1)
    assert fake.calls[0]["body"] is None
