"""Proxmox2 usage monitor.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class UsageMonitorResource(Resource):
    """Proxmox2 usage monitor — 5 operations."""

    def get_account_usage(self, id, **query: Any) -> Any:
        """Get usage for a specific account

        GET /usage-monitor/account/{id} — Bearer token required, from the API specification.
        """
        path = self._path("/usage-monitor/account/{id}", id=id)
        return self._call("GET", path, query=query)

    def get_node_status(self, server_id, **query: Any) -> Any:
        """Get node status for a server (via Proxmox2 module)

        GET /usage-monitor/nodes/{server_id} — Bearer token required, from the API specification.
        """
        path = self._path("/usage-monitor/nodes/{server_id}", server_id=server_id)
        return self._call("GET", path, query=query)

    def list_overage(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Get overage list with custom thresholds

        POST /usage-monitor/overage — Bearer token required, from the API specification.
        """
        return self._call("POST", "/usage-monitor/overage", body=self._body(body, fields))

    def list_products(self, **query: Any) -> Any:
        """List available Proxmox2 products

        GET /usage-monitor/products — Bearer token required, verified against the live API.
        """
        return self._call("GET", "/usage-monitor/products", query=query)

    def scan(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Scan by product IDs and return full usage summary

        POST /usage-monitor/scan — Bearer token required, from the API specification.
        """
        return self._call("POST", "/usage-monitor/scan", body=self._body(body, fields))
