// Client area & account.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Client area & account — 29 operations. */
export class AccountResource extends Resource {
  /**
   * Acknowledge notification
   *
   * PUT /notifications/{id}/ack — Bearer token required, verified against the live API.
   *
   * Marks the notification as read
   *
   * thêm params['seen_all']=true để mark real all notifications
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  acknowledgeNotification(id, body = undefined, query = {}) {
    const path = this._path('/notifications/{id}/ack', { id: id });
    return this._call('PUT', path, { query, body });
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
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  createContact(body = undefined, query = {}) {
    return this._call('POST', '/contact', { query, body });
  }

  /**
   * Get business file
   *
   * GET /clientarea/downloadprofile — Bearer token required, verified against the live API.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  downloadBusinessProfile(query = {}) {
    return this._call('GET', '/clientarea/downloadprofile', { query });
  }

  /**
   * Download File
   *
   * GET /download/{id} — Bearer token required, from the API specification.
   * @param {string|number} id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  downloadFile(id, query = {}) {
    const path = this._path('/download/{id}', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Get business info
   *
   * GET /clientarea/businessinfo — Bearer token required, verified against the live API.
   *
   * Query parameters:
   *   - taxid (required)
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getBusinessInfo(query = {}) {
    return this._call('GET', '/clientarea/businessinfo', { query });
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
   * @param {string|number} id Contact ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getContact(id, query = {}) {
    const path = this._path('/contact/{id}', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Contact privileges
   *
   * GET /contact/privileges — Bearer token required, verified against the live API.
   *
   * List possible contact privileges.
   * Each domain and service may list additional privileges, depending on available features.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getContactPrivileges(query = {}) {
    return this._call('GET', '/contact/privileges', { query });
  }

  /**
   * User Details
   *
   * GET /details — Bearer token required, verified against the live API.
   *
   * Return registration details for my account
   *
   * Note: The response now carries verify.phone (bool) and a phone block {status,
   * verified_at}. status is one of verified | unverified | taken_by_other | missing. Note
   * that the top-level update_required is about the profile (national id, address), not the
   * phone.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getDetails(query = {}) {
    return this._call('GET', '/details', { query });
  }

  /**
   * Email Details
   *
   * GET /clientarea/history/emails/{id} — Bearer token required, verified against the live API.
   *
   * Path parameters:
   *   - id: Email ID
   * @param {string|number} id Email ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getEmail(id, query = {}) {
    const path = this._path('/clientarea/history/emails/{id}', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * Service menus
   *
   * GET /clientarea/nav/service — Bearer token required, verified against the live API.
   *
   * Get list Categories for Service.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getServiceNav(query = {}) {
    return this._call('GET', '/clientarea/nav/service', { query });
  }

  /**
   * Get Client Settings
   *
   * GET /clientarea/settings — Bearer token required, verified against the live API.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getSettings(query = {}) {
    return this._call('GET', '/clientarea/settings', { query });
  }

  /**
   * Summany info
   *
   * GET /clientarea — Bearer token required, verified against the live API.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getSummary(query = {}) {
    return this._call('GET', '/clientarea', { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listContacts(query = {}) {
    return this._call('GET', '/contact', { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listContactsLegacy(query = {}) {
    return this._call('GET', '/contacts', { query });
  }

  /**
   * Downloads
   *
   * GET /downloads — Bearer token required, verified against the live API.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listDownloads(query = {}) {
    return this._call('GET', '/downloads', { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listEmails(query = {}) {
    return this._call('GET', '/clientarea/history/emails', { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listHistories(query = {}) {
    return this._call('GET', '/clientarea/histories', { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listLogs(query = {}) {
    return this._call('GET', '/logs', { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listNewNotifications(query = {}) {
    return this._call('GET', '/notifications/new', { query });
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
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listNotifications(query = {}) {
    return this._call('GET', '/notifications', { query });
  }

  /**
   * ChangeOwner Service
   *
   * GET /changeowner — Bearer token required, verified against the live API.
   *
   * Sử dụng: &rel_id=:serviceId&rel_type=:ServiceType&make=(reject|approve) để xác nhận hay
   * hủy
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listOwnerTransfers(query = {}) {
    return this._call('GET', '/changeowner', { query });
  }

  /**
   * List status key
   *
   * GET /clientarea/statuses — Bearer token required, verified against the live API.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listStatuses(query = {}) {
    return this._call('GET', '/clientarea/statuses', { query });
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
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  search(body = undefined, query = {}) {
    return this._call('POST', '/clientarea/search/', { query, body });
  }

  /**
   * status server api
   *
   * GET /status — no authentication required, verified against the live API.
   *
   * Return only new portal notifications.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  status(query = {}) {
    return this._call('GET', '/status', { query, authenticated: false });
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
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  submitContactForm(body = undefined, query = {}) {
    return this._call('POST', '/submit_contactform', { query, body, authenticated: false });
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
   * @param {string|number} id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateContact(id, body = undefined, query = {}) {
    const path = this._path('/contact/{id}', { id: id });
    return this._call('PUT', path, { query, body });
  }

  /**
   * Update User Details
   *
   * PUT /details — Bearer token required, from the API specification.
   *
   * Update registration details under my account
   *
   * Note: Changing phonenumber clears the phone verification: phone.status returns to
   * unverified and the old number is released for another account to claim.
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
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateDetails(body = undefined, query = {}) {
    return this._call('PUT', '/details', { query, body });
  }

  /**
   * Update Client Settings
   *
   * POST /clientarea/settings — Bearer token required, from the API specification.
   *
   * Body fields:
   *   - configs (array): Value to setting: RecordsPerPage, DefaultTimezone, DefaultPaymentModule, CreditAutoApply, ClientNotifications, DefaultNameservers
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  updateSettings(body = undefined, query = {}) {
    return this._call('POST', '/clientarea/settings', { query, body });
  }

  /**
   * Upload profile signed
   *
   * POST /clientarea/uploadprofile — Bearer token required, from the API specification.
   *
   * Body fields:
   *   - base64Content (string, required)
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  uploadSignedBusinessProfile(body = undefined, query = {}) {
    return this._call('POST', '/clientarea/uploadprofile', { query, body });
  }

}
