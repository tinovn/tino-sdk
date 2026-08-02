"""Shared plumbing for the generated resource classes."""
from __future__ import annotations

from typing import Any, Dict, Mapping, Optional

from ..http import encode_path_param


class Resource:
    """Base class for every resource group (``client.domains``, ``client.billing``, ...)."""

    def __init__(self, client: Any) -> None:
        self._client = client

    def _call(
        self,
        method: str,
        path: str,
        *,
        query: Optional[Mapping[str, Any]] = None,
        body: Optional[Any] = None,
        authenticated: bool = True,
        raw: bool = False,
    ) -> Any:
        return self._client.request(
            method, path, query=query, body=body, authenticated=authenticated, raw=raw,
        )

    @staticmethod
    def _path(template: str, **params: Any) -> str:
        """Fill ``{placeholder}`` segments, percent-encoding each value."""
        path = template
        for name, value in params.items():
            path = path.replace("{" + name + "}", encode_path_param(value))
        return path

    @staticmethod
    def _body(body: Optional[Mapping[str, Any]], fields: Mapping[str, Any]) -> Optional[Dict[str, Any]]:
        """Merge an explicit ``body`` dict with keyword fields; keyword fields win.

        Returns ``None`` when neither was supplied, so the request goes out
        without a JSON payload.
        """
        if body is None and not fields:
            return None
        merged: Dict[str, Any] = dict(body or {})
        merged.update(fields)
        return merged

    @staticmethod
    def _query(explicit: Mapping[str, Any], extra: Mapping[str, Any]) -> Dict[str, Any]:
        """Merge named query arguments with free-form ``**kwargs``, dropping ``None``."""
        merged: Dict[str, Any] = {k: v for k, v in explicit.items() if v is not None}
        merged.update({k: v for k, v in extra.items() if v is not None})
        return merged
