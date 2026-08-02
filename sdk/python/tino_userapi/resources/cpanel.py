"""cPanel service actions.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class CpanelResource(Resource):
    """cPanel service actions — 7 operations."""

    def change_password(self, id, **query: Any) -> Any:
        """Change Passs cPanel

        GET /service/cpanel2/{id}/changepasss — Bearer token required, verified against the live API.

        Get the details of a particular virtual server
        """
        path = self._path("/service/cpanel2/{id}/changepasss", id=id)
        return self._call("GET", path, query=query)

    def change_primary_domain(self, id, domain, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Change Domain cPanel

        POST /service/cpanel2/{id}/changedomain — Bearer token required, from the API specification.
        """
        path = self._path("/service/cpanel2/{id}/changedomain", id=id, domain=domain)
        return self._call("POST", path, body=self._body(body, fields))

    def get_login_link(self, id, **query: Any) -> Any:
        """Get cPanel link login

        GET /service/cpanel2/{id}/login — Bearer token required, verified against the live API.

        Get the details of a particular virtual server
        """
        path = self._path("/service/cpanel2/{id}/login", id=id)
        return self._call("GET", path, query=query)

    def get_php_my_admin_link(self, id, **query: Any) -> Any:
        """Get cPanel phpmyadmin login

        GET /service/cpanel2/{id}/phpmyadminlogin — Bearer token required, verified against the live API.

        Get the details of a particular virtual server
        """
        path = self._path("/service/cpanel2/{id}/phpmyadminlogin", id=id)
        return self._call("GET", path, query=query)

    def get_statistics(self, id, **query: Any) -> Any:
        """Get cPanel statistics

        GET /service/cpanel2/{id}/statistics — Bearer token required, verified against the live API.

        Get the details of a particular virtual server
        """
        path = self._path("/service/cpanel2/{id}/statistics", id=id)
        return self._call("GET", path, query=query)

    def reset_account(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Reset Acount cPanel

        POST /service/cpanel2/{id}/resetacount — Bearer token required, from the API specification.
        """
        path = self._path("/service/cpanel2/{id}/resetacount", id=id)
        return self._call("POST", path, body=self._body(body, fields))

    def unblock_ip(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Get cPanel unblock ip

        POST /service/cpanel2/{id}/unblock — Bearer token required, from the API specification.

        Get the details of a particular virtual server
        """
        path = self._path("/service/cpanel2/{id}/unblock", id=id)
        return self._call("POST", path, body=self._body(body, fields))
