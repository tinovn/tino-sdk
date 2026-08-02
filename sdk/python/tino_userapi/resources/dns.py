"""DNS zones & records.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class DnsResource(Resource):
    """DNS zones & records — 12 operations."""

    def create_record(self, service_id, zone_id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Add DNS Record

        POST /service/{service_id}/dns/{zone_id}/records — Bearer token required, verified against the live API.

        Creates a new record in the DNS zone

        Body fields:
          - service_id (integer): Service ID
          - zone_id (integer): Zone ID
          - name (string): Record name
          - ttl (integer): Record ttl
          - priority (integer): Priority of the record
          - type (string): Record type
          - content (string): Contents of the record
        """
        path = self._path("/service/{service_id}/dns/{zone_id}/records", service_id=service_id, zone_id=zone_id)
        return self._call("POST", path, body=self._body(payload, fields))

    def create_zone(self, service_id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Add DNS Zone

        POST /service/{service_id}/dns — Bearer token required, from the API specification.

        Creates a new DNS zone

        Body fields:
          - service_id (integer): Service ID
          - name (string): Zone name
        """
        path = self._path("/service/{service_id}/dns", service_id=service_id)
        return self._call("POST", path, body=self._body(payload, fields))

    def delete_record(self, service_id, zone_id, record_id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Remove DNS Record

        DELETE /service/{service_id}/dns/{zone_id}/records/{record_id} — Bearer token required, verified against the live API.

        Removes the selected DNS zone record

        Path parameters:
          - service_id: Service ID
          - zone_id: Zone ID
          - record_id: Record ID
        """
        path = self._path("/service/{service_id}/dns/{zone_id}/records/{record_id}", service_id=service_id, zone_id=zone_id, record_id=record_id)
        return self._call("DELETE", path, body=self._body(payload, fields))

    def delete_zone(self, service_id, zone_id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Remove DNS zone

        DELETE /service/{service_id}/dns/{zone_id} — Bearer token required, from the API specification.

        Deletes the selected DNS zone

        Path parameters:
          - service_id: Service ID
          - zone_id: Zone ID
        """
        path = self._path("/service/{service_id}/dns/{zone_id}", service_id=service_id, zone_id=zone_id)
        return self._call("DELETE", path, body=self._body(payload, fields))

    def get_zone(self, service_id, zone_id, **query: Any) -> Any:
        """Get DNS details

        GET /service/{service_id}/dns/{zone_id} — Bearer token required, verified against the live API.

        Returns details of the DNS zone

        Path parameters:
          - service_id: Service ID
          - zone_id: Zone ID
        """
        path = self._path("/service/{service_id}/dns/{zone_id}", service_id=service_id, zone_id=zone_id)
        return self._call("GET", path, query=query)

    def get_zone_dnssec(self, service_id, zone_id, **query: Any) -> Any:
        """Get DNS DNSSEC

        GET /service/{service_id}/dns/{zone_id}/dnssec — Bearer token required, verified against the live API.

        Returns details of the DNS DNSSEC

        Path parameters:
          - service_id: Service ID
          - zone_id: Zone ID
        """
        path = self._path("/service/{service_id}/dns/{zone_id}/dnssec", service_id=service_id, zone_id=zone_id)
        return self._call("GET", path, query=query)

    def list_templates(self, **query: Any) -> Any:
        """DNS Templates

        GET /dns/templates — Bearer token required, verified against the live API.

        Returns details of the DNS zone
        """
        return self._call("GET", "/dns/templates", query=query)

    def list_zones(self, service_id, **query: Any) -> Any:
        """List DNS for service

        GET /service/{service_id}/dns — Bearer token required, verified against the live API.

        Returns a list of DNS zones under the service

        Path parameters:
          - service_id: Service ID
        """
        path = self._path("/service/{service_id}/dns", service_id=service_id)
        return self._call("GET", path, query=query)

    def list_zones_all(self, **query: Any) -> Any:
        """List DNS

        GET /dns — Bearer token required, verified against the live API.

        Returns a list of all DNS
        """
        return self._call("GET", "/dns", query=query)

    def reset_zone_password(self, service_id, zone_id, **query: Any) -> Any:
        """Change Zone DNS

        GET /service/{service_id}/dns/{zone_id}/password — Bearer token required, verified against the live API.

        Returns details of the DNS zone

        Path parameters:
          - service_id: Service ID
          - zone_id: Zone ID
        """
        path = self._path("/service/{service_id}/dns/{zone_id}/password", service_id=service_id, zone_id=zone_id)
        return self._call("GET", path, query=query)

    def update_record(self, service_id, zone_id, record_id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Edit DNS Record

        PUT /service/{service_id}/dns/{zone_id}/records/{record_id} — Bearer token required, verified against the live API.

        Edits the selected DNS zone record

        Body fields:
          - service_id (integer): Service ID
          - zone_id (integer): Zone ID
          - record_id (integer): Record ID
          - name (string): Record name
          - ttl (integer): Record ttl
          - priority (integer): Priority of the record
          - type (string): Record type
          - content (string): Contents of the record
        """
        path = self._path("/service/{service_id}/dns/{zone_id}/records/{record_id}", service_id=service_id, zone_id=zone_id, record_id=record_id)
        return self._call("PUT", path, body=self._body(payload, fields))

    def update_zone_dnssec(self, service_id, zone_id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """UPDATE DNS DNSSEC

        PUT /service/{service_id}/dns/{zone_id}/dnssec — Bearer token required, from the API specification.

        Returns details of the DNS DNSSEC

        Path parameters:
          - service_id: Service ID
          - zone_id: Zone ID

        Body fields:
          - widgetdo (string, required): widgetdo action
        """
        path = self._path("/service/{service_id}/dns/{zone_id}/dnssec", service_id=service_id, zone_id=zone_id)
        return self._call("PUT", path, body=self._body(payload, fields))
