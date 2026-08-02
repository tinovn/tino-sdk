"""Billing, invoices & payments.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class BillingResource(Resource):
    """Billing, invoices & payments — 21 operations."""

    def add_funds(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Add Funds

        POST /billing/addfunds — Bearer token required, from the API specification.

        Create Invoice Add Credits

        Body fields:
          - funds (integer): Amount of money
          - gateway (integer): Payment Method
        """
        return self._call("POST", "/billing/addfunds", body=self._body(body, fields))

    def add_funds_legacy(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Add Funds

        POST /addfunds — Bearer token required, from the API specification.

        Generate add funds invoice

        Body fields:
          - amount (number): Amount to add to account
          - gateway (number): Payment gateway ID, use `GET /addfunds` to list available gateways
        """
        return self._call("POST", "/addfunds", body=self._body(body, fields))

    def apply_credit(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Apply Credit

        POST /invoice/{id}/credit — Bearer token required, from the API specification.

        Calculate order cost and recurring prices for selected items.
        Use the same parameters as for `POST /order`

        Body fields:
          - id (integer): Payment method ID
          - amount (string)
        """
        path = self._path("/invoice/{id}/credit", id=id)
        return self._call("POST", path, body=self._body(body, fields))

    def delete_invoice(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Delete Invoice

        DELETE /invoice/{id} — Bearer token required, from the API specification.

        Path parameters:
          - id: Invoice id
        """
        path = self._path("/invoice/{id}", id=id)
        return self._call("DELETE", path, body=self._body(body, fields))

    def get_add_funds_info(self, **query: Any) -> Any:
        """Get Add Funds Information

        GET /addfunds — Bearer token required, verified against the live API.

        Get add funds configuration: minimum and maximum deposit amounts and available payment
        gateways
        """
        return self._call("GET", "/addfunds", query=query)

    def get_balance(self, **query: Any) -> Any:
        """Account balance

        GET /balance — Bearer token required, verified against the live API.

        Get current account balance(unpaid invoices total), account credit
        """
        return self._call("GET", "/balance", query=query)

    def get_credit_logs(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """Credit logs

        GET /billing/creditlogs — Bearer token required, verified against the live API.

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/billing/creditlogs", query=params)

    def get_currencies(self, **query: Any) -> Any:
        """Currencies List

        GET /currencies — no authentication required, verified against the live API.

        Return currencies details
        """
        return self._call("GET", "/currencies", query=query, authenticated=False)

    def get_estimate(self, id, **query: Any) -> Any:
        """Estimates Details

        GET /estimates/{id} — Bearer token required, from the API specification.

        Path parameters:
          - id: Estimates id
        """
        path = self._path("/estimates/{id}", id=id)
        return self._call("GET", path, query=query)

    def get_estimate_pdf(self, id, **query: Any) -> Any:
        """Download Invoice Pdf

        GET /estimate/{id}/pdf — Bearer token required, from the API specification.
        """
        path = self._path("/estimate/{id}/pdf", id=id)
        return self._call("GET", path, query=query)

    def get_invoice_details(self, id, **query: Any) -> Any:
        """Invoice Details

        GET /invoice/{id} — Bearer token required, verified against the live API.

        Get invoice details
        """
        path = self._path("/invoice/{id}", id=id)
        return self._call("GET", path, query=query)

    def get_invoice_pdf(self, id, **query: Any) -> Any:
        """Invoice PDF

        GET /invoice/{id}/pdf — Bearer token required, verified against the live API.

        Get specific invoice PDF as base64 string
        """
        path = self._path("/invoice/{id}/pdf", id=id)
        return self._call("GET", path, query=query)

    def get_payment_link(self, invoice_id, gateway_id, **query: Any) -> Any:
        """Payment link

        GET /billing/{invoice_id}/pay/{gateway_id} — Bearer token required, verified against the live API.

        Get Payment link from Gateways.

        Path parameters:
          - invoice_id: Invoice ID
          - gateway_id: Gateway ID
        """
        path = self._path("/billing/{invoice_id}/pay/{gateway_id}", invoice_id=invoice_id, gateway_id=gateway_id)
        return self._call("GET", path, query=query)

    def list_estimates(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List Estimates

        GET /estimates — Bearer token required, verified against the live API.

        List all estimates under my account
        Using: &page=&perpage= for pagination. page start 0.
        filter[service_status]= search invoice by service status, filter[service]= search
        invoice by service id

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/estimates", query=params)

    def list_invoices(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List Invoices

        GET /invoices — Bearer token required, verified against the live API.

        List all invoices under my account
        Using: &page=&perpage= for pagination. page start 0.
        filter[service_status]= search invoice by service status, filter[service]= search
        invoice by service id

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/invoices", query=params)

    def list_invoices_due(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List Invoices Due

        GET /invoices/due — Bearer token required, verified against the live API.

        List all invoices due under my account
        Using: &page=&perpage= for pagination. page start 0

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/invoices/due", query=params)

    def list_invoices_legacy(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List Invoices

        GET /invoice — Bearer token required, verified against the live API.

        List all invoices under my account

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/invoice", query=params)

    def list_payment_method_fees(self, **query: Any) -> Any:
        """Payment Methods Fees

        GET /payment/fees — no authentication required, verified against the live API.

        List available payment methods with fees
        """
        return self._call("GET", "/payment/fees", query=query, authenticated=False)

    def list_payment_methods(self, **query: Any) -> Any:
        """Payment Methods

        GET /payment — no authentication required, verified against the live API.

        List available payment methods
        """
        return self._call("GET", "/payment", query=query, authenticated=False)

    def pay_all_invoices(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Payall Invoice

        POST /invoices/payall — Bearer token required, from the API specification.

        Body fields:
          - selected (array): selected invoice id
        """
        return self._call("POST", "/invoices/payall", body=self._body(body, fields))

    def redeem_credit_voucher(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Redeem a voucher

        POST /billing/creditvoucher — Bearer token required, from the API specification.

        Using Redeem a voucher

        Body fields:
          - code (string): Voucher Code
        """
        return self._call("POST", "/billing/creditvoucher", body=self._body(body, fields))
