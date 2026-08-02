# Client area & account (part 3/3)

SDK namespace: `client.account` (Python) · `client.account` (Node.js, PHP).

5 operation(s) in this chapter, 3 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/notifications` | [`listNotifications`](#accountlistnotifications) | Bearer |
| `GET` | `/notifications/new` | [`listNewNotifications`](#accountlistnewnotifications) | Bearer |
| `PUT` | `/notifications/{id}/ack` | [`acknowledgeNotification`](#accountacknowledgenotification) | Bearer |
| `GET` | `/status` | [`status`](#accountstatus) | public |
| `POST` | `/submit_contactform` | [`submitContactForm`](#accountsubmitcontactform) | public |

---

### `account.listNotifications`

`GET /notifications` — Bearer token · verified live

**List all portal notifications**

Return a list of all portal notifications.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `rel_type` | query | string | no | Optional, return only by relation type |
| `rel_id` | query | string | no | Optional, return only by relation id |
| `page` | query | integer | no | Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current. Default: `0`. |
| `perpage` | query | integer | no | Rows per page. Defaults to the account's RecordsPerPage setting. |
| `orderby` | query | string | no | Sort expression in the form `field\|DESC` or `field\|ASC`, e.g. `date\|DESC`. |
| `filter` | query | object | no | Endpoint-specific filters, serialised as filter[key]=value. |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "notifications": [
  {
   "id": 920001,
   "client_id": "<redacted>",
   "rel_type": "account",
   "rel_id": "100001",
   "seen": "0",
   "subject": "Thông tin tài khoản Hosting tại TinoGroup.",
   "body": "Dear B&igrave;nh Trần Tran,<br />\n<br />\nTh&ocirc;ng tin t&agrave;i khoản hosting của bạn đ&atilde; được khởi tạo.<br />\n<br />\nTh&ocirc;ng tin dịch vụ<br />\n<br />\nDịch vụ: WH 1<br />\nT&ecirc;n miền: example.com<br />\nThanh to&aacute;n lần đầu: 79,000 đ<br />\nThanh to&aacute;n gia hạn: 79,000 đ<br …",
   "metadata": "[]",
   "type": "direct",
   "date_added": "2026-07-26 11:33:20",
   "date_seen": null,
   "url": false
  },
  {
   "id": 171464,
   "client_id": "<redacted>",
   "rel_type": "ticket",
   "rel_id": "445776",
   "seen": "0",
   "subject": "Nhân viên hỗ trợ đã phản hồi ticket",
   "body": "On 24 Jul 2026, at 20:18, B&igrave;nh Trần &lt;user@example.com&gt; wrote:  Nơi tiếp nhận những y&ecirc;u cầu hỗ trợ bản khai, x&aacute;c thực t&ecirc;n miền. Kh&aacute;ch h&agrave;ng c&oacute; thể li&ecirc;n hệ trực tiếp qua hotline 0364.333.333 nhấn ph&iacute;m 2 \n\nBest Regards!\n\n/----------------…",
   "metadata": "[]",
   "type": "direct",
   "date_added": "2026-07-24 20:25:23",
   "date_seen": null,
   "url": false
  },
  "… 12 more item(s)"
 ],
 "page": {
  "total": 14,
  "pages": 1,
  "current": 1
 }
}
```

</details>

**SDK**

```python
client.account.list_notifications()
```
```javascript
await client.account.listNotifications();
```
```php
$client->account->listNotifications();
```

---

### `account.listNewNotifications`

`GET /notifications/new` — Bearer token · verified live

**List new portal notifications**

Return only new portal notifications.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `rel_type` | query | string | no | Optional, return only by relation type |
| `rel_id` | query | string | no | Optional, return only by relation id |
| `page` | query | integer | no | Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current. Default: `0`. |
| `perpage` | query | integer | no | Rows per page. Defaults to the account's RecordsPerPage setting. |
| `orderby` | query | string | no | Sort expression in the form `field\|DESC` or `field\|ASC`, e.g. `date\|DESC`. |
| `filter` | query | object | no | Endpoint-specific filters, serialised as filter[key]=value. |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "notifications": [
  {
   "id": 920001,
   "rel_type": "account",
   "rel_id": "100001",
   "seen": "0",
   "subject": "Thông tin tài khoản Hosting tại TinoGroup.",
   "body": "Dear B&igrave;nh Trần Tran,<br />\n<br />\nTh&ocirc;ng tin t&agrave;i khoản hosting của bạn đ&atilde; được khởi tạo.<br />\n<br />\nTh&ocirc;ng tin dịch vụ<br />\n<br />\nDịch vụ: WH 1<br />\nT&ecirc;n miền: example.com<br />\nThanh to&aacute;n lần đầu: 79,000 đ<br />\nThanh to&aacute;n gia hạn: 79,000 đ<br …",
   "metadata": "[]",
   "date_added": "2026-07-26 11:33:20",
   "date_seen": null,
   "url": false
  },
  {
   "id": 171464,
   "rel_type": "ticket",
   "rel_id": "445776",
   "seen": "0",
   "subject": "Nhân viên hỗ trợ đã phản hồi ticket",
   "body": "On 24 Jul 2026, at 20:18, B&igrave;nh Trần &lt;user@example.com&gt; wrote:  Nơi tiếp nhận những y&ecirc;u cầu hỗ trợ bản khai, x&aacute;c thực t&ecirc;n miền. Kh&aacute;ch h&agrave;ng c&oacute; thể li&ecirc;n hệ trực tiếp qua hotline 0364.333.333 nhấn ph&iacute;m 2 \n\nBest Regards!\n\n/----------------…",
   "metadata": "[]",
   "date_added": "2026-07-24 20:25:23",
   "date_seen": null,
   "url": false
  },
  "… 12 more item(s)"
 ],
 "success": true
}
```

</details>

**SDK**

```python
client.account.list_new_notifications()
```
```javascript
await client.account.listNewNotifications();
```
```php
$client->account->listNewNotifications();
```

---

### `account.acknowledgeNotification`

`PUT /notifications/{id}/ack` — Bearer token · spec only

**Acknowledge notification**

Marks the notification as read

thêm params['seen_all']=true để mark real all notifications

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.account.acknowledge_notification(id)
```
```javascript
await client.account.acknowledgeNotification(id);
```
```php
$client->account->acknowledgeNotification($id);
```

---

### `account.status`

`GET /status` — Public · verified live

**status server api**

Return only new portal notifications.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "REMOTE_ADDR": "<redacted>",
 "HTTP_X_FORWARDED_FOR": "203.0.113.10"
}
```

</details>

**SDK**

```python
client.account.status()
```
```javascript
await client.account.status();
```
```php
$client->account->status();
```

---

### `account.submitContactForm`

`POST /submit_contactform` — Public · spec only

**submit contact form**

ok

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `cfmName` | string | no | Your acount email address |
| `cfmPhone` | string | no | Your acount email address |
| `cfmEmail` | string | no | Your acount email address |
| `cfmMessage` | string | no | Your acount email address |

```json
{
  "cfmName": "<cfmName>",
  "cfmPhone": "<cfmPhone>",
  "cfmEmail": "<cfmEmail>",
  "cfmMessage": "<cfmMessage>"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.account.submit_contact_form(cfm_name=...)
```
```javascript
await client.account.submitContactForm({ cfmName: ... });
```
```php
$client->account->submitContactForm(['cfmName' => ...]);
```

---
