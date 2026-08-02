"""Services (hosting, VPS, ...).

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class ServicesResource(Resource):
    """Services (hosting, VPS, ...) — 26 operations."""

    def cancel(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Cancel Service

        POST /service/{id}/cancel — Bearer token required, verified against the live API.

        Request service cancellation

        Body fields:
          - id (integer): Service id
          - immediate (string): set to false</code> to terminate service at the end of billing date, true</code> - terminate immediately
          - reason (string): Reason for this request
        """
        path = self._path("/service/{id}/cancel", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def create_email_account(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Create Emails Account

        POST /service/{id}/emails — Bearer token required, verified against the live API.

        Get the details of a particular virtual server

        Path parameters:
          - id: Service ID

        Body fields:
          - module (string, required): Service type module (Cpanel2|DirectAdmin2|Zimbra|Wilduck)
          - name (string, required): Email account without domain
          - passmain (string, required): Password for email account
          - passcheck (string, required): Password confirm for email account
          - quota (integer, required): Email Quote (Megabytes)
        """
        path = self._path("/service/{id}/emails", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def delete_email_account(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Delete Email Account

        POST /service/{id}/emails/delete — Bearer token required, verified against the live API.

        Get the details of a particular virtual server

        Path parameters:
          - id: Service ID

        Body fields:
          - module (string, required): Service type module (Cpanel2|DirectAdmin2|Zimbra|Wilduck)
          - deluser (string, required): Email account
          - domain (string, required): Password for email account
        """
        path = self._path("/service/{id}/emails/delete", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def get(self, id, **query: Any) -> Any:
        """Service details

        GET /service/{id} — Bearer token required, verified against the live API.

        Return details for service `@id`

        Path parameters:
          - id: Service id
        """
        path = self._path("/service/{id}", id=id)
        return self._call("GET", path, query=query)

    def get_billing_cycles(self, id, **query: Any) -> Any:
        """List Billing Cycle

        GET /service/{id}/cycle — Bearer token required, verified against the live API.

        Get recurring billing cycle options

        Path parameters:
          - id: Service id
        """
        path = self._path("/service/{id}/cycle", id=id)
        return self._call("GET", path, query=query)

    def get_label(self, id, **query: Any) -> Any:
        """Service label

        GET /service/{id}/label — Bearer token required, verified against the live API.

        Show current service label

        Path parameters:
          - id: Service id
        """
        path = self._path("/service/{id}/label", id=id)
        return self._call("GET", path, query=query)

    def get_resources(self, id, **query: Any) -> Any:
        """Resources

        GET /service/{id}/resources — Bearer token required, verified against the live API.

        Show available and used resources
        """
        path = self._path("/service/{id}/resources", id=id)
        return self._call("GET", path, query=query)

    def get_reverse_dns(self, id, **query: Any) -> Any:
        """Reverse DNS

        GET /service/{id}/rdns — Bearer token required, verified against the live API.

        Get reverse DNS entries for service's IP addresses

        Path parameters:
          - id: Service ID
        """
        path = self._path("/service/{id}/rdns", id=id)
        return self._call("GET", path, query=query)

    def get_upgrade_options(self, id, **query: Any) -> Any:
        """Upgrade Options

        GET /service/{id}/upgrade — Bearer token required, verified against the live API.

        List upgrade options
        """
        path = self._path("/service/{id}/upgrade", id=id)
        return self._call("GET", path, query=query)

    def list(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List services

        GET /service — Bearer token required, verified against the live API.

        List all services under your account

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/service", query=params)

    def list_active(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """Get list services active

        GET /services/active — Bearer token required, verified against the live API.

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/services/active", query=params)

    def list_by_category(self, cid, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List services by category

        GET /services/{cid} — Bearer token required, verified against the live API.

        List all services under your account by Category id.
        filter[hide_terminated]=1 filter[hide_cancelled]=1 filter[hide_suspended]=1
        filter[hide_fraud]=1 filter[status]=Active

        Path parameters:
          - cid: Category id, 0 to get all

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        path = self._path("/services/{cid}", cid=cid)
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", path, query=params)

    def list_email_accounts(self, id, *, module: Any = None, **query: Any) -> Any:
        """Get Emails Account

        GET /service/{id}/emails — Bearer token required, verified against the live API.

        Get the details of a particular virtual server

        Path parameters:
          - id: Service ID

        Query parameters:
          - module (required): Service type module (Cpanel2|DirectAdmin2|Zimbra|Wilduck)
        """
        path = self._path("/service/{id}/emails", id=id)
        params = self._query({"module": module}, query)
        return self._call("GET", path, query=params)

    def list_invoices(self, id, **query: Any) -> Any:
        """Service Invoice Related

        GET /service/{id}/invoices — Bearer token required, verified against the live API.

        Returns details of the DNS zone

        Path parameters:
          - id: Service ID
        """
        path = self._path("/service/{id}/invoices", id=id)
        return self._call("GET", path, query=query)

    def list_ips(self, id, **query: Any) -> Any:
        """IP Addresses

        GET /service/{id}/ip — Bearer token required, verified against the live API.

        List Service IP Addresses

        Path parameters:
          - id: Service ID
        """
        path = self._path("/service/{id}/ip", id=id)
        return self._call("GET", path, query=query)

    def list_methods(self, id, **query: Any) -> Any:
        """List service methods

        GET /service/{id}/methods — Bearer token required, verified against the live API.

        List methods available for service
        """
        path = self._path("/service/{id}/methods", id=id)
        return self._call("GET", path, query=query)

    def list_networks(self, id, **query: Any) -> Any:
        """List available networks

        GET /service/{id}/networks — Bearer token required, verified against the live API.

        List of networks and IP pools that can be used for VM creation
        """
        path = self._path("/service/{id}/networks", id=id)
        return self._call("GET", path, query=query)

    def list_os_templates(self, id, **query: Any) -> Any:
        """List OS templates

        GET /service/{id}/templates — Bearer token required, verified against the live API.

        List templates that can be used to create virtual server
        """
        path = self._path("/service/{id}/templates", id=id)
        return self._call("GET", path, query=query)

    def list_widgets(self, id, **query: Any) -> Any:
        """List services widgets

        GET /service/{id}/widgets — Bearer token required, verified against the live API.

        List all services widgets

        Path parameters:
          - id: Service id
        """
        path = self._path("/service/{id}/widgets", id=id)
        return self._call("GET", path, query=query)

    def manual_renew(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Manual renew Service

        POST /service/{id}/manualrenew — Bearer token required, verified against the live API.

        Check if domain is available for registration. Returns status: "ok" if domain is
        available, empty response otherwise
        """
        path = self._path("/service/{id}/manualrenew", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def renew(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Manual Service Renew

        POST /service/{id}/renew — Bearer token required, from the API specification.

        Generate an invoice to renew the service.

        Body fields:
          - id (integer): Service id
        """
        path = self._path("/service/{id}/renew", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def request_upgrade(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Upgrade Request

        POST /service/{id}/upgrade — Bearer token required, verified against the live API.

        Estimate or request upgrade

        ```json
        // Format of ''resources'' paremeter
        {
        "resource_id" : "qty_value", // sliders & qty fields
        "resource_id" : "item_id", // dropdown & radio fields
        "resource_id" : {
        "item_id": "qty_value" // dropdown with qty field
        }
        }
        ```

        Body fields:
          - id (integer): Service id
          - resources (array): array with resource values
          - package (integer): New package id, optonal when upgrading resources
          - cycle (string): New billing cycle, optonal when upgrading resources
          - send (boolean): Set to true when you want to send your upgrade request
        """
        path = self._path("/service/{id}/upgrade", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def set_billing_cycle(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Change Billing Cycle

        POST /service/{id}/cycle — Bearer token required, from the API specification.

        Change recurring billing cycle for the service

        Body fields:
          - id (integer): Service id
          - cycle (string): New billing cycle
        """
        path = self._path("/service/{id}/cycle", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def set_label(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Change service label

        POST /service/{id}/label — Bearer token required, verified against the live API.

        Set new custom label to identify this service

        Body fields:
          - id (integer): Service id
          - label (string): New label
        """
        path = self._path("/service/{id}/label", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def update_email_account(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Update Emails Account

        POST /service/{id}/emails/change — Bearer token required, verified against the live API.

        Get the details of a particular virtual server

        Path parameters:
          - id: Service ID

        Body fields:
          - module (string, required): Service type module (Cpanel2|DirectAdmin2|Zimbra|Wilduck)
          - change (Array, required)
        """
        path = self._path("/service/{id}/emails/change", id=id)
        return self._call("POST", path, body=self._body(payload, fields))

    def update_reverse_dns(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Update rDNS

        POST /service/{id}/rdns — Bearer token required, from the API specification.

        Update reverse DNS entries service's IP addresses

        Body fields:
          - id (integer): Service ID
          - ipaddress (array): Use Ip address as parameter key and hostname as value
        """
        path = self._path("/service/{id}/rdns", id=id)
        return self._call("POST", path, body=self._body(payload, fields))
