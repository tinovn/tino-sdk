"""Domain names.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class DomainsResource(Resource):
    """Domain names — 31 operations."""

    def add_dnssec_key(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Adds the DNSSEC key

        PUT /domain/{id}/dnssec — Bearer token required, from the API specification.

        Body fields:
          - id (integer): Domain id
        """
        path = self._path("/domain/{id}/dnssec", id=id)
        return self._call("PUT", path, body=self._body(body, fields))

    def get(self, id, **query: Any) -> Any:
        """Domain details

        GET /domain/{id} — Bearer token required, verified against the live API.

        Get domain details

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}", id=id)
        return self._call("GET", path, query=query)

    def get_auto_renew(self, id, **query: Any) -> Any:
        """Get domain autorenew

        GET /domain/{id}/autorenew — Bearer token required, verified against the live API.

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}/autorenew", id=id)
        return self._call("GET", path, query=query)

    def get_by_name(self, name, **query: Any) -> Any:
        """Domain details by name

        GET /domain/name/{name} — Bearer token required, verified against the live API.

        Get domain details by name

        Path parameters:
          - name: Domain name
        """
        path = self._path("/domain/name/{name}", name=name)
        return self._call("GET", path, query=query)

    def get_contacts(self, id, **query: Any) -> Any:
        """Get domain contact info

        GET /domain/{id}/contact — Bearer token required, verified against the live API.

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}/contact", id=id)
        return self._call("GET", path, query=query)

    def get_dnssec_flags(self, id, **query: Any) -> Any:
        """Returns the available flags

        GET /domain/{id}/dnssec/flags — Bearer token required, verified against the live API.

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}/dnssec/flags", id=id)
        return self._call("GET", path, query=query)

    def get_email_forwarding(self, id, **query: Any) -> Any:
        """Get email forwarding

        GET /domain/{id}/emforwarding — Bearer token required, verified against the live API.

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}/emforwarding", id=id)
        return self._call("GET", path, query=query)

    def get_epp_code(self, id, **query: Any) -> Any:
        """Get domain EPP Code

        GET /domain/{id}/epp — Bearer token required, verified against the live API.

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}/epp", id=id)
        return self._call("GET", path, query=query)

    def get_nameservers(self, id, **query: Any) -> Any:
        """Get domain nameservers

        GET /domain/{id}/ns — Bearer token required, verified against the live API.

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}/ns", id=id)
        return self._call("GET", path, query=query)

    def get_registered_nameservers(self, id, **query: Any) -> Any:
        """Get registered nameservers

        GET /domain/{id}/reg — Bearer token required, verified against the live API.

        List registered private/glue nameservers for a domain.
        Note: Not all domain registrar modules support returning registered nameservers.
        If the module does not support this feature, an empty list may be returned.

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}/reg", id=id)
        return self._call("GET", path, query=query)

    def get_registrar_lock(self, id, **query: Any) -> Any:
        """Get domain lock

        GET /domain/{id}/reglock — Bearer token required, verified against the live API.

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}/reglock", id=id)
        return self._call("GET", path, query=query)

    def get_tld_form(self, id, *, tld_id: Any = None, **query: Any) -> Any:
        """Additinal data for TLD

        GET /domain/order/{id}/form — Bearer token required, verified against the live API.

        Get additional forms required for some TLDs

        Note: {id} is the TLD product id returned by cart.listDomainTlds (e.g. 1298 for .io.vn),
        not the id of a registered domain.

        Query parameters:
          - tld_id: TLD ID
        """
        path = self._path("/domain/order/{id}/form", id=id)
        params = self._query({"tld_id": tld_id}, query)
        return self._call("GET", path, query=params)

    def list(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List Domains

        GET /domains — Bearer token required, verified against the live API.

        List domains under your account
        Using: &page=&perpage= for pagination. page start 0

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/domains", query=params)

    def list_dnssec_keys(self, id, **query: Any) -> Any:
        """Returns the list of DNSSEC keys

        GET /domain/{id}/dnssec — Bearer token required, verified against the live API.

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}/dnssec", id=id)
        return self._call("GET", path, query=query)

    def list_invoices(self, id, **query: Any) -> Any:
        """Domain Invoice Related

        GET /domain/{id}/invoices — Bearer token required, verified against the live API.

        Returns details of the DNS zone

        Path parameters:
          - id: Domain ID
        """
        path = self._path("/domain/{id}/invoices", id=id)
        return self._call("GET", path, query=query)

    def list_legacy(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List Domains

        GET /domain — Bearer token required, verified against the live API.

        List domains under your account

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/domain", query=params)

    def lookup(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Domain availability

        POST /domain/lookup — no authentication required, verified against the live API.

        Check if domain is available for registration. Returns status: "ok" if domain is
        available, empty response otherwise

        Body fields:
          - name (string): Domain name, ie. example.com
        """
        return self._call("POST", "/domain/lookup", body=self._body(body, fields), authenticated=False)

    def order(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Order new domain

        POST /domain/order — Bearer token required, from the API specification.

        Create new order for a domain, please check if requested domain is available first,
        otherwise your order may get cancelled.

        Body fields:
          - name (string): Domain name
          - years (string): Number of years
          - action (string): register|transfer
          - tld_id (string): TLD id
          - pay_method (integer): Payment method ID
          - epp (string): EPP Transfer code, required when transfering some domains
          - nameservers (array): Optional array with 2 - 4 nameservers that you want to use
          - registrant (integer): Optional contact ID to use for registrant contact this domain
          - admin (integer): Optional contact ID to use for admin contact this domain
          - tech (integer): Optional contact ID to use for tech contact this domain
          - billing (integer): Optional contact ID to use for billing contact this domain
          - data (array): Addditional data required for some TLDs
          - aff_id (integer): Affiliate ID
        """
        return self._call("POST", "/domain/order", body=self._body(body, fields))

    def register_nameserver(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Register domain nameservers

        POST /domain/{id}/reg — Bearer token required, from the API specification.

        Manage private/glue nameservers for a domain. Use the `action` parameter to select the
        operation:
        - `registerNameServer` – register a new glue record (requires `nameserver` + `ip`)
        - `modifyNameServer` – update the IP of an existing glue record (requires `nameserver` +
        `oldip` + `newip`)
        - `deleteNameServer` – remove a glue record (requires `nameserver`)

        Body fields:
          - id (integer): Domain id
          - action (string): Operation: registerNameServer, modifyNameServer, deleteNameServer
          - nameserver (string): Full nameserver hostname
          - ip (string): IP address for the nameserver – required for registerNameServer
          - oldip (string): Current IP address – required for modifyNameServer
          - newip (string): New IP address – required for modifyNameServer
        """
        path = self._path("/domain/{id}/reg", id=id)
        return self._call("POST", path, body=self._body(body, fields))

    def remove_dnssec_key(self, id, key, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """removeDnssecKey

        DELETE /domain/{id}/dnssec/{key} — Bearer token required, from the API specification.

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}/dnssec/{key}", id=id, key=key)
        return self._call("DELETE", path, body=self._body(body, fields))

    def renew(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Renew domain

        POST /domain/{id}/renew — Bearer token required, from the API specification.

        Create new renew order for a domain, please check if requested domain is available
        first, otherwise your order may get cancelled.

        Body fields:
          - years (string): Number of years
          - pay_method (integer): Payment method ID
        """
        path = self._path("/domain/{id}/renew", id=id)
        return self._call("POST", path, body=self._body(body, fields))

    def suggest(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Domain suggest

        POST /domain/suggest — no authentication required, verified against the live API.

        Check if domain is available for registration. Returns status: "ok" if domain is
        available, empty response otherwise

        Body fields:
          - name (string): Domain name, ie. example.com
        """
        return self._call("POST", "/domain/suggest", body=self._body(body, fields), authenticated=False)

    def sync(self, id, **query: Any) -> Any:
        """Synchronize domain

        GET /domain/{id}/sync — Bearer token required, verified against the live API.

        Path parameters:
          - id: Domain id
        """
        path = self._path("/domain/{id}/sync", id=id)
        return self._call("GET", path, query=query)

    def update_auto_renew(self, id, autorenew, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Enable/disable domain autorenew

        PUT /domain/{id}/autorenew — Bearer token required, from the API specification.

        Path parameters:
          - id: Domain id
          - autorenew: true|false
        """
        path = self._path("/domain/{id}/autorenew", id=id, autorenew=autorenew)
        return self._call("PUT", path, body=self._body(body, fields))

    def update_contacts(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Update domain contact (WHOIS) information

        PUT /domain/{id}/contact — Bearer token required, from the API specification.

        Update the registrant, admin, tech and billing contacts of a domain.

        Path parameters:
          - id: Domain id

        Body fields:
          - registrant (object): Registrant contact fields
          - admin (object): Administrative contact fields
          - tech (object): Technical contact fields
          - billing (object): Billing contact fields
        """
        path = self._path("/domain/{id}/contact", id=id)
        return self._call("PUT", path, body=self._body(body, fields))

    def update_email_forwarding(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Update email forwarding

        PUT /domain/{id}/emforwarding — Bearer token required, from the API specification.

        Body fields:
          - id (integer): Domain id
          - from (string): Email address that you want to forward
          - to (string): Email address that will receive forwarded emails
          - records (array): Multiple forwarding rules [{"from":"info","to":"dest@domain.com"},{"from":"support","to":"help@domain.com"}]
        """
        path = self._path("/domain/{id}/emforwarding", id=id)
        return self._call("PUT", path, body=self._body(body, fields))

    def update_forwarding(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Update domain forwarding

        PUT /domain/{id}/forwarding — Bearer token required, from the API specification.

        Body fields:
          - id (integer): Domain id
        """
        path = self._path("/domain/{id}/forwarding", id=id)
        return self._call("PUT", path, body=self._body(body, fields))

    def update_id_protection(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Update domain ID Protection

        PUT /domain/{id}/idprotection — Bearer token required, from the API specification.

        Path parameters:
          - id: Domain id

        Body fields:
          - switch (boolean): true|false
        """
        path = self._path("/domain/{id}/idprotection", id=id)
        return self._call("PUT", path, body=self._body(body, fields))

    def update_nameservers(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Update domain nameservers

        PUT /domain/{id}/ns — Bearer token required, from the API specification.

        Change domain nameservers, if `$nameservers` is left empty, default namesevers will be
        used

        Body fields:
          - id (integer): Domain id
          - nameservers (array): List of nameservers to use
        """
        path = self._path("/domain/{id}/ns", id=id)
        return self._call("PUT", path, body=self._body(body, fields))

    def update_registrar_lock(self, id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Update domain lock

        PUT /domain/{id}/reglock — Bearer token required, from the API specification.

        Path parameters:
          - id: Domain id

        Body fields:
          - switch (boolean): true|false
        """
        path = self._path("/domain/{id}/reglock", id=id)
        return self._call("PUT", path, body=self._body(body, fields))

    def whois(self, domain, **query: Any) -> Any:
        """Whois Domain

        GET /whois/{domain} — Bearer token required, verified against the live API.

        Path parameters:
          - domain: Domain
        """
        path = self._path("/whois/{domain}", domain=domain)
        return self._call("GET", path, query=query)
