<?php

declare(strict_types=1);

/**
 * Client area & account.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Client area & account — 29 operations.
 */
class Account extends Resource
{
    /**
     * Acknowledge notification
     *
     * PUT /notifications/{id}/ack — Bearer token required, verified against the live API.
     *
     * Marks the notification as read
     *
     * thêm params['seen_all']=true để mark real all notifications
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function acknowledgeNotification($id, array $body = [], array $query = [])
    {
        $path = $this->path('/notifications/{id}/ack', ['id' => $id]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Add contact
     *
     * POST /contact — Bearer token required, from the API specification.
     *
     * Create new contact account, if password is provided you
     * can use provided email addres to login as that contact.
     *
     * Body fields:
     *   - password (string): Optional, allows you to login as contact
     *   - privileges (array): Array with privileges that you want to enable. Formatted the same way as output from GET /contact/privileges</code>
     *   - type (string, one of Private, Company): Account Type
     *   - companyname (string): Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân
     *   - taxid (string): Mã số thuế
     *   - gender (string, one of Male, Female): Danh xưng
     *   - lastname (string): Last Name
     *   - firstname (string): First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền.
     *   - nationalid (string): Số CCCD/Passport
     *   - email (string): Email Address
     *   - birthday (string): Ngày sinh - Định dạng đúng dd/mm/yyyy
     *   - phonenumber (string): Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn.
     *   - country (string): Country
     *   - state (string): State
     *   - city (string): City
     *   - address1 (string): Address 1
     *   - bankname (string): Tên ngân hàng
     *   - bankaccount (string): Số tài khoản
     *   - bankaccountname (string): Tên tài khoản
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function createContact(array $body = [], array $query = [])
    {
        return $this->call('POST', '/contact', ['query' => $query, 'body' => $body]);
    }

    /**
     * Get business file
     *
     * GET /clientarea/downloadprofile — Bearer token required, verified against the live API.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function downloadBusinessProfile(array $query = [])
    {
        return $this->call('GET', '/clientarea/downloadprofile', ['query' => $query]);
    }

    /**
     * Download File
     *
     * GET /download/{id} — Bearer token required, from the API specification.
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function downloadFile($id, array $query = [])
    {
        $path = $this->path('/download/{id}', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get business info
     *
     * GET /clientarea/businessinfo — Bearer token required, verified against the live API.
     *
     * Query parameters:
     *   - taxid (required)
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getBusinessInfo(array $query = [])
    {
        return $this->call('GET', '/clientarea/businessinfo', ['query' => $query]);
    }

    /**
     * Get contacts details
     *
     * GET /contact/{id} — Bearer token required, verified against the live API.
     *
     * Return array with contact details
     *
     * Path parameters:
     *   - id: Contact ID
     *
     * @param string|int $id Contact ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getContact($id, array $query = [])
    {
        $path = $this->path('/contact/{id}', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Contact privileges
     *
     * GET /contact/privileges — Bearer token required, verified against the live API.
     *
     * List possible contact privileges.
     * Each domain and service may list additional privileges, depending on available features.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getContactPrivileges(array $query = [])
    {
        return $this->call('GET', '/contact/privileges', ['query' => $query]);
    }

    /**
     * User Details
     *
     * GET /details — Bearer token required, verified against the live API.
     *
     * Return registration details for my account
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getDetails(array $query = [])
    {
        return $this->call('GET', '/details', ['query' => $query]);
    }

    /**
     * Email Details
     *
     * GET /clientarea/history/emails/{id} — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Email ID
     *
     * @param string|int $id Email ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getEmail($id, array $query = [])
    {
        $path = $this->path('/clientarea/history/emails/{id}', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Service menus
     *
     * GET /clientarea/nav/service — Bearer token required, verified against the live API.
     *
     * Get list Categories for Service.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getServiceNav(array $query = [])
    {
        return $this->call('GET', '/clientarea/nav/service', ['query' => $query]);
    }

    /**
     * Get Client Settings
     *
     * GET /clientarea/settings — Bearer token required, verified against the live API.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getSettings(array $query = [])
    {
        return $this->call('GET', '/clientarea/settings', ['query' => $query]);
    }

    /**
     * Summany info
     *
     * GET /clientarea — Bearer token required, verified against the live API.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getSummary(array $query = [])
    {
        return $this->call('GET', '/clientarea', ['query' => $query]);
    }

    /**
     * List contacts
     *
     * GET /contact — Bearer token required, verified against the live API.
     *
     * Return a list of contacts on this account
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listContacts(array $query = [])
    {
        return $this->call('GET', '/contact', ['query' => $query]);
    }

    /**
     * List contacts
     *
     * GET /contacts — Bearer token required, verified against the live API.
     *
     * Return a list of contacts on this account
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listContactsLegacy(array $query = [])
    {
        return $this->call('GET', '/contacts', ['query' => $query]);
    }

    /**
     * Downloads
     *
     * GET /downloads — Bearer token required, verified against the live API.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listDownloads(array $query = [])
    {
        return $this->call('GET', '/downloads', ['query' => $query]);
    }

    /**
     * Emails history
     *
     * GET /clientarea/history/emails — Bearer token required, verified against the live API.
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listEmails(array $query = [])
    {
        return $this->call('GET', '/clientarea/history/emails', ['query' => $query]);
    }

    /**
     * List history
     *
     * GET /clientarea/histories — Bearer token required, verified against the live API.
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listHistories(array $query = [])
    {
        return $this->call('GET', '/clientarea/histories', ['query' => $query]);
    }

    /**
     * User Logs
     *
     * GET /logs — Bearer token required, verified against the live API.
     *
     * Returns logs from history
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listLogs(array $query = [])
    {
        return $this->call('GET', '/logs', ['query' => $query]);
    }

    /**
     * List new portal notifications
     *
     * GET /notifications/new — Bearer token required, verified against the live API.
     *
     * Return only new portal notifications.
     *
     * Query parameters:
     *   - rel_type: Optional, return only by relation type
     *   - rel_id: Optional, return only by relation id
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listNewNotifications(array $query = [])
    {
        return $this->call('GET', '/notifications/new', ['query' => $query]);
    }

    /**
     * List all portal notifications
     *
     * GET /notifications — Bearer token required, verified against the live API.
     *
     * Return a list of all portal notifications.
     *
     * Query parameters:
     *   - rel_type: Optional, return only by relation type
     *   - rel_id: Optional, return only by relation id
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listNotifications(array $query = [])
    {
        return $this->call('GET', '/notifications', ['query' => $query]);
    }

    /**
     * ChangeOwner Service
     *
     * GET /changeowner — Bearer token required, verified against the live API.
     *
     * Sử dụng: &rel_id=:serviceId&rel_type=:ServiceType&make=(reject|approve) để xác nhận hay
     * hủy
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listOwnerTransfers(array $query = [])
    {
        return $this->call('GET', '/changeowner', ['query' => $query]);
    }

    /**
     * List status key
     *
     * GET /clientarea/statuses — Bearer token required, verified against the live API.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listStatuses(array $query = [])
    {
        return $this->call('GET', '/clientarea/statuses', ['query' => $query]);
    }

    /**
     * Search Service/Product
     *
     * POST /clientarea/search/ — Bearer token required, verified against the live API.
     *
     * Note: The search keyword goes in the request body as {"query": "..."}, not in the path.
     *
     * Body fields:
     *   - query (string, required): Search keyword (service domain, invoice number, ticket subject, ...)
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function search(array $body = [], array $query = [])
    {
        return $this->call('POST', '/clientarea/search/', ['query' => $query, 'body' => $body]);
    }

    /**
     * status server api
     *
     * GET /status — no authentication required, verified against the live API.
     *
     * Return only new portal notifications.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function status(array $query = [])
    {
        return $this->call('GET', '/status', ['query' => $query, 'authenticated' => false]);
    }

    /**
     * submit contact form
     *
     * POST /submit_contactform — no authentication required, from the API specification.
     *
     * ok
     *
     * Body fields:
     *   - cfmName (string): Your acount email address
     *   - cfmPhone (string): Your acount email address
     *   - cfmEmail (string): Your acount email address
     *   - cfmMessage (string): Your acount email address
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function submitContactForm(array $body = [], array $query = [])
    {
        return $this->call('POST', '/submit_contactform', ['query' => $query, 'body' => $body, 'authenticated' => false]);
    }

    /**
     * Edit contact
     *
     * PUT /contact/{id} — Bearer token required, from the API specification.
     *
     * Change contact details`
     *
     * Body fields:
     *   - id (integer): Contact ID
     *   - privileges (array): Array with privileges that you want to enable. Formatted the same way as output from GET /contact/privileges</code>
     *   - type (string, one of Private, Company): Account Type
     *   - companyname (string): Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân
     *   - taxid (string): Mã số thuế
     *   - gender (string, one of Male, Female): Danh xưng
     *   - lastname (string): Last Name
     *   - firstname (string): First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền.
     *   - nationalid (string): Số CCCD/Passport
     *   - email (string): Email Address
     *   - birthday (string): Ngày sinh - Định dạng đúng dd/mm/yyyy
     *   - phonenumber (string): Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn.
     *   - country (string): Country
     *   - state (string): State
     *   - city (string): City
     *   - address1 (string): Address 1
     *   - bankname (string): Tên ngân hàng
     *   - bankaccount (string): Số tài khoản
     *   - bankaccountname (string): Tên tài khoản
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateContact($id, array $body = [], array $query = [])
    {
        $path = $this->path('/contact/{id}', ['id' => $id]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Update User Details
     *
     * PUT /details — Bearer token required, from the API specification.
     *
     * Update registration details under my account
     *
     * Body fields:
     *   - type (string, one of Private, Company): Account Type
     *   - companyname (string): Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân
     *   - taxid (string): Mã số thuế
     *   - gender (string, one of Male, Female): Danh xưng
     *   - lastname (string): Last Name
     *   - firstname (string): First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền.
     *   - nationalid (string): Số CCCD/Passport
     *   - birthday (string): Ngày sinh - Định dạng đúng dd/mm/yyyy
     *   - phonenumber (string): Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn.
     *   - country (string): Country
     *   - state (string): State
     *   - city (string): City
     *   - address1 (string): Address 1
     *   - bankname (string): Tên ngân hàng
     *   - bankaccount (string): Số tài khoản
     *   - bankaccountname (string): Tên tài khoản
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateDetails(array $body = [], array $query = [])
    {
        return $this->call('PUT', '/details', ['query' => $query, 'body' => $body]);
    }

    /**
     * Update Client Settings
     *
     * POST /clientarea/settings — Bearer token required, from the API specification.
     *
     * Body fields:
     *   - configs (array): Value to setting: RecordsPerPage, DefaultTimezone, DefaultPaymentModule, CreditAutoApply, ClientNotifications, DefaultNameservers
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateSettings(array $body = [], array $query = [])
    {
        return $this->call('POST', '/clientarea/settings', ['query' => $query, 'body' => $body]);
    }

    /**
     * Upload profile signed
     *
     * POST /clientarea/uploadprofile — Bearer token required, from the API specification.
     *
     * Body fields:
     *   - base64Content (string, required)
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function uploadSignedBusinessProfile(array $body = [], array $query = [])
    {
        return $this->call('POST', '/clientarea/uploadprofile', ['query' => $query, 'body' => $body]);
    }

}
