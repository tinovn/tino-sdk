"""Languages & translations.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class LanguagesResource(Resource):
    """Languages & translations — 3 operations."""

    def get_billing_cycle_labels(self, *, key: Any = None, **query: Any) -> Any:
        """Billing cycle labels in the active language

        GET /languages/translate — no authentication required, verified against the live API.

        Return languages translate

        Query parameters:
          - key (required): lang keyword
        """
        params = self._query({"key": key}, query)
        return self._call("GET", "/languages/translate", query=params, authenticated=False)

    def get_file(self, langname, **query: Any) -> Any:
        """Get Language File

        GET /languages/file/{langname} — no authentication required, verified against the live API.

        List support tickets under my account

        Path parameters:
          - langname: lang name
        """
        path = self._path("/languages/file/{langname}", langname=langname)
        return self._call("GET", path, query=query, authenticated=False)

    def list(self, **query: Any) -> Any:
        """List language

        GET /languages — no authentication required, verified against the live API.

        Return languages details
        """
        return self._call("GET", "/languages", query=query, authenticated=False)
