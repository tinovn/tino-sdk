# Billing, invoices & payments (part 1/2)

SDK namespace: `client.billing` (Python) · `client.billing` (Node.js, PHP).

16 operation(s) in this chapter, 9 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/addfunds` | [`getAddFundsInfo`](#billinggetaddfundsinfo) | Bearer |
| `POST` | `/addfunds` | [`addFundsLegacy`](#billingaddfundslegacy) | Bearer |
| `GET` | `/balance` | [`getBalance`](#billinggetbalance) | Bearer |
| `POST` | `/billing/addfunds` | [`addFunds`](#billingaddfunds) | Bearer |
| `GET` | `/billing/creditlogs` | [`getCreditLogs`](#billinggetcreditlogs) | Bearer |
| `POST` | `/billing/creditvoucher` | [`redeemCreditVoucher`](#billingredeemcreditvoucher) | Bearer |
| `GET` | `/billing/{invoice_id}/pay/{gateway_id}` | [`getPaymentLink`](#billinggetpaymentlink) | Bearer |
| `GET` | `/currencies` | [`getCurrencies`](#billinggetcurrencies) | public |
| `GET` | `/estimate/{id}/pdf` | [`getEstimatePdf`](#billinggetestimatepdf) | Bearer |
| `GET` | `/estimates` | [`listEstimates`](#billinglistestimates) | Bearer |
| `GET` | `/estimates/{id}` | [`getEstimate`](#billinggetestimate) | Bearer |
| `GET` | `/invoice` | [`listInvoicesLegacy`](#billinglistinvoiceslegacy) | Bearer |
| `DELETE` | `/invoice/{id}` | [`deleteInvoice`](#billingdeleteinvoice) | Bearer |
| `GET` | `/invoice/{id}` | [`getInvoiceDetails`](#billinggetinvoicedetails) | Bearer |
| `POST` | `/invoice/{id}/credit` | [`applyCredit`](#billingapplycredit) | Bearer |
| `GET` | `/invoice/{id}/pdf` | [`getInvoicePdf`](#billinggetinvoicepdf) | Bearer |

---

### `billing.getAddFundsInfo`

`GET /addfunds` — Bearer token · verified live

**Get Add Funds Information**

Get add funds configuration: minimum and maximum deposit amounts and available payment gateways

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "min_amount": 50000,
 "max_amount": 500000000,
 "gateways": [
  {
   "id": 190,
   "name": "Thanh toán bằng chuyển khoản - QR Code - Momo - ZaloPay"
  },
  {
   "id": 70,
   "name": "Ví điện tử MoMo"
  },
  "… 2 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.billing.get_add_funds_info()
```
```javascript
await client.billing.getAddFundsInfo();
```
```php
$client->billing->getAddFundsInfo();
```

---

### `billing.addFundsLegacy`

`POST /addfunds` — Bearer token · spec only

**Add Funds**

Generate add funds invoice

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `amount` | number | no | Amount to add to account |
| `gateway` | number | no | Payment gateway ID, use `GET /addfunds` to list available gateways |

```json
{
  "amount": "100.00",
  "gateway": "gatewayValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.billing.add_funds_legacy(amount=...)
```
```javascript
await client.billing.addFundsLegacy({ amount: ... });
```
```php
$client->billing->addFundsLegacy(['amount' => ...]);
```

---

### `billing.getBalance`

`GET /balance` — Bearer token · verified live

**Account balance**

Get current account balance(unpaid invoices total), account credit

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "details": {
  "currency": "đ",
  "acc_balance": 574723,
  "acc_credit": "0.00"
 }
}
```

</details>

**SDK**

```python
client.billing.get_balance()
```
```javascript
await client.billing.getBalance();
```
```php
$client->billing->getBalance();
```

---

### `billing.addFunds`

`POST /billing/addfunds` — Bearer token · spec only

**Add Funds**

Create Invoice Add Credits

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `funds` | integer | no | Amount of money |
| `gateway` | integer | no | Payment Method |

```json
{
  "funds": 0,
  "gateway": 0
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.billing.add_funds(funds=...)
```
```javascript
await client.billing.addFunds({ funds: ... });
```
```php
$client->billing->addFunds(['funds' => ...]);
```

---

### `billing.getCreditLogs`

`GET /billing/creditlogs` — Bearer token · verified live

**Credit logs**

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
 "logs": [],
 "page": {
  "total": 0,
  "pages": 0,
  "current": 1
 }
}
```

</details>

**SDK**

```python
client.billing.get_credit_logs()
```
```javascript
await client.billing.getCreditLogs();
```
```php
$client->billing->getCreditLogs();
```

---

### `billing.redeemCreditVoucher`

`POST /billing/creditvoucher` — Bearer token · spec only

**Redeem a voucher**

Using Redeem a voucher

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `code` | string | no | Voucher Code |

```json
{
  "code": "<code>"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.billing.redeem_credit_voucher(code=...)
```
```javascript
await client.billing.redeemCreditVoucher({ code: ... });
```
```php
$client->billing->redeemCreditVoucher(['code' => ...]);
```

---

### `billing.getPaymentLink`

`GET /billing/{invoice_id}/pay/{gateway_id}` — Bearer token · verified live

**Payment link**

Get Payment link from Gateways.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `invoice_id` | path | integer | yes | Invoice ID |
| `gateway_id` | path | integer | yes | Gateway ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "content": "<redacted>"
}
```

</details>

**SDK**

```python
client.billing.get_payment_link(invoice_id, gateway_id)
```
```javascript
await client.billing.getPaymentLink(invoiceId, gatewayId);
```
```php
$client->billing->getPaymentLink($invoiceId, $gatewayId);
```

---

### `billing.getCurrencies`

`GET /currencies` — Public · verified live

**Currencies List**

Return currencies details

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[
 {
  "code": "đ",
  "iso": "VND",
  "sign": "",
  "format": "1,234.56",
  "decimal": "0",
  "rounding": "0",
  "rounding_mode": "HALF_UP",
  "id": 0,
  "rate": 1
 }
]
```

</details>

**SDK**

```python
client.billing.get_currencies()
```
```javascript
await client.billing.getCurrencies();
```
```php
$client->billing->getCurrencies();
```

---

### `billing.getEstimatePdf`

`GET /estimate/{id}/pdf` — Bearer token · spec only

**Download Invoice Pdf**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.billing.get_estimate_pdf(id)
```
```javascript
await client.billing.getEstimatePdf(id);
```
```php
$client->billing->getEstimatePdf($id);
```

---

### `billing.listEstimates`

`GET /estimates` — Bearer token · verified live

**List Estimates**

List all estimates under my account
Using: &page=&perpage= for pagination. page start 0.
filter[service_status]= search invoice by service status, filter[service]= search invoice by service id

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
 "estimates": [],
 "total": 0,
 "page": {
  "total": 0,
  "pages": 0,
  "current": 1
 }
}
```

</details>

**SDK**

```python
client.billing.list_estimates()
```
```javascript
await client.billing.listEstimates();
```
```php
$client->billing->listEstimates();
```

---

### `billing.getEstimate`

`GET /estimates/{id}` — Bearer token · spec only

**Estimates Details**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | Estimates id |

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.billing.get_estimate(id)
```
```javascript
await client.billing.getEstimate(id);
```
```php
$client->billing->getEstimate($id);
```

---

### `billing.listInvoicesLegacy`

`GET /invoice` — Bearer token · verified live

**List Invoices**

List all invoices under my account

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
 "invoices": [
  {
   "id": "300001",
   "date": "2026-03-30",
   "dateorig": "2026-03-30",
   "duedate": "2026-12-07",
   "paybefore": "2026-12-07",
   "total": "574723.00",
   "subtotal": "532151.00",
   "tax": "42572.00",
   "tax2": "0.00",
   "datepaid": "0000-00-00 00:00:00",
   "status": "Unpaid",
   "merge_id": null,
   "number": "TNG300001",
   "currency": "VND"
  }
 ]
}
```

</details>

**SDK**

```python
client.billing.list_invoices_legacy()
```
```javascript
await client.billing.listInvoicesLegacy();
```
```php
$client->billing->listInvoicesLegacy();
```

---

### `billing.deleteInvoice`

`DELETE /invoice/{id}` — Bearer token · spec only

**Delete Invoice**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Invoice id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.billing.delete_invoice(id)
```
```javascript
await client.billing.deleteInvoice(id);
```
```php
$client->billing->deleteInvoice($id);
```

---

### `billing.getInvoiceDetails`

`GET /invoice/{id}` — Bearer token · verified live

**Invoice Details**

Get invoice details

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "invoice": {
  "id": "300001",
  "status": "Unpaid",
  "contact_id": "0",
  "date": "2026-03-30",
  "duedate": "2026-12-07",
  "paybefore": "2026-12-07",
  "datepaid": "0000-00-00 00:00:00",
  "subtotal": 532151,
  "credit": 0,
  "tax": 42572,
  "taxrate": 10,
  "tax2": 0,
  "taxrate2": 0,
  "taxexempt": "0",
  "total": 574723,
  "grandtotal": 574723,
  "payment_module": "190",
  "rate": 1,
  "rate2": 0,
  "rate3": 1,
  "…": "11 more key(s)"
 },
 "cancancelinvoice": false,
 "invoicebody": "",
 "transactions": []
}
```

</details>

**SDK**

```python
client.billing.get_invoice_details(id)
```
```javascript
await client.billing.getInvoiceDetails(id);
```
```php
$client->billing->getInvoiceDetails($id);
```

---

### `billing.applyCredit`

`POST /invoice/{id}/credit` — Bearer token · spec only

**Apply Credit**

Calculate order cost and recurring prices for selected items.
Use the same parameters as for `POST /order`

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Payment method ID |
| `amount` | string | no | — |

```json
{
  "id": "pay_methodValue",
  "amount": "short"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.billing.apply_credit(id, id=...)
```
```javascript
await client.billing.applyCredit(id, { id: ... });
```
```php
$client->billing->applyCredit($id, ['id' => ...]);
```

---

### `billing.getInvoicePdf`

`GET /invoice/{id}/pdf` — Bearer token · verified live

**Invoice PDF**

Get specific invoice PDF as base64 string

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "invoice": "JVBERi0xLjQKJeLjz9MKMyAwIG9iago8PC9UeXBlIC9QYWdlCi9QYXJlbnQgMSAwIFIKL01lZGlhQm94IFswIDAgNTk1LjI4MCA4NDEuODkwXQovVHJpbUJveCBbMC4wMDAgMC4wMDAgNTk1LjI4MCA4NDEuODkwXQovUmVzb3VyY2VzIDIgMCBSCi9Hcm91cCA8PCAvVHlwZSAvR3JvdXAgL1MgL1RyYW5zcGFyZW5jeSAvQ1MgL0RldmljZVJHQiA+PiAKL0NvbnRlbnRzIDQgMCBSPj4KZW5kb2JqCjQg…"
}
```

</details>

**SDK**

```python
client.billing.get_invoice_pdf(id)
```
```javascript
await client.billing.getInvoicePdf(id);
```
```php
$client->billing->getInvoicePdf($id);
```

---
