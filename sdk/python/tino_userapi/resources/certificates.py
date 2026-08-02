"""SSL certificates.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class CertificatesResource(Resource):
    """SSL certificates — 6 operations."""

    def download(self, service_id, **query: Any) -> Any:
        """Download certificate

        GET /certificate/{service_id}/crt — Bearer token required, from the API specification.

        Return X.509 certificate data

        Path parameters:
          - service_id: Service id
        """
        path = self._path("/certificate/{service_id}/crt", service_id=service_id)
        return self._call("GET", path, query=query)

    def get(self, id, **query: Any) -> Any:
        """Certificate details

        GET /certificate/{id} — Bearer token required, from the API specification.
        """
        path = self._path("/certificate/{id}", id=id)
        return self._call("GET", path, query=query)

    def list(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List SSL Certificates

        GET /certificates — Bearer token required, verified against the live API.

        List all ssl services under your account

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/certificates", query=params)

    def list_products(self, **query: Any) -> Any:
        """List available certificates

        GET /certificate/order — Bearer token required, verified against the live API.

        Return a list with certificate available for purchase
        """
        return self._call("GET", "/certificate/order", query=query)

    def list_server_software(self, product_id, **query: Any) -> Any:
        """List server software for certificates

        GET /certificate/order/{product_id}/software — Bearer token required, verified against the live API.

        Return a list with software IDs required or certificate

        Path parameters:
          - product_id: Certificate product ID
        """
        path = self._path("/certificate/order/{product_id}/software", product_id=product_id)
        return self._call("GET", path, query=query)

    def order(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Order new certificates

        POST /certificate/order — Bearer token required, from the API specification.

        Create new order for a certificate

        Body fields:
          - product_id (integer): Certificate product ID
          - csr (string): Domain name
          - years (integer): Number of years
          - pay_method (integer): Payment method ID
          - approver_email (string): Email addres used in domain validation
          - admin (integer): Admin contact ID
          - tech (integer): Tech contact ID
          - billing (integer): Billing contact ID
          - organization (array): Organization details
          - software (integer): Server/Software ID
          - data (array): Addditional data required for some products
          - aff_id (integer): Affiliate ID
        """
        return self._call("POST", "/certificate/order", body=self._body(body, fields))
