"""Account security (SSH keys, IP access).

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class SecurityResource(Resource):
    """Account security (SSH keys, IP access) — 5 operations."""

    def add_ip_access(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Add IP access

        POST /security/ipaccess — Bearer token required, from the API specification.

        all - keyword matching all
        IPs xxx.xxx.xxx.xxx - IP single
        xxx.xxx.xxx.xxx/M - IP with Mask in CIDR format
        xxx.xxx.xxx.xxx/mmm.mmm.mmm.mmm - IP with Mask in dotted quad format

        Body fields:
          - rule (string): Rule Access
        """
        return self._call("POST", "/security/ipaccess", body=self._body(body, fields))

    def add_ssh_key(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Add SSH Key

        POST /security/sshkey — Bearer token required, from the API specification.

        Body fields:
          - ssh_key_name (string): SSH Name
          - ssh_key_key (string): SSh Key
        """
        return self._call("POST", "/security/sshkey", body=self._body(body, fields))

    def get(self, **query: Any) -> Any:
        """List security

        GET /security — Bearer token required, verified against the live API.
        """
        return self._call("GET", "/security", query=query)

    def remove_ip_access(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Remove IP access

        DELETE /security/ipaccess/{id} — Bearer token required, from the API specification.

        Path parameters:
          - id: Rule id
        """
        path = self._path("/security/ipaccess/{id}", id=id)
        return self._call("DELETE", path, body=self._body(body, fields))

    def remove_ssh_key(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Remove SSH Key

        DELETE /security/sshkey/{id} — Bearer token required, from the API specification.

        Đang test chưa xong

        Path parameters:
          - id: sshkey id
        """
        path = self._path("/security/sshkey/{id}", id=id)
        return self._call("DELETE", path, body=self._body(body, fields))
