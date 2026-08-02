# SSL certificates

SDK namespace: `client.certificates` (Python) · `client.certificates` (Node.js, PHP).

6 operation(s) in this chapter, 5 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/certificate/order` | [`listProducts`](#certificateslistproducts) | Bearer |
| `POST` | `/certificate/order` | [`order`](#certificatesorder) | Bearer |
| `GET` | `/certificate/order/{product_id}/software` | [`listServerSoftware`](#certificateslistserversoftware) | Bearer |
| `GET` | `/certificate/{id}` | [`get`](#certificatesget) | Bearer |
| `GET` | `/certificate/{service_id}/crt` | [`download`](#certificatesdownload) | Bearer |
| `GET` | `/certificates` | [`list`](#certificateslist) | Bearer |

---

### `certificates.listProducts`

`GET /certificate/order` — Bearer token · verified live

**List available certificates**

Return a list with certificate available for purchase

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "products": [
  {
   "id": "26",
   "name": "Comodo PositiveSSL",
   "description": "<ul></ul>",
   "category": "Comodo SSL",
   "category_url": "comodo-ssl",
   "periods": [
    {
     "years": 1,
     "price": 175000,
     "renew": 175000
    },
    {
     "years": 2,
     "price": 297600,
     "renew": 297600
    },
    "… 1 more item(s)"
   ]
  },
  {
   "id": "27",
   "name": "Comodo PositiveSSL Wildcard",
   "description": "<ul></ul>",
   "category": "Comodo SSL",
   "category_url": "comodo-ssl",
   "periods": [
    {
     "years": 1,
     "price": 2139000,
     "renew": 2139000
    },
    {
     "years": 2,
     "price": 4278000,
     "renew": 4278000
    },
    "… 1 more item(s)"
   ]
  },
  "… 12 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.certificates.list_products()
```
```javascript
await client.certificates.listProducts();
```
```php
$client->certificates->listProducts();
```

---

### `certificates.order`

`POST /certificate/order` — Bearer token · spec only · **deprecated**

**Order new certificates**

Create new order for a certificate

> **Note.** Certificates are ordered through cart.order together with any other item. This route remains for the standalone certificate flow.

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `product_id` | integer | no | Certificate product ID |
| `csr` | string | no | Domain name |
| `years` | integer | no | Number of years |
| `pay_method` | integer | no | Payment method ID |
| `approver_email` | string | no | Email addres used in domain validation |
| `admin` | integer | no | Admin contact ID |
| `tech` | integer | no | Tech contact ID |
| `billing` | integer | no | Billing contact ID |
| `organization` | array | no | Organization details |
| `software` | integer | no | Server/Software ID |
| `data` | array | no | Addditional data required for some products |
| `aff_id` | integer | no | Affiliate ID |

```json
{
  "product_id": "product_idValue",
  "csr": "example.com",
  "years": "yearsValue",
  "pay_method": "pay_methodValue",
  "approver_email": "approver_emailValue",
  "admin": "adminValue",
  "tech": "techValue",
  "billing": "billingValue",
  "organization": "organizationValue",
  "software": "softwareValue",
  "data": "dataValue",
  "aff_id": 55
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.certificates.order(product_id=...)
```
```javascript
await client.certificates.order({ product_id: ... });
```
```php
$client->certificates->order(['product_id' => ...]);
```

---

### `certificates.listServerSoftware`

`GET /certificate/order/{product_id}/software` — Bearer token · verified live

**List server software for certificates**

Return a list with software IDs required or certificate

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `product_id` | path | integer | yes | Certificate product ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "software": [
  {
   "id": 1,
   "name": "Apache + MOD SSL"
  },
  {
   "id": 2,
   "name": "Apache + Raven"
  },
  "… 26 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.certificates.list_server_software(product_id)
```
```javascript
await client.certificates.listServerSoftware(productId);
```
```php
$client->certificates->listServerSoftware($productId);
```

---

### `certificates.get`

`GET /certificate/{id}` — Bearer token · verified live

**Certificate details**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "products": [
  {
   "id": "26",
   "name": "Comodo PositiveSSL",
   "description": "<ul></ul>",
   "category": "Comodo SSL",
   "category_url": "comodo-ssl",
   "periods": [
    {
     "years": 1,
     "price": 175000,
     "renew": 175000
    },
    {
     "years": 2,
     "price": 297600,
     "renew": 297600
    },
    "… 1 more item(s)"
   ]
  },
  {
   "id": "27",
   "name": "Comodo PositiveSSL Wildcard",
   "description": "<ul></ul>",
   "category": "Comodo SSL",
   "category_url": "comodo-ssl",
   "periods": [
    {
     "years": 1,
     "price": 2139000,
     "renew": 2139000
    },
    {
     "years": 2,
     "price": 4278000,
     "renew": 4278000
    },
    "… 1 more item(s)"
   ]
  },
  "… 12 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.certificates.get(id)
```
```javascript
await client.certificates.get(id);
```
```php
$client->certificates->get($id);
```

---

### `certificates.download`

`GET /certificate/{service_id}/crt` — Bearer token · verified live

**Download certificate**

Return X.509 certificate data

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `service_id` | path | integer | yes | Service id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[]
```

</details>

**SDK**

```python
client.certificates.download(service_id)
```
```javascript
await client.certificates.download(serviceId);
```
```php
$client->certificates->download($serviceId);
```

---

### `certificates.list`

`GET /certificates` — Bearer token · verified live

**List SSL Certificates**

List all ssl services under your account

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
 "sslservices": []
}
```

</details>

**SDK**

```python
client.certificates.list()
```
```javascript
await client.certificates.list();
```
```php
$client->certificates->list();
```

---
