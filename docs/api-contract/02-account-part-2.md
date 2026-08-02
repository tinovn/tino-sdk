# Client area & account (part 2/3)

SDK namespace: `client.account` (Python) · `client.account` (Node.js, PHP).

11 operation(s) in this chapter, 7 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/contact` | [`listContacts`](#accountlistcontacts) | Bearer |
| `POST` | `/contact` | [`createContact`](#accountcreatecontact) | Bearer |
| `GET` | `/contact/privileges` | [`getContactPrivileges`](#accountgetcontactprivileges) | Bearer |
| `GET` | `/contact/{id}` | [`getContact`](#accountgetcontact) | Bearer |
| `PUT` | `/contact/{id}` | [`updateContact`](#accountupdatecontact) | Bearer |
| `GET` | `/contacts` | [`listContactsLegacy`](#accountlistcontactslegacy) | Bearer |
| `GET` | `/details` | [`getDetails`](#accountgetdetails) | Bearer |
| `PUT` | `/details` | [`updateDetails`](#accountupdatedetails) | Bearer |
| `GET` | `/download/{id}` | [`downloadFile`](#accountdownloadfile) | Bearer |
| `GET` | `/downloads` | [`listDownloads`](#accountlistdownloads) | Bearer |
| `GET` | `/logs` | [`listLogs`](#accountlistlogs) | Bearer |

---

### `account.listContacts`

`GET /contact` — Bearer token · verified live

**List contacts**

Return a list of contacts on this account

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `page` | query | integer | no | Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current. Default: `0`. |
| `perpage` | query | integer | no | Rows per page. Defaults to the account's RecordsPerPage setting. |
| `orderby` | query | string | no | Sort expression in the form `field\|DESC` or `field\|ASC`, e.g. `date\|DESC`. |
| `filter` | query | object | no | Endpoint-specific filters, serialised as filter[key]=value. |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "contacts": null,
 "page": {
  "current": 0,
  "total": 0
 }
}
```

</details>

**SDK**

```python
client.account.list_contacts()
```
```javascript
await client.account.listContacts();
```
```php
$client->account->listContacts();
```

---

### `account.createContact`

`POST /contact` — Bearer token · spec only

**Add contact**

Create new contact account, if password is provided you
can use provided email addres to login as that contact.

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `password` | string | no | Optional, allows you to login as contact |
| `privileges` | array | no | Array with privileges that you want to enable. Formatted the same way as output from GET /contact/privileges</code> |
| `type` | string | no | Account Type One of: `Private`, `Company` |
| `companyname` | string | no | Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân |
| `taxid` | string | no | Mã số thuế |
| `gender` | string | no | Danh xưng One of: `Male`, `Female` |
| `lastname` | string | no | Last Name |
| `firstname` | string | no | First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền. |
| `nationalid` | string | no | Số CCCD/Passport |
| `email` | string | no | Email Address |
| `birthday` | string | no | Ngày sinh - Định dạng đúng dd/mm/yyyy |
| `phonenumber` | string | no | Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn. |
| `country` | string | no | Country |
| `state` | string | no | State |
| `city` | string | no | City |
| `address1` | string | no | Address 1 |
| `bankname` | string | no | Tên ngân hàng |
| `bankaccount` | string | no | Số tài khoản |
| `bankaccountname` | string | no | Tên tài khoản |

```json
{
  "password": "passwordValue",
  "privileges": "privilegesValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.account.create_contact(password=...)
```
```javascript
await client.account.createContact({ password: ... });
```
```php
$client->account->createContact(['password' => ...]);
```

---

### `account.getContactPrivileges`

`GET /contact/privileges` — Bearer token · verified live

**Contact privileges**

List possible contact privileges.
Each domain and service may list additional privileges, depending on available features.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "privileges": {
  "billing": [
   "emails",
   "newinvoices",
   "… 11 more item(s)"
  ],
  "support": [
   "newticket",
   "tickets",
   "… 3 more item(s)"
  ],
  "disabled_support_departments": [
   2,
   3,
   "… 5 more item(s)"
  ],
  "misc": [
   "editmain",
   "manageservicegroups",
   "… 9 more item(s)"
  ],
  "services": {
   "full": 1,
   "100001": [
    "basic",
    "billing",
    "… 18 more item(s)"
   ],
   "100002": [
    "basic",
    "billing",
    "… 23 more item(s)"
   ],
   "100003": [
    "basic",
    "billing",
    "… 5 more item(s)"
   ]
  },
  "domains": {
   "full": 1,
   "200001": [
    "basic",
    "renew",
  … 25 more line(s)
```

</details>

**SDK**

```python
client.account.get_contact_privileges()
```
```javascript
await client.account.getContactPrivileges();
```
```php
$client->account->getContactPrivileges();
```

---

### `account.getContact`

`GET /contact/{id}` — Bearer token · verified live

**Get contacts details**

Return array with contact details

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Contact ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "privileges": {
  "billing": [
   "emails",
   "newinvoices",
   "… 11 more item(s)"
  ],
  "support": [
   "newticket",
   "tickets",
   "… 3 more item(s)"
  ],
  "disabled_support_departments": [
   2,
   3,
   "… 5 more item(s)"
  ],
  "misc": [
   "editmain",
   "manageservicegroups",
   "… 9 more item(s)"
  ],
  "services": {
   "full": 1,
   "100001": [
    "basic",
    "billing",
    "… 18 more item(s)"
   ],
   "100002": [
    "basic",
    "billing",
    "… 23 more item(s)"
   ],
   "100003": [
    "basic",
    "billing",
    "… 5 more item(s)"
   ]
  },
  "domains": {
   "full": 1,
   "200001": [
    "basic",
    "renew",
  … 25 more line(s)
```

</details>

**SDK**

```python
client.account.get_contact(id)
```
```javascript
await client.account.getContact(id);
```
```php
$client->account->getContact($id);
```

---

### `account.updateContact`

`PUT /contact/{id}` — Bearer token · spec only

**Edit contact**

Change contact details`

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Contact ID |
| `privileges` | array | no | Array with privileges that you want to enable. Formatted the same way as output from GET /contact/privileges</code> |
| `type` | string | no | Account Type One of: `Private`, `Company` |
| `companyname` | string | no | Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân |
| `taxid` | string | no | Mã số thuế |
| `gender` | string | no | Danh xưng One of: `Male`, `Female` |
| `lastname` | string | no | Last Name |
| `firstname` | string | no | First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền. |
| `nationalid` | string | no | Số CCCD/Passport |
| `email` | string | no | Email Address |
| `birthday` | string | no | Ngày sinh - Định dạng đúng dd/mm/yyyy |
| `phonenumber` | string | no | Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn. |
| `country` | string | no | Country |
| `state` | string | no | State |
| `city` | string | no | City |
| `address1` | string | no | Address 1 |
| `bankname` | string | no | Tên ngân hàng |
| `bankaccount` | string | no | Số tài khoản |
| `bankaccountname` | string | no | Tên tài khoản |

```json
{
  "id": "idValue",
  "privileges": "privilegesValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.account.update_contact(id, id=...)
```
```javascript
await client.account.updateContact(id, { id: ... });
```
```php
$client->account->updateContact($id, ['id' => ...]);
```

---

### `account.listContactsLegacy`

`GET /contacts` — Bearer token · verified live

**List contacts**

Return a list of contacts on this account

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `page` | query | integer | no | Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current. Default: `0`. |
| `perpage` | query | integer | no | Rows per page. Defaults to the account's RecordsPerPage setting. |
| `orderby` | query | string | no | Sort expression in the form `field\|DESC` or `field\|ASC`, e.g. `date\|DESC`. |
| `filter` | query | object | no | Endpoint-specific filters, serialised as filter[key]=value. |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "contacts": null,
 "page": {
  "current": 0,
  "total": 0
 }
}
```

</details>

**SDK**

```python
client.account.list_contacts_legacy()
```
```javascript
await client.account.listContactsLegacy();
```
```php
$client->account->listContactsLegacy();
```

---

### `account.getDetails`

`GET /details` — Bearer token · verified live

**User Details**

Return registration details for my account

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "client": {
  "id": "700001",
  "group_id": "0",
  "email": "user@example.com",
  "lastlogin": "2026-08-02 2001:db8::1",
  "ip": "203.0.113.10",
  "host": "host.example",
  "firstname": "Nguyen Van",
  "lastname": "A",
  "companyname": "Example Company Ltd",
  "address1": "123 Example Street",
  "city": "Phường An Hội Tây",
  "state": "Thành phố Hồ Chí Minh",
  "country": "VN",
  "phonenumber": "+84.900000000",
  "language": "vietnamese",
  "company": false,
  "currency_id": "0",
  "taxid": "0100000000",
  "nationalid": "000000000000",
  "birthday": "01/01/1990",
  "…": "3 more key(s)"
 },
 "update_required": true,
 "currency": {
  "code": "đ",
  "iso": "VND",
  "sign": "",
  "format": "1,234.56",
  "decimal": "0",
  "id": 0
 },
 "verify": {
  "email": "user@example.com"
 }
}
```

</details>

**SDK**

```python
client.account.get_details()
```
```javascript
await client.account.getDetails();
```
```php
$client->account->getDetails();
```

---

### `account.updateDetails`

`PUT /details` — Bearer token · spec only

**Update User Details**

Update registration details under my account

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `type` | string | no | Account Type One of: `Private`, `Company` |
| `companyname` | string | no | Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân |
| `taxid` | string | no | Mã số thuế |
| `gender` | string | no | Danh xưng One of: `Male`, `Female` |
| `lastname` | string | no | Last Name |
| `firstname` | string | no | First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền. |
| `nationalid` | string | no | Số CCCD/Passport |
| `birthday` | string | no | Ngày sinh - Định dạng đúng dd/mm/yyyy |
| `phonenumber` | string | no | Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn. |
| `country` | string | no | Country |
| `state` | string | no | State |
| `city` | string | no | City |
| `address1` | string | no | Address 1 |
| `bankname` | string | no | Tên ngân hàng |
| `bankaccount` | string | no | Số tài khoản |
| `bankaccountname` | string | no | Tên tài khoản |

```json
{
  "type": "Private",
  "companyname": "<companyname>",
  "taxid": "<taxid>",
  "gender": "Male",
  "lastname": "<lastname>",
  "firstname": "<firstname>",
  "nationalid": "<nationalid>",
  "birthday": "<birthday>",
  "phonenumber": "<phonenumber>",
  "country": "<country>",
  "state": "<state>",
  "city": "<city>",
  "address1": "<address1>",
  "bankname": "<bankname>",
  "bankaccount": "<bankaccount>",
  "bankaccountname": "<bankaccountname>"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.account.update_details(type=...)
```
```javascript
await client.account.updateDetails({ type: ... });
```
```php
$client->account->updateDetails(['type' => ...]);
```

---

### `account.downloadFile`

`GET /download/{id}` — Bearer token · spec only

**Download File**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.account.download_file(id)
```
```javascript
await client.account.downloadFile(id);
```
```php
$client->account->downloadFile($id);
```

---

### `account.listDownloads`

`GET /downloads` — Bearer token · verified live

**Downloads**

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "categories": {
  "1": {
   "id": "1",
   "parent_cat": "0",
   "name": "Rank Math SEO Pro",
   "description": "",
   "visible": "1",
   "sort_order": "0",
   "files": {
    "1": {
     "id": "10345",
     "category_id": "1",
     "filename": "746836_seo-by-rank-math-pro.zip",
     "name": "Rank Math SEO PRO 3.0.41",
     "description": "",
     "size": "1 603",
     "uploaded": "2023-08-06",
     "downloads": "402",
     "sort_order": "0",
     "type": "zip"
    }
   },
   "slug": "rank-math-seo-pro",
   "categories": []
  },
  "4": {
   "id": "4",
   "parent_cat": "0",
   "name": "Astra Pro &amp; Addons",
   "description": "",
   "visible": "1",
   "sort_order": "0",
   "files": [
    {
     "id": "10336",
     "category_id": "4",
     "filename": "166433_astra-portfolio-1.11.6.zip",
     "name": "WP Portfolio",
     "description": "",
     "size": "295",
     "uploaded": "2023-08-06",
     "downloads": "144",
     "sort_order": "0",
     "type": "zip"
  … 72 more line(s)
```

</details>

**SDK**

```python
client.account.list_downloads()
```
```javascript
await client.account.listDownloads();
```
```php
$client->account->listDownloads();
```

---

### `account.listLogs`

`GET /logs` — Bearer token · verified live

**User Logs**

Returns logs from history

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `page` | query | integer | no | Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current. Default: `0`. |
| `perpage` | query | integer | no | Rows per page. Defaults to the account's RecordsPerPage setting. |
| `orderby` | query | string | no | Sort expression in the form `field\|DESC` or `field\|ASC`, e.g. `date\|DESC`. |
| `filter` | query | object | no | Endpoint-specific filters, serialised as filter[key]=value. |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "logs": [
  {
   "logid": "950001",
   "date": "2025-10-21 2001:db8::1",
   "description": "Client placed new order #960001  (203.0.113.10)",
   "result": "1",
   "type": "client",
   "id": null,
   "ip": "203.0.113.10"
  },
  {
   "logid": "44640",
   "date": "2026-03-30 2001:db8::1",
   "description": "Client placed new order #1143928092  (203.0.113.10)",
   "result": "1",
   "type": "client",
   "id": null,
   "ip": "203.0.113.10"
  },
  "… 90 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.account.list_logs()
```
```javascript
await client.account.listLogs();
```
```php
$client->account->listLogs();
```

---
