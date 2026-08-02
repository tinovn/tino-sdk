# Client area & account (part 1/3)

SDK namespace: `client.account` (Python) · `client.account` (Node.js, PHP).

13 operation(s) in this chapter, 11 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/changeowner` | [`listOwnerTransfers`](#accountlistownertransfers) | Bearer |
| `GET` | `/clientarea` | [`getSummary`](#accountgetsummary) | Bearer |
| `GET` | `/clientarea/businessinfo` | [`getBusinessInfo`](#accountgetbusinessinfo) | Bearer |
| `GET` | `/clientarea/downloadprofile` | [`downloadBusinessProfile`](#accountdownloadbusinessprofile) | Bearer |
| `GET` | `/clientarea/histories` | [`listHistories`](#accountlisthistories) | Bearer |
| `GET` | `/clientarea/history/emails` | [`listEmails`](#accountlistemails) | Bearer |
| `GET` | `/clientarea/history/emails/{id}` | [`getEmail`](#accountgetemail) | Bearer |
| `GET` | `/clientarea/nav/service` | [`getServiceNav`](#accountgetservicenav) | Bearer |
| `POST` | `/clientarea/search/` | [`search`](#accountsearch) | Bearer |
| `GET` | `/clientarea/settings` | [`getSettings`](#accountgetsettings) | Bearer |
| `POST` | `/clientarea/settings` | [`updateSettings`](#accountupdatesettings) | Bearer |
| `GET` | `/clientarea/statuses` | [`listStatuses`](#accountliststatuses) | Bearer |
| `POST` | `/clientarea/uploadprofile` | [`uploadSignedBusinessProfile`](#accountuploadsignedbusinessprofile) | Bearer |

---

### `account.listOwnerTransfers`

`GET /changeowner` — Bearer token · verified live

**ChangeOwner Service**

Sử dụng: &rel_id=:serviceId&rel_type=:ServiceType&make=(reject|approve) để xác nhận hay hủy

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "transfers": null
}
```

</details>

**SDK**

```python
client.account.list_owner_transfers()
```
```javascript
await client.account.listOwnerTransfers();
```
```php
$client->account->listOwnerTransfers();
```

---

### `account.getSummary`

`GET /clientarea` — Bearer token · verified live

**Summany info**

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "total": {
  "invoices": 1,
  "domains": 1,
  "tickets": 3,
  "services": 3
 }
}
```

</details>

**SDK**

```python
client.account.get_summary()
```
```javascript
await client.account.getSummary();
```
```php
$client->account->getSummary();
```

---

### `account.getBusinessInfo`

`GET /clientarea/businessinfo` — Bearer token · verified live

**Get business info**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `taxid` | query | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "error": [
  "Please enter taxid"
 ]
}
```

</details>

**SDK**

```python
client.account.get_business_info()
```
```javascript
await client.account.getBusinessInfo();
```
```php
$client->account->getBusinessInfo();
```

---

### `account.downloadBusinessProfile`

`GET /clientarea/downloadprofile` — Bearer token · verified live

**Get business file**

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
"%PDF-1.4\n%����\n3 0 obj\n<</Type /Page\n/Parent 1 0 R\n/MediaBox [0 0 595.280 841.890]\n/TrimBox [0.000 0.000 595.280 841.890]\n/Resources 2 0 R\n/Group << /Type /Group /S /Transparency /CS /DeviceRGB >> \n/Annots [ 5 0 R ] \n/Contents 4 0 R>>\nendobj\n4 0 obj\n<</Filter /FlateDecode /Length 1571>>\nstream\nx��X_…"
```

</details>

**SDK**

```python
client.account.download_business_profile()
```
```javascript
await client.account.downloadBusinessProfile();
```
```php
$client->account->downloadBusinessProfile();
```

---

### `account.listHistories`

`GET /clientarea/histories` — Bearer token · verified live

**List history**

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
   "logid": "940001",
   "date": "2026-08-02 2001:db8::1",
   "description": "Update Extended Info #ID 200001 ",
   "result": "1",
   "type": "domain",
   "id": "200001",
   "ip": "203.0.113.10"
  },
  {
   "logid": "1149966",
   "date": "2026-08-02 2001:db8::1",
   "description": "Update Extended Info #ID 200001 ",
   "result": "1",
   "type": "domain",
   "id": "200001",
   "ip": "203.0.113.10"
  },
  "… 90 more item(s)"
 ],
 "page": {
  "total": 92,
  "pages": 1,
  "current": 1
 }
}
```

</details>

**SDK**

```python
client.account.list_histories()
```
```javascript
await client.account.listHistories();
```
```php
$client->account->listHistories();
```

---

### `account.listEmails`

`GET /clientarea/history/emails` — Bearer token · verified live

**Emails history**

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
 "emails": [
  {
   "id": "800001",
   "subject": "[Y&ecirc;u cầu hỗ trợ #400001] test suport.org",
   "date": "2026-07-27 2001:db8::1",
   "email": "user@example.com"
  },
  {
   "id": "2769212",
   "subject": "Th&ocirc;ng tin t&agrave;i khoản Hosting tại TinoGroup.",
   "date": "2026-07-26 2001:db8::1",
   "email": "user@example.com"
  },
  "… 31 more item(s)"
 ],
 "page": {
  "total": 33,
  "pages": 1,
  "current": 1
 }
}
```

</details>

**SDK**

```python
client.account.list_emails()
```
```javascript
await client.account.listEmails();
```
```php
$client->account->listEmails();
```

---

### `account.getEmail`

`GET /clientarea/history/emails/{id}` — Bearer token · verified live

**Email Details**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Email ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "email": {
  "id": "800001",
  "email": "user@example.com",
  "subject": "[Y&ecirc;u cầu hỗ trợ #400001] test suport.org",
  "message": "Xin ch&agrave;o, B&igrave;nh Trần Tran,<br />\n<br />\nY&ecirc;u cầu hỗ trợ/Ticket: #400001 đ&atilde; được thay đổi trạng th&aacute;i từ mở sang đ&oacute;ng.<br />\nThời gian trả lời cuối: 72 giờ trước.<br />\n<br />\nNếu vấn đề của bạn chưa được ho&agrave;n tất v&agrave; đ&acirc;y l&agrave; một sự nhầm …",
  "date": "2026-07-27 2001:db8::1",
  "status": "1",
  "flag": "email"
 }
}
```

</details>

**SDK**

```python
client.account.get_email(id)
```
```javascript
await client.account.getEmail(id);
```
```php
$client->account->getEmail($id);
```

---

### `account.getServiceNav`

`GET /clientarea/nav/service` — Bearer token · verified live

**Service menus**

Get list Categories for Service.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "categories": [
  {
   "id": 84,
   "name": "Cloud Instance",
   "description": "",
   "slug": "cloud-instance",
   "subcategories": [
    {
     "id": 93,
     "name": "Hermes Agent",
     "description": "",
     "slug": "hermes-agent"
    },
    {
     "id": 70,
     "name": "NVMe VPS ",
     "description": "",
     "slug": "nvme-vps"
    },
    "… 3 more item(s)"
   ]
  },
  {
   "id": 54,
   "name": "Web Hosting",
   "description": "",
   "slug": "web-hosting",
   "subcategories": [
    {
     "id": 74,
     "name": "Hosting NVMe",
     "description": "<p>Trải nghiệm tốc độ siêu nhanh với ổ cứng NVMe Enterprise chuẩn U.2 với giá tốt nhất. Phần cứng máy chủ cao cấp và mạnh mẽ với vi xử lý Intel Xeon Scalable Gen 2, máy chủ Dell chuyên dụng cho mọi nhà.</p>",
     "slug": "hosting-nvme"
    },
    {
     "id": 53,
     "name": "Business Hosting",
     "description": "\n<p>Trải nghiệm tốc độ siêu nhanh với ổ cứng NVMe Enterprise chuẩn U.2 với giá tốt nhất. Phần cứng máy chủ cao cấp và mạnh mẽ với vi xử lý Intel Xeon Scalable Gen 2, máy chủ Dell chuyên dụng dành cho doanh nghiệp.</p>\n",
     "slug": "business-hosting"
    },
    "… 4 more item(s)"
   ]
  },
  "… 7 more item(s)"
  … 2 more line(s)
```

</details>

**SDK**

```python
client.account.get_service_nav()
```
```javascript
await client.account.getServiceNav();
```
```php
$client->account->getServiceNav();
```

---

### `account.search`

`POST /clientarea/search/` — Bearer token · verified live

**Search Service/Product**

> **Note.** The search keyword goes in the request body as {"query": "..."}, not in the path.

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `query` | string | yes | Search keyword (service domain, invoice number, ticket subject, ...) |

```json
{
  "query": "<query>"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "results": {
  "Domains": {
   "name": "Domains",
   "results": [
    {
     "id": "200001",
     "name": "example.com",
     "next_due": "2026-12-07",
     "expires": "07/12/2026",
     "status": "Active",
     "label": "",
     "url": "<panel-link>",
     "title": "#200001 - example.com - <span class=\"badge badge-Active\">Hoạt động</span> - <span class=\"badge badge-details\">07/12/2026</span>"
    }
   ]
  },
  "Accounts": {
   "name": "Accounts",
   "results": [
    {
     "id": "100001",
     "username": "tranbinh18",
     "domain": "example.com",
     "label": "",
     "product_name": "WH 1",
     "category_name": "Platinum Hosting",
     "next_due": "26/08/2026",
     "status": "Active",
     "title": "#100001 - WH 1: Platinum Hosting (example.com) - <span class=\"badge badge-Active\">Hoạt động</span> - <span class=\"badge badge-details\">26/08/2026</span>",
     "url": "<panel-link>"
    },
    {
     "id": "100005",
     "username": "kscvgvgs",
     "domain": "demo1.example.net",
     "label": "",
     "product_name": "Host NVMe 2 GB",
     "category_name": "Cloud Hosting",
     "next_due": "31/03/2027",
     "status": "Cancelled",
     "title": "#100005 - Host NVMe 2 GB: Cloud Hosting (demo1.example.net) - <span class=\"badge badge-Cancelled\">Đã huỷ</span> - <span class=\"badge badge-details\">31/03/2027</span>",
     "url": "<panel-link>"
    },
    "… 3 more item(s)"
  … 4 more line(s)
```

</details>

**SDK**

```python
client.account.search(query=...)
```
```javascript
await client.account.search({ query: ... });
```
```php
$client->account->search(['query' => ...]);
```

---

### `account.getSettings`

`GET /clientarea/settings` — Bearer token · verified live

**Get Client Settings**

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "settings": {
  "RecordsPerPage": {
   "title": "Số dòng hiển thị mỗi trang",
   "description": "",
   "type": "select",
   "items": [
    {
     "id": 51,
     "option_id": "43",
     "title": "25",
     "description": "",
     "value": "25",
     "sort": "1",
     "admin_only": false,
     "selected": false,
     "name": "configs[RecordsPerPage]"
    },
    {
     "id": 52,
     "option_id": "43",
     "title": "50",
     "description": "",
     "value": "50",
     "sort": "1",
     "admin_only": false,
     "selected": false,
     "name": "configs[RecordsPerPage]"
    },
    "… 2 more item(s)"
   ],
   "name": "configs[RecordsPerPage]",
   "selected": {
    "id": 53,
    "option_id": "43",
    "title": "100",
    "description": "",
    "value": "100",
    "sort": "1",
    "admin_only": false
   }
  },
  "DefaultTimezone": {
   "title": "Múi giờ",
   "description": "",
  … 382 more line(s)
```

</details>

**SDK**

```python
client.account.get_settings()
```
```javascript
await client.account.getSettings();
```
```php
$client->account->getSettings();
```

---

### `account.updateSettings`

`POST /clientarea/settings` — Bearer token · spec only

**Update Client Settings**

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `configs` | array | no | Value to setting: RecordsPerPage, DefaultTimezone, DefaultPaymentModule, CreditAutoApply, ClientNotifications, DefaultNameservers |

```json
{
  "configs": []
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.account.update_settings(configs=...)
```
```javascript
await client.account.updateSettings({ configs: ... });
```
```php
$client->account->updateSettings(['configs' => ...]);
```

---

### `account.listStatuses`

`GET /clientarea/statuses` — Bearer token · verified live

**List status key**

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "invoice": [
  "Paid",
  "Unpaid",
  "… 4 more item(s)"
 ],
 "domain": [
  "Pending",
  "Active",
  "… 4 more item(s)"
 ],
 "ticket": [
  "Open",
  "Closed",
  "… 4 more item(s)"
 ],
 "service": [
  "Pending",
  "Active",
  "… 4 more item(s)"
 ],
 "estimates": [
  "Draft",
  "Sent",
  "… 3 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.account.list_statuses()
```
```javascript
await client.account.listStatuses();
```
```php
$client->account->listStatuses();
```

---

### `account.uploadSignedBusinessProfile`

`POST /clientarea/uploadprofile` — Bearer token · spec only

**Upload profile signed**

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `base64Content` | string | yes | — |

```json
{
  "base64Content": "<base64Content>"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.account.upload_signed_business_profile(base64_content=...)
```
```javascript
await client.account.uploadSignedBusinessProfile({ base64Content: ... });
```
```php
$client->account->uploadSignedBusinessProfile(['base64Content' => ...]);
```

---
