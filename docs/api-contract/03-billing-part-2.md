# Billing, invoices & payments (part 2/2)

SDK namespace: `client.billing` (Python) · `client.billing` (Node.js, PHP).

6 operation(s) in this chapter, 6 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/invoice/{id}/pdf` | [`getInvoicePdf`](#billinggetinvoicepdf) | Bearer |
| `GET` | `/invoices` | [`listInvoices`](#billinglistinvoices) | Bearer |
| `GET` | `/invoices/due` | [`listInvoicesDue`](#billinglistinvoicesdue) | Bearer |
| `POST` | `/invoices/payall` | [`payAllInvoices`](#billingpayallinvoices) | Bearer |
| `GET` | `/payment` | [`listPaymentMethods`](#billinglistpaymentmethods) | public |
| `GET` | `/payment/fees` | [`listPaymentMethodFees`](#billinglistpaymentmethodfees) | public |

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

### `billing.listInvoices`

`GET /invoices` — Bearer token · verified live

**List Invoices**

List all invoices under my account
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
   "datepaid": "0000-00-00 2001:db8::1",
   "status": "Unpaid",
   "merge_id": null,
   "number": "TNG300001",
   "currency": "VND"
  }
 ],
 "total": 1,
 "page": {
  "total": 1,
  "pages": 1,
  "current": 1
 }
}
```

</details>

**SDK**

```python
client.billing.list_invoices()
```
```javascript
await client.billing.listInvoices();
```
```php
$client->billing->listInvoices();
```

---

### `billing.listInvoicesDue`

`GET /invoices/due` — Bearer token · verified live

**List Invoices Due**

List all invoices due under my account
Using: &page=&perpage= for pagination. page start 0

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
 "invoices_due": [
  {
   "id": "300001",
   "date": "2026-03-30",
   "duedate": "2026-12-07",
   "paybefore": "2026-12-07",
   "total": "574723.00",
   "status": "Unpaid",
   "number": "TNG300001",
   "currency": "VND"
  }
 ],
 "total": 1,
 "page": {
  "total": 1,
  "pages": 1,
  "current": 1
 }
}
```

</details>

**SDK**

```python
client.billing.list_invoices_due()
```
```javascript
await client.billing.listInvoicesDue();
```
```php
$client->billing->listInvoicesDue();
```

---

### `billing.payAllInvoices`

`POST /invoices/payall` — Bearer token · verified live

**Payall Invoice**

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `selected` | array | no | selected invoice id |

```json
{
  "selected": []
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "invoice_id": null
}
```

</details>

**SDK**

```python
client.billing.pay_all_invoices(selected=...)
```
```javascript
await client.billing.payAllInvoices({ selected: ... });
```
```php
$client->billing->payAllInvoices(['selected' => ...]);
```

---

### `billing.listPaymentMethods`

`GET /payment` — Public · verified live

**Payment Methods**

List available payment methods

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "payments": {
  "190": "Thanh toán bằng chuyển khoản - QR Code - Momo - ZaloPay",
  "70": "Ví điện tử MoMo",
  "71": "Thanh toán Thẻ tín dụng - ATM",
  "43": "VCB - Ngân hàng TMCP Ngoại Thương Việt Nam"
 }
}
```

</details>

**SDK**

```python
client.billing.list_payment_methods()
```
```javascript
await client.billing.listPaymentMethods();
```
```php
$client->billing->listPaymentMethods();
```

---

### `billing.listPaymentMethodFees`

`GET /payment/fees` — Public · verified live

**Payment Methods Fees**

List available payment methods with fees

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "payments": [
  {
   "id": 190,
   "name": "Thanh toán bằng chuyển khoản - QR Code - Momo - ZaloPay",
   "fixed_fee": "0",
   "percent_fee": "0",
   "icon": "payment-logo-190"
  },
  {
   "id": 70,
   "name": "Ví điện tử MoMo",
   "fixed_fee": "0",
   "percent_fee": "0",
   "icon": "payment-logo-70"
  },
  "… 2 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.billing.list_payment_method_fees()
```
```javascript
await client.billing.listPaymentMethodFees();
```
```php
$client->billing->listPaymentMethodFees();
```

---
