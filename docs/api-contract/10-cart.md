# Catalogue, cart & orders

SDK namespace: `client.cart` (Python) · `client.cart` (Node.js, PHP).

10 operation(s) in this chapter, 8 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/cart/coupon` | [`listCoupons`](#cartlistcoupons) | public |
| `GET` | `/cart/domain/tlds` | [`listDomainTlds`](#cartlistdomaintlds) | public |
| `GET` | `/categories` | [`listCategoryTree`](#cartlistcategorytree) | public |
| `GET` | `/category` | [`listCategories`](#cartlistcategories) | Bearer |
| `GET` | `/category/{category_id}/product` | [`listProducts`](#cartlistproducts) | Bearer |
| `POST` | `/order` | [`order`](#cartorder) | Bearer |
| `GET` | `/order/{product_id}` | [`getProduct`](#cartgetproduct) | Bearer |
| `POST` | `/order/{product_id}` | [`orderProduct`](#cartorderproduct) | Bearer |
| `POST` | `/quote` | [`quote`](#cartquote) | Bearer |
| `GET` | `/v2/cart/domain/tlds` | [`listDomainTldsV2`](#cartlistdomaintldsv2) | public |

---

### `cart.listCoupons`

`GET /cart/coupon` — Public · verified live

**List coupon**

Danh sách mã giảm giá đang có

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "coupons": []
}
```

</details>

**SDK**

```python
client.cart.list_coupons()
```
```javascript
await client.cart.listCoupons();
```
```php
$client->cart->listCoupons();
```

---

### `cart.listDomainTlds`

`GET /cart/domain/tlds` — Public · verified live

**Available TLDs**

List TLDs available for registration and transfer

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "currency": "VND",
 "tlds": [
  {
   "id": "1298",
   "tld": ".io.vn",
   "description": "",
   "period": "1",
   "periods": [
    {
     "period": "1",
     "register": "50000.00",
     "transfer": "0.00",
     "renew": "50000.00",
     "redemption": "-1.00",
     "before": "-1.00",
     "feeRegOrigin": 10000,
     "feeRenOrigin": 20000,
     "feeManOrigin": 18182,
     "vatFee": 1818
    },
    {
     "period": "2",
     "register": "100000.00",
     "transfer": "-1.00",
     "renew": "100000.00",
     "redemption": "-1.00",
     "before": "-1.00",
     "feeRegOrigin": 10000,
     "feeRenOrigin": 40000,
     "feeManOrigin": 45455,
     "vatFee": 4546
    },
    "… 8 more item(s)"
   ],
   "domain_type": "vn"
  },
  {
   "id": "567",
   "tld": ".vn",
   "description": "<p>Tên miền quốc gia VN</p>",
   "period": "1",
   "periods": [
    {
     "period": "1",
  … 29 more line(s)
```

</details>

**SDK**

```python
client.cart.list_domain_tlds()
```
```javascript
await client.cart.listDomainTlds();
```
```php
$client->cart->listDomainTlds();
```

---

### `cart.listCategoryTree`

`GET /categories` — Public · verified live

**List product categories**

Return a list of product categories.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "categories": [
  {
   "id": "84",
   "name": "Cloud Instance",
   "description": "",
   "visible": "1",
   "ptype": "0",
   "slug": "cloud-instance",
   "subcategories": {
    "93": {
     "id": "93",
     "name": "Hermes Agent",
     "description": "",
     "visible": "1",
     "ptype": "3",
     "slug": "hermes-agent"
    },
    "70": {
     "id": "70",
     "name": "NVMe VPS ",
     "description": "",
     "visible": "1",
     "ptype": "3",
     "slug": "nvme-vps"
    },
    "89": {
     "id": "89",
     "name": "N8N - AI Workflow",
     "description": "",
     "visible": "1",
     "ptype": "3",
     "slug": "n8n-ai-workflow"
    },
    "79": {
     "id": "79",
     "name": "Pro AMD VPS",
     "description": "",
     "visible": "1",
     "ptype": "3",
     "slug": "pro-amd-vps"
    },
    "91": {
     "id": "91",
     "name": "OpenClaw — Personal AI Assistant",
  … 68 more line(s)
```

</details>

**SDK**

```python
client.cart.list_category_tree()
```
```javascript
await client.cart.listCategoryTree();
```
```php
$client->cart->listCategoryTree();
```

---

### `cart.listCategories`

`GET /category` — Bearer token · verified live

**List product categories**

Return a list of product categories.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "categories": [
  {
   "id": 58,
   "name": "Tên miền",
   "description": "",
   "slug": "ten-mien"
  },
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
  "… 8 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.cart.list_categories()
```
```javascript
await client.cart.listCategories();
```
```php
$client->cart->listCategories();
```

---

### `cart.listProducts`

`GET /category/{category_id}/product` — Bearer token · verified live

**List products in category**

Return a list of product available for purchase under requested category

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `category_id` | path | integer | yes | Category ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "products": null,
 "error": [
  "category_not_found"
 ]
}
```

</details>

**SDK**

```python
client.cart.list_products(category_id)
```
```javascript
await client.cart.listProducts(categoryId);
```
```php
$client->cart->listProducts($categoryId);
```

---

### `cart.order`

`POST /order` — Bearer token · spec only

**Order multiple services**

Create and submit new order for multiple services

Each item in the `items` array needs to include order `type` and parameters used
by one of the method listed below:

• `POST /certificate/order` - use `certificate` for item type

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `pay_method` | integer | no | Payment method ID |
| `ignore_errors` | boolean | no | Process order even if some of the items were rejected due to errors |
| `items` | array | no | list with order items |
| `aff_id` | integer | no | Affiliate ID |

```json
{
  "pay_method": 1,
  "ignore_errors": "No error",
  "items": [
    {
      "type": "certificate",
      "product_id": 840,
      "csr": "-----BEGIN CERTIFICATE REQUEST----- (...)",
      "years": 1,
      "approver_email": "admin@hosting.com"
    }
  ],
  "aff_id": 55
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.cart.order(pay_method=...)
```
```javascript
await client.cart.order({ pay_method: ... });
```
```php
$client->cart->order(['pay_method' => ...]);
```

---

### `cart.getProduct`

`GET /order/{product_id}` — Bearer token · verified live

**Get product configuration details**

Return product details with form configuration, addons and subproducts if available.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `product_id` | path | integer | yes | Product ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "product": {
  "id": 26,
  "category_name": "Comodo SSL",
  "_category_name": "Comodo SSL",
  "category_id": 9,
  "name": "Comodo PositiveSSL",
  "_name": "Comodo PositiveSSL",
  "template": "onestep_cloud_2019",
  "slug": "comodo-ssl",
  "domain": "",
  "prorata_date": false,
  "price": 0,
  "recurring": "free",
  "setup": 0,
  "billingtype": "PrePay",
  "paytype": "Free",
  "price_today": 0,
  "customdata": [],
  "tax": "1",
  "tax_group_id": "3",
  "config": {
   "product": [
    {
     "type": "select",
     "title": "pickcycle",
     "id": "cycle",
     "name": "cycle",
     "items": [
      {
       "title": "1 năm",
       "formatted": null,
       "value": "a",
       "price": "175000.00",
       "setup": 0,
       "selected": true
      },
      {
       "title": "2 năm",
       "formatted": null,
       "value": "b",
       "price": "297600.00",
       "setup": 0,
       "selected": false
      },
  … 44 more line(s)
```

</details>

**SDK**

```python
client.cart.get_product(product_id)
```
```javascript
await client.cart.getProduct(productId);
```
```php
$client->cart->getProduct($productId);
```

---

### `cart.orderProduct`

`POST /order/{product_id}` — Bearer token · spec only

**Order new service**

Create and submit new order for selected product.

To get available cycle and configuration options lookup product details
using `GET /order/@product_id`

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `product_id` | path | integer | yes | Product ID |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `domain` | string | no | Domain name, ie. example.com, may be optional |
| `cycle` | string | no | Billing period symbol |
| `pay_method` | integer | no | Payment method ID |
| `custom` | array | no | Additional options data available for sop products |
| `promocode` | string | no | Promotion code |
| `aff_id` | integer | no | Affiliate ID |

```json
{
  "domain": "domainValue",
  "cycle": "cycleValue",
  "pay_method": "pay_methodValue",
  "custom": "customValue",
  "promocode": "promocodeValue",
  "aff_id": 55
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.cart.order_product(product_id, domain=...)
```
```javascript
await client.cart.orderProduct(productId, { domain: ... });
```
```php
$client->cart->orderProduct($productId, ['domain' => ...]);
```

---

### `cart.quote`

`POST /quote` — Bearer token · verified live

**Get order quote**

Calculate order cost and recurring prices for selected items.
Use the same parameters as for `POST /order`

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `pay_method` | integer | no | Payment method ID |
| `output` | string | no | Type of output, default is short. Possible options    short</code> - Basic details about the item in cart</li>  config</code>- Basic details and form components</li>  full</code> - All details available in cart</li> </ul> |
| `items` | array | no | list with order items |

```json
{
  "pay_method": "pay_methodValue",
  "output": "short",
  "items": [
    {
      "type": "certificate",
      "product_id": 840,
      "csr": "-----BEGIN CERTIFICATE REQUEST----- (...)",
      "years": 1,
      "approver_email": "admin@hosting.com"
    }
  ]
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "summary": {
  "subtotal": 79000,
  "total": 85320,
  "setup_fee": 0,
  "credit": 0,
  "discount": 0,
  "cost": 79000,
  "recurring": [
   {
    "title": "1 tháng",
    "price": 85320,
    "value": "m"
   }
  ],
  "recurring_discount": [],
  "tax": [
   {
    "name": "VAT",
    "tax": 6320,
    "value": 8
   }
  ]
 },
 "items": []
}
```

</details>

**SDK**

```python
client.cart.quote(pay_method=...)
```
```javascript
await client.cart.quote({ pay_method: ... });
```
```php
$client->cart->quote(['pay_method' => ...]);
```

---

### `cart.listDomainTldsV2`

`GET /v2/cart/domain/tlds` — Public · verified live

**V2: Available TLDs**

List TLDs available for registration and transfer

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "currency": "VND",
 "total": 52,
 "tlds": [
  {
   "id": "1298",
   "tld": ".io.vn",
   "description": "",
   "period": "1",
   "periods": [
    {
     "period": 1,
     "register": 18182,
     "transfer": 0,
     "renew": 27273,
     "redemption": -1,
     "before": -1,
     "feeRegOrigin": 10000,
     "feeRenOrigin": 20000,
     "vatValue": 0
    },
    {
     "period": 2,
     "register": 45455,
     "transfer": 0,
     "renew": 54545,
     "redemption": -1,
     "before": -1,
     "feeRegOrigin": 10000,
     "feeRenOrigin": 40000,
     "vatValue": 0
    },
    "… 8 more item(s)"
   ],
   "category_id": "58",
   "tax_group_id": "1",
   "ptype": "DomainsType",
   "tags": {
    "15": "vn"
   }
  },
  {
   "id": "567",
   "tld": ".vn",
   "description": "<p>Tên miền quốc gia VN</p>",
  … 38 more line(s)
```

</details>

**SDK**

```python
client.cart.list_domain_tlds_v2()
```
```javascript
await client.cart.listDomainTldsV2();
```
```php
$client->cart->listDomainTldsV2();
```

---
