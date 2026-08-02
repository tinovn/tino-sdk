# Domain names (part 1/3)

SDK namespace: `client.domains` (Python) · `client.domains` (Node.js, PHP).

11 operation(s) in this chapter, 10 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/domain` | [`listLegacy`](#domainslistlegacy) | Bearer |
| `POST` | `/domain/lookup` | [`lookup`](#domainslookup) | public |
| `GET` | `/domain/name/{name}` | [`getByName`](#domainsgetbyname) | Bearer |
| `POST` | `/domain/order` | [`order`](#domainsorder) | Bearer |
| `GET` | `/domain/order/{id}/form` | [`getTldForm`](#domainsgettldform) | Bearer |
| `POST` | `/domain/suggest` | [`suggest`](#domainssuggest) | public |
| `GET` | `/domain/{id}` | [`get`](#domainsget) | Bearer |
| `GET` | `/domain/{id}/autorenew` | [`getAutoRenew`](#domainsgetautorenew) | Bearer |
| `PUT` | `/domain/{id}/autorenew` | [`updateAutoRenew`](#domainsupdateautorenew) | Bearer |
| `GET` | `/domain/{id}/contact` | [`getContacts`](#domainsgetcontacts) | Bearer |
| `GET` | `/domain/{id}/dnssec` | [`listDnssecKeys`](#domainslistdnsseckeys) | Bearer |

---

### `domains.listLegacy`

`GET /domain` — Bearer token · verified live

**List Domains**

List domains under your account

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
 "success": true,
 "domains": [
  {
   "id": "200001",
   "name": "example.com",
   "expires": "2026-12-07",
   "label": "",
   "recurring_amount": "585366.00",
   "date_created": "2025-12-07",
   "status": "Active",
   "period": "1",
   "idprotection": "1",
   "autorenew": "1",
   "daytoexpire": "127"
  }
 ]
}
```

</details>

**SDK**

```python
client.domains.list_legacy()
```
```javascript
await client.domains.listLegacy();
```
```php
$client->domains->listLegacy();
```

---

### `domains.lookup`

`POST /domain/lookup` — Public · verified live

**Domain availability**

Check if domain is available for registration. Returns status: "ok" if domain is available, empty response otherwise

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `name` | string | no | Domain name, ie. example.com |

```json
{
  "name": "nameValue"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "domain": "tino-sdk-demo-2026.com",
 "name": "tino-sdk-demo-2026.com",
 "sld": "tino-sdk-demo-2026",
 "tld": ".com",
 "description": "",
 "premium": false,
 "avaliable": true,
 "transfer": false,
 "status": "ok",
 "type": "register",
 "category_id": "58",
 "tld_id": "346",
 "periods": [
  {
   "id": "346",
   "period": "1",
   "register": "319000.00",
   "transfer": "399000.00",
   "renew": "399000.00",
   "redemption": "3990000.00",
   "before": "399000.00",
   "vatFee": 29000,
   "feeRegOrigin": 290000
  },
  {
   "id": "346",
   "period": "2",
   "register": "638000.00",
   "transfer": "798000.00",
   "renew": "798000.00",
   "redemption": "7980000.00",
   "before": "-1.00",
   "vatFee": 58000,
   "feeRegOrigin": 580000
  },
  "… 8 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.domains.lookup(name=...)
```
```javascript
await client.domains.lookup({ name: ... });
```
```php
$client->domains->lookup(['name' => ...]);
```

---

### `domains.getByName`

`GET /domain/name/{name}` — Bearer token · verified live

**Domain details by name**

Get domain details by name

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `name` | path | string | yes | Domain name |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "domains": [
  {
   "id": "200001",
   "name": "example.com",
   "date_created": "2025-12-07",
   "firstpayment": "50000.00",
   "recurring_amount": "585366.00",
   "period": "1",
   "expires": "2026-12-07",
   "status": "Active",
   "next_due": "2026-12-07",
   "next_invoice": "2026-11-22",
   "idprotection": "1",
   "nameservers": [
    "ns1.tino.vn",
    "ns2.tino.vn"
   ],
   "autorenew": "1"
  }
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
client.domains.get_by_name(name)
```
```javascript
await client.domains.getByName(name);
```
```php
$client->domains->getByName($name);
```

---

### `domains.order`

`POST /domain/order` — Bearer token · spec only · **deprecated**

**Order new domain**

Create new order for a domain, please check if requested domain is available first,
otherwise your order may get cancelled.

> **Note.** Domains are ordered through cart.order together with any other item. This route remains for the standalone domain flow.

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `name` | string | no | Domain name |
| `years` | string | no | Number of years |
| `action` | string | no | register\|transfer |
| `tld_id` | string | no | TLD id |
| `pay_method` | integer | no | Payment method ID |
| `epp` | string | no | EPP Transfer code, required when transfering some domains |
| `nameservers` | array | no | Optional array with 2 - 4 nameservers that you want to use |
| `registrant` | integer | no | Optional contact ID to use for registrant contact this domain |
| `admin` | integer | no | Optional contact ID to use for admin contact this domain |
| `tech` | integer | no | Optional contact ID to use for tech contact this domain |
| `billing` | integer | no | Optional contact ID to use for billing contact this domain |
| `data` | array | no | Addditional data required for some TLDs |
| `aff_id` | integer | no | Affiliate ID |

```json
{
  "name": "example.com",
  "years": "yearsValue",
  "action": "actionValue",
  "tld_id": "tld_idValue",
  "pay_method": "pay_methodValue",
  "epp": "eppValue",
  "nameservers": "nameserversValue",
  "registrant": "registrantValue",
  "admin": "adminValue",
  "tech": "techValue",
  "billing": "billingValue",
  "data": "dataValue",
  "aff_id": 55
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.domains.order(name=...)
```
```javascript
await client.domains.order({ name: ... });
```
```php
$client->domains->order(['name' => ...]);
```

---

### `domains.getTldForm`

`GET /domain/order/{id}/form` — Bearer token · verified live

**Additinal data for TLD**

Get additional forms required for some TLDs

> **Note.** {id} is the TLD product id returned by cart.listDomainTlds (e.g. 1298 for .io.vn), not the id of a registered domain.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `tld_id` | query | integer | no | TLD ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "forms": []
}
```

</details>

**SDK**

```python
client.domains.get_tld_form(id)
```
```javascript
await client.domains.getTldForm(id);
```
```php
$client->domains->getTldForm($id);
```

---

### `domains.suggest`

`POST /domain/suggest` — Public · verified live

**Domain suggest**

Check if domain is available for registration. Returns status: "ok" if domain is available, empty response otherwise

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `name` | string | no | Domain name, ie. example.com |

```json
{
  "name": "nameValue"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "suggestions": [
  {
   "domain": "tinosdk.vn",
   "avaliable": true,
   "price": 450000,
   "reason": "Tên thương hiệu gốc, dễ nhận diện"
  },
  {
   "domain": "tinosdk.com",
   "avaliable": true,
   "price": 319000,
   "reason": "Phổ biến toàn cầu, chuyên nghiệp"
  },
  "… 8 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.domains.suggest(name=...)
```
```javascript
await client.domains.suggest({ name: ... });
```
```php
$client->domains->suggest(['name' => ...]);
```

---

### `domains.get`

`GET /domain/{id}` — Bearer token · verified live

**Domain details**

Get domain details

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "details": {
  "id": "200001",
  "name": "example.com",
  "reg_module": "172",
  "date_created": "2025-12-07",
  "firstpayment": "50000.00",
  "recurring_amount": "585366.00",
  "period": "1",
  "expires": "2026-12-07",
  "status": "Active",
  "next_due": "2026-12-07",
  "next_invoice": "2026-11-22",
  "idprotection": "1",
  "nameservers": [
   "ns1.tino.vn",
   "ns2.tino.vn"
  ],
  "autorenew": "1",
  "reglock": "0",
  "daytoexpire": "127",
  "contacts": {
   "registrant": {
    "registrant": "1",
    "type": "ind",
    "name": "Tran Thanh Binh",
    "nationalid": "000000000000",
    "phonenumber": "+84.900000000",
    "email": "user@example.com",
    "gender": "Male",
    "birthday": "01/01/1990",
    "country": "VN",
    "state": "Thành phố Hồ Chí Minh",
    "city": "Phuong Tan Dinh",
    "ward": null,
    "address1": "123 Example Street",
    "address2": "<redacted>",
    "postcode": "760000"
   },
   "admin": {
    "registrant": "0",
    "type": "ind",
    "name": "Tran Thanh Binh",
    "nationalid": "000000000000",
  … 83 more line(s)
```

</details>

**SDK**

```python
client.domains.get(id)
```
```javascript
await client.domains.get(id);
```
```php
$client->domains->get($id);
```

---

### `domains.getAutoRenew`

`GET /domain/{id}/autorenew` — Bearer token · verified live

**Get domain autorenew**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "allowrenew": null,
 "autorenew": "1"
}
```

</details>

**SDK**

```python
client.domains.get_auto_renew(id)
```
```javascript
await client.domains.getAutoRenew(id);
```
```php
$client->domains->getAutoRenew($id);
```

---

### `domains.updateAutoRenew`

`PUT /domain/{id}/autorenew` — Bearer token · verified live

**Enable/disable domain autorenew**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain id |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `autorenew` | boolean | yes | true\|false |

```json
{
  "autorenew": true
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "info": [
  "success_changes_save"
 ]
}
```

</details>

**SDK**

```python
client.domains.update_auto_renew(id, autorenew=...)
```
```javascript
await client.domains.updateAutoRenew(id, { autorenew: ... });
```
```php
$client->domains->updateAutoRenew($id, ['autorenew' => ...]);
```

---

### `domains.getContacts`

`GET /domain/{id}/contact` — Bearer token · verified live

**Get domain contact info**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "domain_id": "200001",
 "contact_info": {
  "registrant": {
   "phonenumber": "+84.900000000",
   "email": "user@example.com",
   "country": "VN",
   "state": "Thành phố Hồ Chí Minh",
   "city": "Phuong Tan Dinh",
   "address1": "123 Example Street",
   "address2": "<redacted>",
   "postcode": "760000"
  },
  "admin": {
   "phonenumber": "+84.900000000",
   "email": "user@example.com",
   "country": "VN",
   "state": "Thành phố Hồ Chí Minh",
   "city": "Phuong Tan Dinh",
   "address1": "123 Example Street",
   "address2": "<redacted>",
   "postcode": "760000"
  },
  "billing": {
   "phonenumber": "+84.900000000",
   "email": "user@example.com",
   "country": "VN",
   "state": "Thành phố Hồ Chí Minh",
   "city": "Phuong Tan Dinh",
   "address1": "123 Example Street",
   "address2": "<redacted>",
   "postcode": "760000"
  },
  "tech": {
   "phonenumber": "+84.900000000",
   "email": "user@example.com",
   "country": "VN",
   "state": "Thành phố Hồ Chí Minh",
   "city": "Phuong Tan Dinh",
   "address1": "123 Example Street",
   "address2": "<redacted>",
   "postcode": "760000"
  }
 }
  … 1 more line(s)
```

</details>

**SDK**

```python
client.domains.get_contacts(id)
```
```javascript
await client.domains.getContacts(id);
```
```php
$client->domains->getContacts($id);
```

---

### `domains.listDnssecKeys`

`GET /domain/{id}/dnssec` — Bearer token · verified live

**Returns the list of DNSSEC keys**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "ds_list": null,
 "key_list": null
}
```

</details>

**SDK**

```python
client.domains.list_dnssec_keys(id)
```
```javascript
await client.domains.listDnssecKeys(id);
```
```php
$client->domains->listDnssecKeys($id);
```

---
