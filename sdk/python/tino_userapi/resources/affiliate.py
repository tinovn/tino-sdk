"""Affiliate programme.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class AffiliateResource(Resource):
    """Affiliate programme — 12 operations."""

    def activate(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Active Affiliate

        POST /affiliate/active — Bearer token required, from the API specification.
        """
        return self._call("POST", "/affiliate/active", body=self._body(body, fields))

    def add_voucher(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Add Vouchers

        POST /affiliates/addvoucher — Bearer token required, from the API specification.

        Body fields:
          - plan (integer): Plan ID Requested</b>
          - cycle (string, one of once, recurring): Voucher cycle Requested</b>
          - audience (string, one of new, all, existing): Voucher audience
          - max_usage_limit (boolean): max_usage_limit
          - max_usage (string): max_usage
          - expires (string): Expires Date
          - discount (string, one of Min: 1, Max: Commission Rate): Discount value
        """
        return self._call("POST", "/affiliates/addvoucher", body=self._body(body, fields))

    def add_voucher_legacy(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Add Vouchers

        POST /affiliate/addvoucher — Bearer token required, from the API specification.

        Body fields:
          - plan (integer): Plan ID Requested</b>
          - cycle (string, one of once, recurring): Voucher cycle Requested</b>
          - audience (string, one of new, all, existing): Voucher audience
          - max_usage_limit (boolean): max_usage_limit
          - max_usage (string): max_usage
          - expires (string): Expires Date
          - discount (string, one of Min: 1, Max: Commission Rate): Discount value
        """
        return self._call("POST", "/affiliate/addvoucher", body=self._body(body, fields))

    def get_commission_plan(self, id, **query: Any) -> Any:
        """View Commision Plan

        GET /affiliates/plans/{id} — Bearer token required, verified against the live API.

        Path parameters:
          - id: Plan ID
        """
        path = self._path("/affiliates/plans/{id}", id=id)
        return self._call("GET", path, query=query)

    def get_summary(self, **query: Any) -> Any:
        """Affiliate Info

        GET /affiliates/summary — Bearer token required, verified against the live API.
        """
        return self._call("GET", "/affiliates/summary", query=query)

    def list_campaigns(self, **query: Any) -> Any:
        """Get Affiliate campaigns

        GET /affiliates/campaigns — Bearer token required, verified against the live API.
        """
        return self._call("GET", "/affiliates/campaigns", query=query)

    def list_commission_plans(self, **query: Any) -> Any:
        """Get Affiliate commission plans

        GET /affiliates/commissionplans — Bearer token required, verified against the live API.
        """
        return self._call("GET", "/affiliates/commissionplans", query=query)

    def list_commissions(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """Affiliate Commissions

        GET /affiliates/commissions — Bearer token required, verified against the live API.

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/affiliates/commissions", query=params)

    def list_payouts(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """Affiliate Payouts

        GET /affiliates/payouts — Bearer token required, verified against the live API.

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/affiliates/payouts", query=params)

    def list_vouchers(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """Affiliate Vouchers

        GET /affiliates/vouchers — Bearer token required, verified against the live API.

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/affiliates/vouchers", query=params)

    def remove_voucher(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Affiliate Delete Vouchers

        DELETE /affiliates/vouchers/{id}/remove — Bearer token required, from the API specification.

        Path parameters:
          - id: Plan ID, Empty if get list plans
        """
        path = self._path("/affiliates/vouchers/{id}/remove", id=id)
        return self._call("DELETE", path, body=self._body(body, fields))

    def remove_voucher_legacy(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Affiliate Delete Vouchers

        DELETE /affiliate/removevoucher — Bearer token required, from the API specification.

        Path parameters:
          - id: Plan ID, Empty if get list plans
        """
        path = self._path("/affiliate/removevoucher", id=id)
        return self._call("DELETE", path, body=self._body(body, fields))
