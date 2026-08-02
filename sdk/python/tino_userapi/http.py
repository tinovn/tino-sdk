"""Zero-dependency HTTP transport and query-string encoding."""
from __future__ import annotations

import gzip
import json
import urllib.error
import urllib.parse
import urllib.request
from typing import Any, Dict, Mapping, Optional, Tuple

from .errors import TinoTransportError


def encode_query(params: Mapping[str, Any]) -> str:
    """Encode a query mapping the way the Tino UserAPI expects it.

    * ``None`` values are dropped.
    * ``bool`` becomes ``1`` / ``0``.
    * Nested mappings become ``filter[key]=value`` (PHP-style bracket notation).
    * Sequences become repeated ``key[]=value`` pairs.
    """
    pairs: list[Tuple[str, str]] = []

    def add(key: str, value: Any) -> None:
        if value is None:
            return
        if isinstance(value, bool):
            pairs.append((key, "1" if value else "0"))
        elif isinstance(value, Mapping):
            for sub_key, sub_value in value.items():
                add(f"{key}[{sub_key}]", sub_value)
        elif isinstance(value, (list, tuple, set)):
            for item in value:
                add(f"{key}[]", item)
        else:
            pairs.append((key, str(value)))

    for name, value in params.items():
        add(name, value)
    return urllib.parse.urlencode(pairs)


def build_url(base_url: str, path: str, query: Optional[Mapping[str, Any]] = None) -> str:
    url = base_url.rstrip("/") + "/" + path.lstrip("/")
    if query:
        encoded = encode_query(query)
        if encoded:
            url += ("&" if "?" in url else "?") + encoded
    return url


def encode_path_param(value: Any) -> str:
    """Percent-encode a value destined for a path segment."""
    return urllib.parse.quote(str(value), safe="")


class HttpResponse:
    """One HTTP response. ``content`` keeps the undecoded bytes for binary payloads."""

    __slots__ = ("status", "headers", "content", "text", "json")

    def __init__(self, status: int, headers: Dict[str, str], content: bytes, text: str, parsed: Any) -> None:
        self.status = status
        self.headers = headers
        self.content = content
        self.text = text
        self.json = parsed


def send(
    method: str,
    url: str,
    *,
    headers: Mapping[str, str],
    body: Optional[Any] = None,
    timeout: float = 60.0,
) -> HttpResponse:
    """Perform one HTTP round trip and parse the JSON body when possible."""
    payload = None
    request_headers = dict(headers)
    if body is not None:
        payload = json.dumps(body, ensure_ascii=False).encode("utf-8")
        request_headers.setdefault("Content-Type", "application/json")

    request = urllib.request.Request(url, data=payload, headers=request_headers, method=method.upper())
    try:
        with urllib.request.urlopen(request, timeout=timeout) as response:
            raw = response.read()
            status = response.status
            response_headers = {k.lower(): v for k, v in response.headers.items()}
    except urllib.error.HTTPError as exc:  # 4xx / 5xx still carry a useful body
        raw = exc.read()
        status = exc.code
        response_headers = {k.lower(): v for k, v in (exc.headers or {}).items()}
    except urllib.error.URLError as exc:
        raise TinoTransportError(f"{method} {url} failed: {exc.reason}") from exc
    except OSError as exc:  # socket timeouts and similar
        raise TinoTransportError(f"{method} {url} failed: {exc}") from exc

    if response_headers.get("content-encoding") == "gzip":
        raw = gzip.decompress(raw)
    text = raw.decode("utf-8", "replace")

    parsed: Any = None
    if text:
        try:
            parsed = json.loads(text, strict=False)
        except ValueError:
            parsed = None
    return HttpResponse(status, response_headers, raw, text, parsed)
