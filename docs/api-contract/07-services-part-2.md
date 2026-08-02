# Services (hosting, VPS, ...) (part 2/2)

SDK namespace: `client.services` (Python) · `client.services` (Node.js, PHP).

11 operation(s) in this chapter, 8 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/service/{id}/networks` | [`listNetworks`](#serviceslistnetworks) | Bearer |
| `GET` | `/service/{id}/rdns` | [`getReverseDns`](#servicesgetreversedns) | Bearer |
| `POST` | `/service/{id}/rdns` | [`updateReverseDns`](#servicesupdatereversedns) | Bearer |
| `POST` | `/service/{id}/renew` | [`renew`](#servicesrenew) | Bearer |
| `GET` | `/service/{id}/resources` | [`getResources`](#servicesgetresources) | Bearer |
| `GET` | `/service/{id}/templates` | [`listOsTemplates`](#serviceslistostemplates) | Bearer |
| `GET` | `/service/{id}/upgrade` | [`getUpgradeOptions`](#servicesgetupgradeoptions) | Bearer |
| `POST` | `/service/{id}/upgrade` | [`requestUpgrade`](#servicesrequestupgrade) | Bearer |
| `GET` | `/service/{id}/widgets` | [`listWidgets`](#serviceslistwidgets) | Bearer |
| `GET` | `/services/active` | [`listActive`](#serviceslistactive) | Bearer |
| `GET` | `/services/{cid}` | [`listByCategory`](#serviceslistbycategory) | Bearer |

---

### `services.listNetworks`

`GET /service/{id}/networks` — Bearer token · verified live

**List available networks**

List of networks and IP pools that can be used for VM creation

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "network": {
  "devices": [],
  "zones": [
   {
    "value": "vmbr0:218",
    "zone": "vmbr0",
    "vlan": "218",
    "label": "vmbr0 VLAN #218"
   },
   {
    "value": "vmbr0:24",
    "zone": "vmbr0",
    "vlan": "24",
    "label": "vmbr0 VLAN #24"
   },
   "… 20 more item(s)"
  ],
  "limits": [
   {
    "name": "IPv4 Pool",
    "type": "ipv4",
    "options": [
     {
      "label": "Public IP(s)",
      "value": "public",
      "max": 0,
      "type": "ipv4",
      "zones": [
       "vmbr0",
       "vmbr20"
      ],
      "vlan": [
       "218",
       "24",
       "… 9 more item(s)"
      ],
      "gateways": []
     }
    ]
   },
   {
    "name": "IPv6 Pool",
    "type": "ipv6",
    "options": [
  … 24 more line(s)
```

</details>

**SDK**

```python
client.services.list_networks(id)
```
```javascript
await client.services.listNetworks(id);
```
```php
$client->services->listNetworks($id);
```

---

### `services.getReverseDns`

`GET /service/{id}/rdns` — Bearer token · verified live

**Reverse DNS**

Get reverse DNS entries for service's IP addresses

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Service ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "rdns": null
}
```

</details>

**SDK**

```python
client.services.get_reverse_dns(id)
```
```javascript
await client.services.getReverseDns(id);
```
```php
$client->services->getReverseDns($id);
```

---

### `services.updateReverseDns`

`POST /service/{id}/rdns` — Bearer token · spec only

**Update rDNS**

Update reverse DNS entries service's IP addresses

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Service ID |
| `ipaddress` | array | no | Use Ip address as parameter key and hostname as value |

```json
{
  "id": "idValue",
  "ipaddress": "ipaddressValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.services.update_reverse_dns(id, id=...)
```
```javascript
await client.services.updateReverseDns(id, { id: ... });
```
```php
$client->services->updateReverseDns($id, ['id' => ...]);
```

---

### `services.renew`

`POST /service/{id}/renew` — Bearer token · spec only

**Manual Service Renew**

Generate an invoice to renew the service.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Service id |

```json
{
  "id": "idValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.services.renew(id, id=...)
```
```javascript
await client.services.renew(id, { id: ... });
```
```php
$client->services->renew($id, ['id' => ...]);
```

---

### `services.getResources`

`GET /service/{id}/resources` — Bearer token · verified live

**Resources**

Show available and used resources

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "limit": {
  "mem": 0,
  "cpu": 0,
  "ips": 0,
  "priv_ips": 0,
  "disk": 0,
  "additional_storage": 0
 },
 "total": {
  "cpu": 1,
  "mem": 1024,
  "ips": 1,
  "priv_ips": 0,
  "disk": 20,
  "additional_storage": 0
 }
}
```

</details>

**SDK**

```python
client.services.get_resources(id)
```
```javascript
await client.services.getResources(id);
```
```php
$client->services->getResources($id);
```

---

### `services.listOsTemplates`

`GET /service/{id}/templates` — Bearer token · verified live

**List OS templates**

List templates that can be used to create virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "templates": [
  {
   "id": "a37411b5-4136-29f6-9dc0-d07f78a6ad5e",
   "name": "Ubuntu 26.04",
   "price": 0,
   "type": "template",
   "group": "public",
   "size_gb": 4,
   "interfaces": [
    {
     "name": "net0",
     "zones": null,
     "zone": "vmbr0",
     "ip_required": true
    }
   ]
  },
  {
   "id": "8c93b9af-1bd8-5a73-8190-f7e272bd4157",
   "name": "Almalinux 10",
   "price": 0,
   "type": "template",
   "group": "public",
   "size_gb": 10,
   "interfaces": [
    {
     "name": "net0",
     "zones": null,
     "zone": "vmbr0",
     "ip_required": true
    }
   ]
  },
  "… 12 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.services.list_os_templates(id)
```
```javascript
await client.services.listOsTemplates(id);
```
```php
$client->services->listOsTemplates($id);
```

---

### `services.getUpgradeOptions`

`GET /service/{id}/upgrade` — Bearer token · verified live

**Upgrade Options**

List upgrade options

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "resources": [],
 "package": [
  {
   "id": "2007",
   "name": "Host 5GB NVMe",
   "category": "Hosting NVMe",
   "price": {
    "Monthly": "79000.00",
    "Quarterly": "237000.00",
    "Semi-Annually": "474000.00",
    "Annually": "853200.00",
    "Biennially": "1611600.00",
    "Triennially": "2275200.00",
    "Quadrennially": "2844000.00",
    "Quinquennially": "3318000.00"
   }
  },
  {
   "id": "2008",
   "name": "Host Starter NVMe",
   "category": "Hosting NVMe",
   "price": {
    "Monthly": "339000.00",
    "Quarterly": "1017000.00",
    "Semi-Annually": "1830600.00",
    "Annually": "3254400.00",
    "Biennially": "5695200.00",
    "Triennially": "7322400.00",
    "Quadrennially": "8136000.00",
    "Quinquennially": "9153000.00"
   }
  },
  "… 6 more item(s)"
 ]
}
```

</details>

**SDK**

```python
client.services.get_upgrade_options(id)
```
```javascript
await client.services.getUpgradeOptions(id);
```
```php
$client->services->getUpgradeOptions($id);
```

---

### `services.requestUpgrade`

`POST /service/{id}/upgrade` — Bearer token · spec only

**Upgrade Request**

Estimate or request upgrade

```json
// Format of ''resources'' paremeter
{
 "resource_id" : "qty_value", // sliders & qty fields
 "resource_id" : "item_id", // dropdown & radio fields
 "resource_id" : {
 "item_id": "qty_value" // dropdown with qty field
 }
}
```

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `id` | integer | no | Service id |
| `resources` | array | no | array with resource values |
| `package` | integer | no | New package id, optonal when upgrading resources |
| `cycle` | string | no | New billing cycle, optonal when upgrading resources |
| `send` | boolean | no | Set to true when you want to send your upgrade request |

```json
{
  "id": "idValue",
  "resources": "resourcesValue",
  "package": "packageValue",
  "cycle": "cycleValue",
  "send": "sendValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.services.request_upgrade(id, id=...)
```
```javascript
await client.services.requestUpgrade(id, { id: ... });
```
```php
$client->services->requestUpgrade($id, ['id' => ...]);
```

---

### `services.listWidgets`

`GET /service/{id}/widgets` — Bearer token · verified live

**List services widgets**

List all services widgets

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Service id |

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
client.services.list_widgets(id)
```
```javascript
await client.services.listWidgets(id);
```
```php
$client->services->listWidgets($id);
```

---

### `services.listActive`

`GET /services/active` — Bearer token · verified live

**Get list services active**

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
   "category": "NVMe VPS ",
   "category_url": "nvme-vps",
   "name": "VPS 20 GB NVMe"
  },
  "… 1 more item(s)"
 ],
 "total": 3,
 "page": {
  "current": 0,
  "total": 1
 }
}
```

</details>

**SDK**

```python
client.services.list_active()
```
```javascript
await client.services.listActive();
```
```php
$client->services->listActive();
```

---

### `services.listByCategory`

`GET /services/{cid}` — Bearer token · verified live

**List services by category**

List all services under your account by Category id.
filter[hide_terminated]=1 filter[hide_cancelled]=1 filter[hide_suspended]=1 filter[hide_fraud]=1 filter[status]=Active

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `cid` | path | integer | yes | Category id, 0 to get all |

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
   "category": "NVMe VPS ",
   "category_url": "nvme-vps",
   "name": "VPS 20 GB NVMe"
  },
  "… 1 more item(s)"
 ],
 "total": 3,
 "page": {
  "current": 0,
  "total": 1
 }
}
```

</details>

**SDK**

```python
client.services.list_by_category(cid)
```
```javascript
await client.services.listByCategory(cid);
```
```php
$client->services->listByCategory($cid);
```

---
