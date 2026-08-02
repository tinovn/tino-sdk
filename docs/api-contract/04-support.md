# Support tickets, news & knowledgebase

SDK namespace: `client.support` (Python) · `client.support` (Node.js, PHP).

13 operation(s) in this chapter, 8 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/knowledgebase` | [`listKbCategories`](#supportlistkbcategories) | Bearer |
| `GET` | `/knowledgebase/article/{article_id}` | [`getKbArticle`](#supportgetkbarticle) | Bearer |
| `GET` | `/knowledgebase/{category_id}` | [`getKbCategory`](#supportgetkbcategory) | Bearer |
| `GET` | `/news` | [`listNews`](#supportlistnews) | Bearer |
| `GET` | `/news/{news_id}` | [`getNews`](#supportgetnews) | Bearer |
| `GET` | `/ticket/attachment/{file}` | [`getAttachment`](#supportgetattachment) | Bearer |
| `GET` | `/ticket/departments` | [`listDepartments`](#supportlistdepartments) | Bearer |
| `GET` | `/tickets` | [`listTickets`](#supportlisttickets) | Bearer |
| `POST` | `/tickets` | [`createTicket`](#supportcreateticket) | Bearer |
| `GET` | `/tickets/{number}` | [`getTicket`](#supportgetticket) | Bearer |
| `POST` | `/tickets/{number}` | [`replyTicket`](#supportreplyticket) | Bearer |
| `PUT` | `/tickets/{number}/close` | [`closeTicket`](#supportcloseticket) | Bearer |
| `PUT` | `/tickets/{number}/open` | [`reopenTicket`](#supportreopenticket) | Bearer |

---

### `support.listKbCategories`

`GET /knowledgebase` — Bearer token · verified live

**List all knowledgebase categories**

Returns list all knowledgebase categories

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "categories": []
}
```

</details>

**SDK**

```python
client.support.list_kb_categories()
```
```javascript
await client.support.listKbCategories();
```
```php
$client->support->listKbCategories();
```

---

### `support.getKbArticle`

`GET /knowledgebase/article/{article_id}` — Bearer token · verified live

**Get knowledgebase article**

Returns an article details

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `article_id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "article": null
}
```

</details>

**SDK**

```python
client.support.get_kb_article(article_id)
```
```javascript
await client.support.getKbArticle(articleId);
```
```php
$client->support->getKbArticle($articleId);
```

---

### `support.getKbCategory`

`GET /knowledgebase/{category_id}` — Bearer token · verified live

**Get knowledgebase category details**

Returns subcategories and articles of the knowledgebase category

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `category_id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "subcategories": null,
 "articles": null
}
```

</details>

**SDK**

```python
client.support.get_kb_category(category_id)
```
```javascript
await client.support.getKbCategory(categoryId);
```
```php
$client->support->getKbCategory($categoryId);
```

---

### `support.listNews`

`GET /news` — Bearer token · verified live

**List News**

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
 "news": []
}
```

</details>

**SDK**

```python
client.support.list_news()
```
```javascript
await client.support.listNews();
```
```php
$client->support->listNews();
```

---

### `support.getNews`

`GET /news/{news_id}` — Bearer token · spec only

**Get news item**

Returns details of the news item

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `news_id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "annoucement": null
}
```

</details>

**SDK**

```python
client.support.get_news(news_id)
```
```javascript
await client.support.getNews(newsId);
```
```php
$client->support->getNews($newsId);
```

---

### `support.getAttachment`

`GET /ticket/attachment/{file}` — Bearer token · verified live

**Ticket attachment**

Get ticket attachment

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `file` | path | string | yes | Attachment id |

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `number` | query | integer | no | Ticket number |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[
 "file_not_found"
]
```

</details>

**SDK**

```python
client.support.get_attachment(file)
```
```javascript
await client.support.getAttachment(file);
```
```php
$client->support->getAttachment($file);
```

---

### `support.listDepartments`

`GET /ticket/departments` — Bearer token · verified live

**List ticket departments**

Get the list of ticket departments

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "departments": [
  {
   "id": "2",
   "name": "Phòng hỗ trợ kỹ thuật",
   "description": "Nơi tiếp nhận những yêu cầu hỗ trợ kỹ thuật. Khách hàng có thể liên hệ trực tiếp qua hotline 0364.333.333 nhấn phím 2 hoặc email user@example.com trong trường hợp khẩn cấp.",
   "allow_priority": true
  },
  {
   "id": "3",
   "name": "Phòng Kinh Doanh",
   "description": "Nơi tiếp nhận và giải quyết những vấn đề liên quan đến báo giá, hợp đồng và dịch vụ. Khách hàng có thể liên hệ trực tiếp hotline 0364.333.333 nhấn phím 1 hoặc email user@example.com trong trường hợp khẩn cấp.",
   "allow_priority": false
  },
  "… 5 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.support.list_departments()
```
```javascript
await client.support.listDepartments();
```
```php
$client->support->listDepartments();
```

---

### `support.listTickets`

`GET /tickets` — Bearer token · verified live

**List Tickets**

List support tickets under my account

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
 "tickets": [
  {
   "client_read": "1",
   "ticket_number": "400001",
   "date": "2026-07-24 20:20:01",
   "deptname": "Phòng hỗ trợ kỹ thuật",
   "subject": "test suport.org",
   "status": "Closed",
   "lastreply": "2026-07-24 20:20:01"
  },
  {
   "client_read": "1",
   "ticket_number": "400002",
   "date": "2026-07-24 20:15:07",
   "deptname": "Phòng quản lý tên miền",
   "subject": "test email",
   "status": "Answered",
   "lastreply": "2026-07-24 20:15:07"
  },
  "… 5 more item(s)"
 ],
 "page": {
  "current": 0,
  "total": 1
 }
}
```

</details>

**SDK**

```python
client.support.list_tickets()
```
```javascript
await client.support.listTickets();
```
```php
$client->support->listTickets();
```

---

### `support.createTicket`

`POST /tickets` — Bearer token · spec only

**Create Ticket**

Submit new ticket

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `dept_id` | integer | no | Department id |
| `subject` | string | no | Ticket subject |
| `body` | string | no | Ticket message |

```json
{
  "dept_id": 1,
  "subject": "Subject",
  "body": "Message ..."
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.support.create_ticket(dept_id=...)
```
```javascript
await client.support.createTicket({ dept_id: ... });
```
```php
$client->support->createTicket(['dept_id' => ...]);
```

---

### `support.getTicket`

`GET /tickets/{number}` — Bearer token · verified live

**Ticket details**

Get ticket details, including all replies

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `number` | path | integer | yes | Ticket number |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "ticket": {
  "date": "2026-07-24 20:20:01",
  "ticket_number": "400001",
  "name": "Nguyen Van A",
  "email": "user@example.com",
  "subject": "test suport.org",
  "body": "Nơi tiếp nhận những yêu cầu hỗ trợ bản khai, xác thực tên miền. Khách hàng có thể liên hệ trực tiếp qua hotline 0364.333.333 nhấn phím 2",
  "status": "Closed",
  "client_read": "1",
  "type": "Email",
  "deptname": "Phòng hỗ trợ kỹ thuật",
  "attachments": []
 },
 "replies": []
}
```

</details>

**SDK**

```python
client.support.get_ticket(number)
```
```javascript
await client.support.getTicket(number);
```
```php
$client->support->getTicket($number);
```

---

### `support.replyTicket`

`POST /tickets/{number}` — Bearer token · spec only

**Create Reply**

Reply to ticket

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `number` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `number` | integer | no | Ticket number |
| `body` | string | no | Reply message |

```json
{
  "number": "numberValue",
  "body": "reply text .."
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.support.reply_ticket(number, number=...)
```
```javascript
await client.support.replyTicket(number, { number: ... });
```
```php
$client->support->replyTicket($number, ['number' => ...]);
```

---

### `support.closeTicket`

`PUT /tickets/{number}/close` — Bearer token · spec only

**Close ticket**

Send request to close a ticket

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `number` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `number` | integer | no | Ticket number |

```json
{
  "number": "numberValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.support.close_ticket(number, number=...)
```
```javascript
await client.support.closeTicket(number, { number: ... });
```
```php
$client->support->closeTicket($number, ['number' => ...]);
```

---

### `support.reopenTicket`

`PUT /tickets/{number}/open` — Bearer token · spec only

**Re-open ticket**

Try to re-open closed ticket

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `number` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `number` | integer | no | Ticket number |

```json
{
  "number": "numberValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.support.reopen_ticket(number, number=...)
```
```javascript
await client.support.reopenTicket(number, { number: ... });
```
```php
$client->support->reopenTicket($number, ['number' => ...]);
```

---
