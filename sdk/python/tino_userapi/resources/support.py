"""Support tickets, news & knowledgebase.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class SupportResource(Resource):
    """Support tickets, news & knowledgebase — 13 operations."""

    def close_ticket(self, number, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Close ticket

        PUT /tickets/{number}/close — Bearer token required, from the API specification.

        Send request to close a ticket

        Body fields:
          - number (integer): Ticket number
        """
        path = self._path("/tickets/{number}/close", number=number)
        return self._call("PUT", path, body=self._body(body, fields))

    def create_ticket(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Create Ticket

        POST /tickets — Bearer token required, from the API specification.

        Submit new ticket

        Body fields:
          - dept_id (integer): Department id
          - subject (string): Ticket subject
          - body (string): Ticket message
        """
        return self._call("POST", "/tickets", body=self._body(body, fields))

    def get_attachment(self, file, *, number: Any = None, **query: Any) -> Any:
        """Ticket attachment

        GET /ticket/attachment/{file} — Bearer token required, verified against the live API.

        Get ticket attachment

        Path parameters:
          - file: Attachment id

        Query parameters:
          - number: Ticket number
        """
        path = self._path("/ticket/attachment/{file}", file=file)
        params = self._query({"number": number}, query)
        return self._call("GET", path, query=params)

    def get_kb_article(self, article_id, **query: Any) -> Any:
        """Get knowledgebase article

        GET /knowledgebase/article/{article_id} — Bearer token required, verified against the live API.

        Returns an article details
        """
        path = self._path("/knowledgebase/article/{article_id}", article_id=article_id)
        return self._call("GET", path, query=query)

    def get_kb_category(self, category_id, **query: Any) -> Any:
        """Get knowledgebase category details

        GET /knowledgebase/{category_id} — Bearer token required, verified against the live API.

        Returns subcategories and articles of the knowledgebase category
        """
        path = self._path("/knowledgebase/{category_id}", category_id=category_id)
        return self._call("GET", path, query=query)

    def get_news(self, news_id, **query: Any) -> Any:
        """Get news item

        GET /news/{news_id} — Bearer token required, from the API specification.

        Returns details of the news item
        """
        path = self._path("/news/{news_id}", news_id=news_id)
        return self._call("GET", path, query=query)

    def get_ticket(self, number, **query: Any) -> Any:
        """Ticket details

        GET /tickets/{number} — Bearer token required, verified against the live API.

        Get ticket details, including all replies

        Path parameters:
          - number: Ticket number
        """
        path = self._path("/tickets/{number}", number=number)
        return self._call("GET", path, query=query)

    def list_departments(self, **query: Any) -> Any:
        """List ticket departments

        GET /ticket/departments — Bearer token required, verified against the live API.

        Get the list of ticket departments
        """
        return self._call("GET", "/ticket/departments", query=query)

    def list_kb_categories(self, **query: Any) -> Any:
        """List all knowledgebase categories

        GET /knowledgebase — Bearer token required, verified against the live API.

        Returns list all knowledgebase categories
        """
        return self._call("GET", "/knowledgebase", query=query)

    def list_news(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List News

        GET /news — Bearer token required, verified against the live API.

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/news", query=params)

    def list_tickets(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List Tickets

        GET /tickets — Bearer token required, verified against the live API.

        List support tickets under my account

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/tickets", query=params)

    def reopen_ticket(self, number, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Re-open ticket

        PUT /tickets/{number}/open — Bearer token required, from the API specification.

        Try to re-open closed ticket

        Body fields:
          - number (integer): Ticket number
        """
        path = self._path("/tickets/{number}/open", number=number)
        return self._call("PUT", path, body=self._body(body, fields))

    def reply_ticket(self, number, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Create Reply

        POST /tickets/{number} — Bearer token required, from the API specification.

        Reply to ticket

        Body fields:
          - number (integer): Ticket number
          - body (string): Reply message
        """
        path = self._path("/tickets/{number}", number=number)
        return self._call("POST", path, body=self._body(body, fields))
