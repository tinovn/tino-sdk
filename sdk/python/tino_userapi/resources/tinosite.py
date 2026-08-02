"""TinoSite (managed WordPress).

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class TinositeResource(Resource):
    """TinoSite (managed WordPress) — 10 operations."""

    def auto_login(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Auto Login

        POST /tinosite/{id}/autologin — Bearer token required, verified against the live API.

        Body fields:
          - email (string, required)
        """
        path = self._path("/tinosite/{id}/autologin", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def backup(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Backups

        POST /tinosite/{id}/backups — Bearer token required, verified against the live API.
        """
        path = self._path("/tinosite/{id}/backups", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def create_user(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Add User

        POST /tinosite/{id}/users — Bearer token required, verified against the live API.

        Body fields:
          - email (string, required)
          - role (string, required)
          - password (string, required)
        """
        path = self._path("/tinosite/{id}/users", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def domain_pointer_action(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Domain Pointer

        POST /tinosite/{id}/domainpointers — Bearer token required, verified against the live API.
        """
        path = self._path("/tinosite/{id}/domainpointers", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def get_metrics(self, id, **query: Any) -> Any:
        """Metrics

        GET /tinosite/{id}/metrics — Bearer token required, verified against the live API.
        """
        path = self._path("/tinosite/{id}/metrics", id=id)
        return self._call("GET", path, query=query)

    def list_plugins(self, id, **query: Any) -> Any:
        """List plugins

        GET /tinosite/{id}/plugins — Bearer token required, verified against the live API.
        """
        path = self._path("/tinosite/{id}/plugins", id=id)
        return self._call("GET", path, query=query)

    def list_themes(self, id, **query: Any) -> Any:
        """List themes

        GET /tinosite/{id}/themes — Bearer token required, verified against the live API.
        """
        path = self._path("/tinosite/{id}/themes", id=id)
        return self._call("GET", path, query=query)

    def list_users(self, id, **query: Any) -> Any:
        """List User

        GET /tinosite/{id}/users — Bearer token required, verified against the live API.
        """
        path = self._path("/tinosite/{id}/users", id=id)
        return self._call("GET", path, query=query)

    def ssl_certificate_action(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Action SSL

        POST /tinosite/{id}/sslcerts — Bearer token required, verified against the live API.
        """
        path = self._path("/tinosite/{id}/sslcerts", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def toggle_ssl_certificate(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """on/off ssl certs

        POST /tinosite/{id}/sslcerts/onoff — Bearer token required, verified against the live API.
        """
        path = self._path("/tinosite/{id}/sslcerts/onoff", id=id)
        return self._call("POST", path, body=self._body(payload, fields))
