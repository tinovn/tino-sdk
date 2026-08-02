# Domain names (part 2/3)

SDK namespace: `client.domains` (Python) · `client.domains` (Node.js, PHP).

16 operation(s) in this chapter, 7 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `PUT` | `/domain/{id}/dnssec` | [`addDnssecKey`](#domainsadddnsseckey) | Bearer |
| `GET` | `/domain/{id}/dnssec/flags` | [`getDnssecFlags`](#domainsgetdnssecflags) | Bearer |
| `DELETE` | `/domain/{id}/dnssec/{key}` | [`removeDnssecKey`](#domainsremovednsseckey) | Bearer |
| `GET` | `/domain/{id}/emforwarding` | [`getEmailForwarding`](#domainsgetemailforwarding) | Bearer |
| `PUT` | `/domain/{id}/emforwarding` | [`updateEmailForwarding`](#domainsupdateemailforwarding) | Bearer |
| `GET` | `/domain/{id}/epp` | [`getEppCode`](#domainsgeteppcode) | Bearer |
| `PUT` | `/domain/{id}/forwarding` | [`updateForwarding`](#domainsupdateforwarding) | Bearer |
| `PUT` | `/domain/{id}/idprotection` | [`updateIdProtection`](#domainsupdateidprotection) | Bearer |
| `GET` | `/domain/{id}/invoices` | [`listInvoices`](#domainslistinvoices) | Bearer |
| `GET` | `/domain/{id}/ns` | [`getNameservers`](#domainsgetnameservers) | Bearer |
| `PUT` | `/domain/{id}/ns` | [`updateNameservers`](#domainsupdatenameservers) | Bearer |
| `GET` | `/domain/{id}/reg` | [`getRegisteredNameservers`](#domainsgetregisterednameservers) | Bearer |
| `POST` | `/domain/{id}/reg` | [`registerNameserver`](#domainsregisternameserver) | Bearer |
| `GET` | `/domain/{id}/reglock` | [`getRegistrarLock`](#domainsgetregistrarlock) | Bearer |
| `PUT` | `/domain/{id}/reglock` | [`updateRegistrarLock`](#domainsupdateregistrarlock) | Bearer |
| `POST` | `/domain/{id}/renew` | [`renew`](#domainsrenew) | Bearer |

---

### `domains.addDnssecKey`

`PUT /domain/{id}/dnssec` — Bearer token · spec only

**Adds the DNSSEC key**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Domain id |

```json
{
  "id": "idValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.domains.add_dnssec_key(id, id=...)
```
```javascript
await client.domains.addDnssecKey(id, { id: ... });
```
```php
$client->domains->addDnssecKey($id, ['id' => ...]);
```

---

### `domains.getDnssecFlags`

`GET /domain/{id}/dnssec/flags` — Bearer token · verified live

**Returns the available flags**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "flag": null,
 "protocol": null,
 "algorithm": null,
 "digest": null,
 "form_type": null
}
```

</details>

**SDK**

```python
client.domains.get_dnssec_flags(id)
```
```javascript
await client.domains.getDnssecFlags(id);
```
```php
$client->domains->getDnssecFlags($id);
```

---

### `domains.removeDnssecKey`

`DELETE /domain/{id}/dnssec/{key}` — Bearer token · spec only

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain id |
| `key` | path | string | yes | — |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.domains.remove_dnssec_key(id, key)
```
```javascript
await client.domains.removeDnssecKey(id, key);
```
```php
$client->domains->removeDnssecKey($id, $key);
```

---

### `domains.getEmailForwarding`

`GET /domain/{id}/emforwarding` — Bearer token · verified live

**Get email forwarding**

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
 "email_forwarding": null
}
```

</details>

**SDK**

```python
client.domains.get_email_forwarding(id)
```
```javascript
await client.domains.getEmailForwarding(id);
```
```php
$client->domains->getEmailForwarding($id);
```

---

### `domains.updateEmailForwarding`

`PUT /domain/{id}/emforwarding` — Bearer token · spec only

**Update email forwarding**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Domain id |
| `from` | string | no | Email address that you want to forward |
| `to` | string | no | Email address that will receive forwarded emails |
| `records` | array | no | Multiple forwarding rules [{"from":"info","to":"dest@domain.com"},{"from":"support","to":"help@domain.com"}] |

```json
{
  "id": "idValue",
  "from": "info@domain.com",
  "to": "destination@domain.com",
  "records": "recordsValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.domains.update_email_forwarding(id, id=...)
```
```javascript
await client.domains.updateEmailForwarding(id, { id: ... });
```
```php
$client->domains->updateEmailForwarding($id, ['id' => ...]);
```

---

### `domains.getEppCode`

`GET /domain/{id}/epp` — Bearer token · verified live

**Get domain EPP Code**

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
 "epp_code": "<redacted>"
}
```

</details>

**SDK**

```python
client.domains.get_epp_code(id)
```
```javascript
await client.domains.getEppCode(id);
```
```php
$client->domains->getEppCode($id);
```

---

### `domains.updateForwarding`

`PUT /domain/{id}/forwarding` — Bearer token · spec only

**Update domain forwarding**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Domain id |

```json
{
  "id": "idValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.domains.update_forwarding(id, id=...)
```
```javascript
await client.domains.updateForwarding(id, { id: ... });
```
```php
$client->domains->updateForwarding($id, ['id' => ...]);
```

---

### `domains.updateIdProtection`

`PUT /domain/{id}/idprotection` — Bearer token · spec only

**Update domain ID Protection**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain id |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `switch` | boolean | no | true\|false |

```json
{
  "switch": "true|false"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.domains.update_id_protection(id, switch=...)
```
```javascript
await client.domains.updateIdProtection(id, { switch: ... });
```
```php
$client->domains->updateIdProtection($id, ['switch' => ...]);
```

---

### `domains.listInvoices`

`GET /domain/{id}/invoices` — Bearer token · verified live

**Domain Invoice Related**

Returns details of the DNS zone

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "rel_invoices": [
  {
   "id": "300001",
   "client_id": "<redacted>",
   "date": "2026-03-30",
   "dateorig": "2026-03-30",
   "duedate": "2026-12-07",
   "paybefore": "2026-12-07",
   "currency_id": "0",
   "total": "574723.00",
   "paid_id": "",
   "subtotal": "532151.00",
   "tax": "42572.00",
   "tax2": "0.00",
   "datepaid": "0000-00-00 00:00:00",
   "status": "Unpaid",
   "merge_id": "300001"
  }
 ]
}
```

</details>

**SDK**

```python
client.domains.list_invoices(id)
```
```javascript
await client.domains.listInvoices(id);
```
```php
$client->domains->listInvoices($id);
```

---

### `domains.getNameservers`

`GET /domain/{id}/ns` — Bearer token · verified live

**Get domain nameservers**

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
 "nameservers": [
  "ns1.tino.vn",
  "ns2.tino.vn"
 ]
}
```

</details>

**SDK**

```python
client.domains.get_nameservers(id)
```
```javascript
await client.domains.getNameservers(id);
```
```php
$client->domains->getNameservers($id);
```

---

### `domains.updateNameservers`

`PUT /domain/{id}/ns` — Bearer token · spec only

**Update domain nameservers**

Change domain nameservers, if `$nameservers` is left empty, default namesevers will be used

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Domain id |
| `nameservers` | array | no | List of nameservers to use |

```json
{
  "id": "idValue",
  "nameservers": "nameserversValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.domains.update_nameservers(id, id=...)
```
```javascript
await client.domains.updateNameservers(id, { id: ... });
```
```php
$client->domains->updateNameservers($id, ['id' => ...]);
```

---

### `domains.getRegisteredNameservers`

`GET /domain/{id}/reg` — Bearer token · verified live

**Get registered nameservers**

List registered private/glue nameservers for a domain.
Note: Not all domain registrar modules support returning registered nameservers.
If the module does not support this feature, an empty list may be returned.

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
 "nameservers": []
}
```

</details>

**SDK**

```python
client.domains.get_registered_nameservers(id)
```
```javascript
await client.domains.getRegisteredNameservers(id);
```
```php
$client->domains->getRegisteredNameservers($id);
```

---

### `domains.registerNameserver`

`POST /domain/{id}/reg` — Bearer token · spec only

**Register domain nameservers**

Manage private/glue nameservers for a domain. Use the `action` parameter to select the operation:
- `registerNameServer` – register a new glue record (requires `nameserver` + `ip`)
- `modifyNameServer` – update the IP of an existing glue record (requires `nameserver` + `oldip` + `newip`)
- `deleteNameServer` – remove a glue record (requires `nameserver`)

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Domain id |
| `action` | string | no | Operation: registerNameServer, modifyNameServer, deleteNameServer |
| `nameserver` | string | no | Full nameserver hostname |
| `ip` | string | no | IP address for the nameserver – required for registerNameServer |
| `oldip` | string | no | Current IP address – required for modifyNameServer |
| `newip` | string | no | New IP address – required for modifyNameServer |

```json
{
  "id": "idValue",
  "action": "registerNameServer",
  "nameserver": "ns1.yourdomain.com",
  "ip": "1.2.3.4",
  "oldip": "1.2.3.4",
  "newip": "5.6.7.8"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.domains.register_nameserver(id, id=...)
```
```javascript
await client.domains.registerNameserver(id, { id: ... });
```
```php
$client->domains->registerNameserver($id, ['id' => ...]);
```

---

### `domains.getRegistrarLock`

`GET /domain/{id}/reglock` — Bearer token · verified live

**Get domain lock**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "registrar_lock": null
}
```

</details>

**SDK**

```python
client.domains.get_registrar_lock(id)
```
```javascript
await client.domains.getRegistrarLock(id);
```
```php
$client->domains->getRegistrarLock($id);
```

---

### `domains.updateRegistrarLock`

`PUT /domain/{id}/reglock` — Bearer token · spec only

**Update domain lock**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain id |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `switch` | boolean | no | true\|false |

```json
{
  "switch": "true|false"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.domains.update_registrar_lock(id, switch=...)
```
```javascript
await client.domains.updateRegistrarLock(id, { switch: ... });
```
```php
$client->domains->updateRegistrarLock($id, ['switch' => ...]);
```

---

### `domains.renew`

`POST /domain/{id}/renew` — Bearer token · spec only

**Renew domain**

Create new renew order for a domain, please check if requested domain is available first, otherwise your order may get cancelled.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `years` | string | no | Number of years |
| `pay_method` | integer | no | Payment method ID |

```json
{
  "years": "yearsValue",
  "pay_method": "pay_methodValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.domains.renew(id, years=...)
```
```javascript
await client.domains.renew(id, { years: ... });
```
```php
$client->domains->renew($id, ['years' => ...]);
```

---
