"""Client area & account.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class AccountResource(Resource):
    """Client area & account — 29 operations."""

    def acknowledge_notification(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Acknowledge notification

        PUT /notifications/{id}/ack — Bearer token required, verified against the live API.

        Marks the notification as read

        thêm params['seen_all']=true để mark real all notifications
        """
        path = self._path("/notifications/{id}/ack", id=id)
        return self._call("PUT", path, body=self._body(payload, fields))

    def create_contact(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Add contact

        POST /contact — Bearer token required, from the API specification.

        Create new contact account, if password is provided you
        can use provided email addres to login as that contact.

        Body fields:
          - password (string): Optional, allows you to login as contact
          - privileges (array): Array with privileges that you want to enable. Formatted the same way as output from GET /contact/privileges</code>
          - type (string, one of Private, Company): Account Type
          - companyname (string): Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân
          - taxid (string): Mã số thuế
          - gender (string, one of Male, Female): Danh xưng
          - lastname (string): Last Name
          - firstname (string): First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền.
          - nationalid (string): Số CCCD/Passport
          - email (string): Email Address
          - birthday (string): Ngày sinh - Định dạng đúng dd/mm/yyyy
          - phonenumber (string): Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn.
          - country (string): Country
          - state (string): State
          - city (string): City
          - address1 (string): Address 1
          - bankname (string): Tên ngân hàng
          - bankaccount (string): Số tài khoản
          - bankaccountname (string): Tên tài khoản
        """
        return self._call("POST", "/contact", body=self._body(payload, fields))

    def download_business_profile(self, **query: Any) -> Any:
        """Get business file

        GET /clientarea/downloadprofile — Bearer token required, verified against the live API.
        """
        return self._call("GET", "/clientarea/downloadprofile", query=query)

    def download_file(self, id, **query: Any) -> Any:
        """Download File

        GET /download/{id} — Bearer token required, from the API specification.
        """
        path = self._path("/download/{id}", id=id)
        return self._call("GET", path, query=query)

    def get_business_info(self, *, taxid: Any = None, **query: Any) -> Any:
        """Get business info

        GET /clientarea/businessinfo — Bearer token required, verified against the live API.

        Query parameters:
          - taxid (required)
        """
        params = self._query({"taxid": taxid}, query)
        return self._call("GET", "/clientarea/businessinfo", query=params)

    def get_contact(self, id, **query: Any) -> Any:
        """Get contacts details

        GET /contact/{id} — Bearer token required, verified against the live API.

        Return array with contact details

        Path parameters:
          - id: Contact ID
        """
        path = self._path("/contact/{id}", id=id)
        return self._call("GET", path, query=query)

    def get_contact_privileges(self, **query: Any) -> Any:
        """Contact privileges

        GET /contact/privileges — Bearer token required, verified against the live API.

        List possible contact privileges.
        Each domain and service may list additional privileges, depending on available features.
        """
        return self._call("GET", "/contact/privileges", query=query)

    def get_details(self, **query: Any) -> Any:
        """User Details

        GET /details — Bearer token required, verified against the live API.

        Return registration details for my account

        Note: The response now carries verify.phone (bool) and a phone block {status,
        verified_at}. status is one of verified | unverified | taken_by_other | missing. Note
        that the top-level update_required is about the profile (national id, address), not the
        phone.
        """
        return self._call("GET", "/details", query=query)

    def get_email(self, id, **query: Any) -> Any:
        """Email Details

        GET /clientarea/history/emails/{id} — Bearer token required, verified against the live API.

        Path parameters:
          - id: Email ID
        """
        path = self._path("/clientarea/history/emails/{id}", id=id)
        return self._call("GET", path, query=query)

    def get_service_nav(self, **query: Any) -> Any:
        """Service menus

        GET /clientarea/nav/service — Bearer token required, verified against the live API.

        Get list Categories for Service.
        """
        return self._call("GET", "/clientarea/nav/service", query=query)

    def get_settings(self, **query: Any) -> Any:
        """Get Client Settings

        GET /clientarea/settings — Bearer token required, verified against the live API.
        """
        return self._call("GET", "/clientarea/settings", query=query)

    def get_summary(self, **query: Any) -> Any:
        """Summany info

        GET /clientarea — Bearer token required, verified against the live API.
        """
        return self._call("GET", "/clientarea", query=query)

    def list_contacts(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List contacts

        GET /contact — Bearer token required, verified against the live API.

        Return a list of contacts on this account

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/contact", query=params)

    def list_contacts_legacy(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List contacts

        GET /contacts — Bearer token required, verified against the live API.

        Return a list of contacts on this account

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/contacts", query=params)

    def list_downloads(self, **query: Any) -> Any:
        """Downloads

        GET /downloads — Bearer token required, verified against the live API.
        """
        return self._call("GET", "/downloads", query=query)

    def list_emails(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """Emails history

        GET /clientarea/history/emails — Bearer token required, verified against the live API.

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/clientarea/history/emails", query=params)

    def list_histories(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List history

        GET /clientarea/histories — Bearer token required, verified against the live API.

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/clientarea/histories", query=params)

    def list_logs(self, *, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """User Logs

        GET /logs — Bearer token required, verified against the live API.

        Returns logs from history

        Query parameters:
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/logs", query=params)

    def list_new_notifications(self, *, rel_type: Any = None, rel_id: Any = None, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List new portal notifications

        GET /notifications/new — Bearer token required, verified against the live API.

        Return only new portal notifications.

        Query parameters:
          - rel_type: Optional, return only by relation type
          - rel_id: Optional, return only by relation id
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"rel_type": rel_type, "rel_id": rel_id, "page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/notifications/new", query=params)

    def list_notifications(self, *, rel_type: Any = None, rel_id: Any = None, page: Any = None, perpage: Any = None, orderby: Any = None, filters: Any = None, **query: Any) -> Any:
        """List all portal notifications

        GET /notifications — Bearer token required, verified against the live API.

        Return a list of all portal notifications.

        Query parameters:
          - rel_type: Optional, return only by relation type
          - rel_id: Optional, return only by relation id
          - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
          - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
          - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
          - filter: Endpoint-specific filters, serialised as filter[key]=value.
        """
        params = self._query({"rel_type": rel_type, "rel_id": rel_id, "page": page, "perpage": perpage, "orderby": orderby, "filter": filters}, query)
        return self._call("GET", "/notifications", query=params)

    def list_owner_transfers(self, **query: Any) -> Any:
        """ChangeOwner Service

        GET /changeowner — Bearer token required, verified against the live API.

        Sử dụng: &rel_id=:serviceId&rel_type=:ServiceType&make=(reject|approve) để xác nhận hay
        hủy
        """
        return self._call("GET", "/changeowner", query=query)

    def list_statuses(self, **query: Any) -> Any:
        """List status key

        GET /clientarea/statuses — Bearer token required, verified against the live API.
        """
        return self._call("GET", "/clientarea/statuses", query=query)

    def search(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Search Service/Product

        POST /clientarea/search/ — Bearer token required, verified against the live API.

        Note: The search keyword goes in the request body as {"query": "..."}, not in the path.

        Body fields:
          - query (string, required): Search keyword (service domain, invoice number, ticket subject, ...)
        """
        return self._call("POST", "/clientarea/search/", body=self._body(payload, fields))

    def status(self, **query: Any) -> Any:
        """status server api

        GET /status — no authentication required, verified against the live API.

        Return only new portal notifications.
        """
        return self._call("GET", "/status", query=query, authenticated=False)

    def submit_contact_form(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """submit contact form

        POST /submit_contactform — no authentication required, from the API specification.

        ok

        Body fields:
          - cfmName (string): Your acount email address
          - cfmPhone (string): Your acount email address
          - cfmEmail (string): Your acount email address
          - cfmMessage (string): Your acount email address
        """
        return self._call("POST", "/submit_contactform", body=self._body(payload, fields), authenticated=False)

    def update_contact(self, id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Edit contact

        PUT /contact/{id} — Bearer token required, from the API specification.

        Change contact details`

        Body fields:
          - id (integer): Contact ID
          - privileges (array): Array with privileges that you want to enable. Formatted the same way as output from GET /contact/privileges</code>
          - type (string, one of Private, Company): Account Type
          - companyname (string): Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân
          - taxid (string): Mã số thuế
          - gender (string, one of Male, Female): Danh xưng
          - lastname (string): Last Name
          - firstname (string): First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền.
          - nationalid (string): Số CCCD/Passport
          - email (string): Email Address
          - birthday (string): Ngày sinh - Định dạng đúng dd/mm/yyyy
          - phonenumber (string): Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn.
          - country (string): Country
          - state (string): State
          - city (string): City
          - address1 (string): Address 1
          - bankname (string): Tên ngân hàng
          - bankaccount (string): Số tài khoản
          - bankaccountname (string): Tên tài khoản
        """
        path = self._path("/contact/{id}", id=id)
        return self._call("PUT", path, body=self._body(payload, fields))

    def update_details(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Update User Details

        PUT /details — Bearer token required, from the API specification.

        Update registration details under my account

        Note: Changing phonenumber clears the phone verification: phone.status returns to
        unverified and the old number is released for another account to claim.

        Body fields:
          - type (string, one of Private, Company): Account Type
          - companyname (string): Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân
          - taxid (string): Mã số thuế
          - gender (string, one of Male, Female): Danh xưng
          - lastname (string): Last Name
          - firstname (string): First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền.
          - nationalid (string): Số CCCD/Passport
          - birthday (string): Ngày sinh - Định dạng đúng dd/mm/yyyy
          - phonenumber (string): Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn.
          - country (string): Country
          - state (string): State
          - city (string): City
          - address1 (string): Address 1
          - bankname (string): Tên ngân hàng
          - bankaccount (string): Số tài khoản
          - bankaccountname (string): Tên tài khoản
        """
        return self._call("PUT", "/details", body=self._body(payload, fields))

    def update_settings(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Update Client Settings

        POST /clientarea/settings — Bearer token required, from the API specification.

        Body fields:
          - configs (array): Value to setting: RecordsPerPage, DefaultTimezone, DefaultPaymentModule, CreditAutoApply, ClientNotifications, DefaultNameservers
        """
        return self._call("POST", "/clientarea/settings", body=self._body(payload, fields))

    def upload_signed_business_profile(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Upload profile signed

        POST /clientarea/uploadprofile — Bearer token required, from the API specification.

        Body fields:
          - base64Content (string, required)
        """
        return self._call("POST", "/clientarea/uploadprofile", body=self._body(payload, fields))
