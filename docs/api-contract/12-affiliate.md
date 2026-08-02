# Affiliate programme

SDK namespace: `client.affiliate` (Python) · `client.affiliate` (Node.js, PHP).

12 operation(s) in this chapter, 7 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `POST` | `/affiliate/active` | [`activate`](#affiliateactivate) | Bearer |
| `POST` | `/affiliate/addvoucher` | [`addVoucherLegacy`](#affiliateaddvoucherlegacy) | Bearer |
| `DELETE` | `/affiliate/removevoucher` | [`removeVoucherLegacy`](#affiliateremovevoucherlegacy) | Bearer |
| `POST` | `/affiliates/addvoucher` | [`addVoucher`](#affiliateaddvoucher) | Bearer |
| `GET` | `/affiliates/campaigns` | [`listCampaigns`](#affiliatelistcampaigns) | Bearer |
| `GET` | `/affiliates/commissionplans` | [`listCommissionPlans`](#affiliatelistcommissionplans) | Bearer |
| `GET` | `/affiliates/commissions` | [`listCommissions`](#affiliatelistcommissions) | Bearer |
| `GET` | `/affiliates/payouts` | [`listPayouts`](#affiliatelistpayouts) | Bearer |
| `GET` | `/affiliates/plans/{id}` | [`getCommissionPlan`](#affiliategetcommissionplan) | Bearer |
| `GET` | `/affiliates/summary` | [`getSummary`](#affiliategetsummary) | Bearer |
| `GET` | `/affiliates/vouchers` | [`listVouchers`](#affiliatelistvouchers) | Bearer |
| `DELETE` | `/affiliates/vouchers/{id}/remove` | [`removeVoucher`](#affiliateremovevoucher) | Bearer |

---

### `affiliate.activate`

`POST /affiliate/active` — Bearer token · spec only

**Active Affiliate**

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.affiliate.activate()
```
```javascript
await client.affiliate.activate();
```
```php
$client->affiliate->activate();
```

---

### `affiliate.addVoucherLegacy`

`POST /affiliate/addvoucher` — Bearer token · spec only

**Add Vouchers**

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `plan` | integer | no | Plan ID Requested</b> |
| `cycle` | string | no | Voucher cycle Requested</b> One of: `once`, `recurring` |
| `audience` | string | no | Voucher audience One of: `new`, `all`, `existing` |
| `max_usage_limit` | boolean | no | max_usage_limit |
| `max_usage` | string | no | max_usage |
| `expires` | string | no | Expires Date |
| `discount` | string | no | Discount value One of: `Min: 1`, `Max: Commission Rate` |

```json
{
  "plan": 0,
  "cycle": "once",
  "audience": "new",
  "max_usage_limit": true,
  "max_usage": "<max_usage>",
  "expires": "<expires>",
  "discount": "Min: 1"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.affiliate.add_voucher_legacy(plan=...)
```
```javascript
await client.affiliate.addVoucherLegacy({ plan: ... });
```
```php
$client->affiliate->addVoucherLegacy(['plan' => ...]);
```

---

### `affiliate.removeVoucherLegacy`

`DELETE /affiliate/removevoucher` — Bearer token · spec only

**Affiliate Delete Vouchers**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Plan ID, Empty if get list plans |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.affiliate.remove_voucher_legacy(id)
```
```javascript
await client.affiliate.removeVoucherLegacy(id);
```
```php
$client->affiliate->removeVoucherLegacy($id);
```

---

### `affiliate.addVoucher`

`POST /affiliates/addvoucher` — Bearer token · spec only

**Add Vouchers**

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `plan` | integer | no | Plan ID Requested</b> |
| `cycle` | string | no | Voucher cycle Requested</b> One of: `once`, `recurring` |
| `audience` | string | no | Voucher audience One of: `new`, `all`, `existing` |
| `max_usage_limit` | boolean | no | max_usage_limit |
| `max_usage` | string | no | max_usage |
| `expires` | string | no | Expires Date |
| `discount` | string | no | Discount value One of: `Min: 1`, `Max: Commission Rate` |

```json
{
  "plan": 0,
  "cycle": "once",
  "audience": "new",
  "max_usage_limit": true,
  "max_usage": "<max_usage>",
  "expires": "<expires>",
  "discount": "Min: 1"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.affiliate.add_voucher(plan=...)
```
```javascript
await client.affiliate.addVoucher({ plan: ... });
```
```php
$client->affiliate->addVoucher(['plan' => ...]);
```

---

### `affiliate.listCampaigns`

`GET /affiliates/campaigns` — Bearer token · verified live

**Get Affiliate campaigns**

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "campaigns": null
}
```

</details>

**SDK**

```python
client.affiliate.list_campaigns()
```
```javascript
await client.affiliate.listCampaigns();
```
```php
$client->affiliate->listCampaigns();
```

---

### `affiliate.listCommissionPlans`

`GET /affiliates/commissionplans` — Bearer token · verified live

**Get Affiliate commission plans**

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "commission_plans": null
}
```

</details>

**SDK**

```python
client.affiliate.list_commission_plans()
```
```javascript
await client.affiliate.listCommissionPlans();
```
```php
$client->affiliate->listCommissionPlans();
```

---

### `affiliate.listCommissions`

`GET /affiliates/commissions` — Bearer token · verified live

**Affiliate Commissions**

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
 "commissions": null
}
```

</details>

**SDK**

```python
client.affiliate.list_commissions()
```
```javascript
await client.affiliate.listCommissions();
```
```php
$client->affiliate->listCommissions();
```

---

### `affiliate.listPayouts`

`GET /affiliates/payouts` — Bearer token · verified live

**Affiliate Payouts**

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
 "payouts": null
}
```

</details>

**SDK**

```python
client.affiliate.list_payouts()
```
```javascript
await client.affiliate.listPayouts();
```
```php
$client->affiliate->listPayouts();
```

---

### `affiliate.getCommissionPlan`

`GET /affiliates/plans/{id}` — Bearer token · verified live

**View Commision Plan**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Plan ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "plan": null
}
```

</details>

**SDK**

```python
client.affiliate.get_commission_plan(id)
```
```javascript
await client.affiliate.getCommissionPlan(id);
```
```php
$client->affiliate->getCommissionPlan($id);
```

---

### `affiliate.getSummary`

`GET /affiliates/summary` — Bearer token · verified live

**Affiliate Info**

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "config": {
  "AffType": "Percent",
  "AffValue": 30,
  "AffBonus": 0
 },
 "nosidemenu": true
}
```

</details>

**SDK**

```python
client.affiliate.get_summary()
```
```javascript
await client.affiliate.getSummary();
```
```php
$client->affiliate->getSummary();
```

---

### `affiliate.listVouchers`

`GET /affiliates/vouchers` — Bearer token · verified live

**Affiliate Vouchers**

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
 "vouchers": null
}
```

</details>

**SDK**

```python
client.affiliate.list_vouchers()
```
```javascript
await client.affiliate.listVouchers();
```
```php
$client->affiliate->listVouchers();
```

---

### `affiliate.removeVoucher`

`DELETE /affiliates/vouchers/{id}/remove` — Bearer token · spec only

**Affiliate Delete Vouchers**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Plan ID, Empty if get list plans |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.affiliate.remove_voucher(id)
```
```javascript
await client.affiliate.removeVoucher(id);
```
```php
$client->affiliate->removeVoucher($id);
```

---
