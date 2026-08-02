# Services (hosting, VPS, ...) (part 1/2)

SDK namespace: `client.services` (Python) · `client.services` (Node.js, PHP).

15 operation(s) in this chapter, 8 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/service` | [`list`](#serviceslist) | Bearer |
| `GET` | `/service/{id}` | [`get`](#servicesget) | Bearer |
| `POST` | `/service/{id}/cancel` | [`cancel`](#servicescancel) | Bearer |
| `GET` | `/service/{id}/cycle` | [`getBillingCycles`](#servicesgetbillingcycles) | Bearer |
| `POST` | `/service/{id}/cycle` | [`setBillingCycle`](#servicessetbillingcycle) | Bearer |
| `GET` | `/service/{id}/emails` | [`listEmailAccounts`](#serviceslistemailaccounts) | Bearer |
| `POST` | `/service/{id}/emails` | [`createEmailAccount`](#servicescreateemailaccount) | Bearer |
| `POST` | `/service/{id}/emails/change` | [`updateEmailAccount`](#servicesupdateemailaccount) | Bearer |
| `POST` | `/service/{id}/emails/delete` | [`deleteEmailAccount`](#servicesdeleteemailaccount) | Bearer |
| `GET` | `/service/{id}/invoices` | [`listInvoices`](#serviceslistinvoices) | Bearer |
| `GET` | `/service/{id}/ip` | [`listIps`](#serviceslistips) | Bearer |
| `GET` | `/service/{id}/label` | [`getLabel`](#servicesgetlabel) | Bearer |
| `POST` | `/service/{id}/label` | [`setLabel`](#servicessetlabel) | Bearer |
| `POST` | `/service/{id}/manualrenew` | [`manualRenew`](#servicesmanualrenew) | Bearer |
| `GET` | `/service/{id}/methods` | [`listMethods`](#serviceslistmethods) | Bearer |

---

### `services.list`

`GET /service` — Bearer token · verified live

**List services**

List all services under your account

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
 "services": [
  {
   "id": "100001",
   "domain": "example.com",
   "total": "79000.00",
   "status": "Active",
   "billingcycle": "Monthly",
   "next_due": "2026-08-26",
   "expires": "2026-08-26",
   "category": "Platinum Hosting",
   "category_url": "platinum-hosting",
   "name": "WH 1"
  },
  {
   "id": "100002",
   "domain": "vps-demo.example.net",
   "total": "199000.00",
   "status": "Active",
   "billingcycle": "Monthly",
   "next_due": "2026-08-26",
   "expires": "2026-08-26",
   "category": "NVMe VPS ",
   "category_url": "nvme-vps",
   "name": "VPS 20 GB NVMe"
  },
  "… 9 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.services.list()
```
```javascript
await client.services.list();
```
```php
$client->services->list();
```

---

### `services.get`

`GET /service/{id}` — Bearer token · verified live

**Service details**

Return details for service `@id`

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Service id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "service": {
  "id": "100001",
  "product_id": "2122",
  "date_created": "2026-07-26",
  "domain": "example.com",
  "firstpayment": "79000.00",
  "total": "79000.00",
  "billingcycle": "Monthly",
  "next_due": "2026-08-26",
  "due_day": "26",
  "expires": "2026-08-26",
  "autorenew": "1",
  "next_invoice": "2026-08-11",
  "status": "Active",
  "label": "",
  "username": "tranbinh18",
  "password": "<redacted>",
  "rootpassword": null,
  "commitment_date": null,
  "date_suspended": "0000-00-00",
  "date_terminated": "0000-00-00",
  "…": "9 more key(s)"
 },
 "addons": [],
 "haveaddons": [],
 "unpaid_invoice": []
}
```

</details>

**SDK**

```python
client.services.get(id)
```
```javascript
await client.services.get(id);
```
```php
$client->services->get($id);
```

---

### `services.cancel`

`POST /service/{id}/cancel` — Bearer token · spec only

**Cancel Service**

Request service cancellation

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Service id |
| `immediate` | string | no | set to false</code> to terminate service at the end of billing date, true</code> - terminate immediately |
| `reason` | string | no | Reason for this request |

```json
{
  "id": "idValue",
  "immediate": "immediateValue",
  "reason": "reasonValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.services.cancel(id, id=...)
```
```javascript
await client.services.cancel(id, { id: ... });
```
```php
$client->services->cancel($id, ['id' => ...]);
```

---

### `services.getBillingCycles`

`GET /service/{id}/cycle` — Bearer token · verified live

**List Billing Cycle**

Get recurring billing cycle options

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Service id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "current": "m",
 "cycles": []
}
```

</details>

**SDK**

```python
client.services.get_billing_cycles(id)
```
```javascript
await client.services.getBillingCycles(id);
```
```php
$client->services->getBillingCycles($id);
```

---

### `services.setBillingCycle`

`POST /service/{id}/cycle` — Bearer token · spec only

**Change Billing Cycle**

Change recurring billing cycle for the service

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Service id |
| `cycle` | string | no | New billing cycle |

```json
{
  "id": "idValue",
  "cycle": "cycleValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.services.set_billing_cycle(id, id=...)
```
```javascript
await client.services.setBillingCycle(id, { id: ... });
```
```php
$client->services->setBillingCycle($id, ['id' => ...]);
```

---

### `services.listEmailAccounts`

`GET /service/{id}/emails` — Bearer token · verified live

**Get Emails Account**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Service ID |
| `module` | path | string | yes | Service type module (Cpanel2\|DirectAdmin2\|Zimbra\|Wilduck) |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "listentrys": null
}
```

</details>

**SDK**

```python
client.services.list_email_accounts(id, module)
```
```javascript
await client.services.listEmailAccounts(id, module);
```
```php
$client->services->listEmailAccounts($id, $module);
```

---

### `services.createEmailAccount`

`POST /service/{id}/emails` — Bearer token · spec only

**Create Emails Account**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Service ID |
| `module` | path | string | yes | Service type module (Cpanel2\|DirectAdmin2\|Zimbra\|Wilduck) |
| `name` | path | string | yes | Email account without domain |
| `passmain` | path | string | yes | Password for email account |
| `passcheck` | path | string | yes | Password confirm for email account |
| `quota` | path | integer | yes | Email Quote (Megabytes) |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.services.create_email_account(id, module, name, passmain, passcheck, quota)
```
```javascript
await client.services.createEmailAccount(id, module, name, passmain, passcheck, quota);
```
```php
$client->services->createEmailAccount($id, $module, $name, $passmain, $passcheck, $quota);
```

---

### `services.updateEmailAccount`

`POST /service/{id}/emails/change` — Bearer token · spec only

**Update Emails Account**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Service ID |
| `module` | path | string | yes | Service type module (Cpanel2\|DirectAdmin2\|Zimbra\|Wilduck) |
| `change` | path | Array | yes | — |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.services.update_email_account(id, module, change)
```
```javascript
await client.services.updateEmailAccount(id, module, change);
```
```php
$client->services->updateEmailAccount($id, $module, $change);
```

---

### `services.deleteEmailAccount`

`POST /service/{id}/emails/delete` — Bearer token · spec only

**Delete Email Account**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Service ID |
| `module` | path | string | yes | Service type module (Cpanel2\|DirectAdmin2\|Zimbra\|Wilduck) |
| `deluser` | path | string | yes | Email account |
| `domain` | path | string | yes | Password for email account |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.services.delete_email_account(id, module, deluser, domain)
```
```javascript
await client.services.deleteEmailAccount(id, module, deluser, domain);
```
```php
$client->services->deleteEmailAccount($id, $module, $deluser, $domain);
```

---

### `services.listInvoices`

`GET /service/{id}/invoices` — Bearer token · verified live

**Service Invoice Related**

Returns details of the DNS zone

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Service ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "rel_invoices": null
}
```

</details>

**SDK**

```python
client.services.list_invoices(id)
```
```javascript
await client.services.listInvoices(id);
```
```php
$client->services->listInvoices($id);
```

---

### `services.listIps`

`GET /service/{id}/ip` — Bearer token · verified live

**IP Addresses**

List Service IP Addresses

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Service ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "ips": []
}
```

</details>

**SDK**

```python
client.services.list_ips(id)
```
```javascript
await client.services.listIps(id);
```
```php
$client->services->listIps($id);
```

---

### `services.getLabel`

`GET /service/{id}/label` — Bearer token · verified live

**Service label**

Show current service label

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Service id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "label": ""
}
```

</details>

**SDK**

```python
client.services.get_label(id)
```
```javascript
await client.services.getLabel(id);
```
```php
$client->services->getLabel($id);
```

---

### `services.setLabel`

`POST /service/{id}/label` — Bearer token · spec only

**Change service label**

Set new custom label to identify this service

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Service id |
| `label` | string | no | New label |

```json
{
  "id": "idValue",
  "label": "labelValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.services.set_label(id, id=...)
```
```javascript
await client.services.setLabel(id, { id: ... });
```
```php
$client->services->setLabel($id, ['id' => ...]);
```

---

### `services.manualRenew`

`POST /service/{id}/manualrenew` — Bearer token · spec only

**Manual renew Service**

Check if domain is available for registration. Returns status: "ok" if domain is available, empty response otherwise

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.services.manual_renew(id)
```
```javascript
await client.services.manualRenew(id);
```
```php
$client->services->manualRenew($id);
```

---

### `services.listMethods`

`GET /service/{id}/methods` — Bearer token · verified live

**List service methods**

List methods available for service

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "methods": [
  {
   "name": "Upgrade Options",
   "method": "GET",
   "route": "/service/@id/upgrade"
  },
  {
   "name": "Upgrade Request",
   "method": "POST",
   "route": "/service/@id/upgrade"
  },
  "… 30 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.services.list_methods(id)
```
```javascript
await client.services.listMethods(id);
```
```php
$client->services->listMethods($id);
```

---
