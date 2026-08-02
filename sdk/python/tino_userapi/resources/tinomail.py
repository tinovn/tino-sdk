"""TinoMail.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class TinomailResource(Resource):
    """TinoMail — 2 operations."""

    def get_summary(self, idtinomail, id, **query: Any) -> Any:
        """Email Summary

        GET /service/{idtinomail}/summary — Bearer token required, from the API specification.

        Email details

        Note: Only valid for a TinoMail service id. Calling it on another service type returns
        404 invalid method.
        """
        path = self._path("/service/{idtinomail}/summary", idtinomail=idtinomail, id=id)
        return self._call("GET", path, query=query)

    def list_logs(self, idtinomail, id, **query: Any) -> Any:
        """Email logs

        GET /service/{idtinomail}/logs — Bearer token required, from the API specification.

        Note: Only valid for a TinoMail service id. Calling it on another service type returns
        404 invalid method.
        """
        path = self._path("/service/{idtinomail}/logs", idtinomail=idtinomail, id=id)
        return self._call("GET", path, query=query)
