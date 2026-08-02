# Cloud instances / virtual machines (part 2/3)

SDK namespace: `client.vms` (Python) · `client.vms` (Node.js, PHP).

13 operation(s) in this chapter, 8 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `POST` | `/service/{id}/vms/{vmid}/interfaces` | [`createInterface`](#vmscreateinterface) | Bearer |
| `DELETE` | `/service/{id}/vms/{vmid}/interfaces/{iface}` | [`removeInterface`](#vmsremoveinterface) | Bearer |
| `GET` | `/service/{id}/vms/{vmid}/interfaces/{iface}` | [`getInterface`](#vmsgetinterface) | Bearer |
| `PUT` | `/service/{id}/vms/{vmid}/interfaces/{iface}` | [`updateInterface`](#vmsupdateinterface) | Bearer |
| `GET` | `/service/{id}/vms/{vmid}/ippool` | [`listIpPools`](#vmslistippools) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/ippool/{pool}` | [`allocateIps`](#vmsallocateips) | Bearer |
| `GET` | `/service/{id}/vms/{vmid}/ips` | [`listIps`](#vmslistips) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/reboot` | [`reboot`](#vmsreboot) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/rebuild` | [`rebuild`](#vmsrebuild) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/reset` | [`reset`](#vmsreset) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/resetpwd` | [`resetRootPassword`](#vmsresetrootpassword) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/shutdown` | [`shutdown`](#vmsshutdown) | Bearer |
| `GET` | `/service/{id}/vms/{vmid}/snapshots` | [`listSnapshots`](#vmslistsnapshots) | Bearer |

---

### `vms.createInterface`

`POST /service/{id}/vms/{vmid}/interfaces` — Bearer token · verified live

**Add Network Interface**

Add new network interface to VM

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `bridge` | string | no | Network bridge |
| `firewall` | integer | no | Enable or disable firewall (may require specific permissions) |
| `ipv4` | array | no | List of IP v4 IDs |
| `ipv6` | array | no | List of IP v6 IDs |

```json
{
  "bridge": "bridgeValue",
  "firewall": "firewallValue",
  "ipv4": "ipv4Value",
  "ipv6": "ipv6Value"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "status": 1
}
```

</details>

**SDK**

```python
client.vms.create_interface(id, vmid, bridge=...)
```
```javascript
await client.vms.createInterface(id, vmid, { bridge: ... });
```
```php
$client->vms->createInterface($id, $vmid, ['bridge' => ...]);
```

---

### `vms.removeInterface`

`DELETE /service/{id}/vms/{vmid}/interfaces/{iface}` — Bearer token · spec only

**Remove Network Interface**

Remove network interface from VM

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |
| `iface` | path | string | yes | Interface name or id to remove |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.remove_interface(id, vmid, iface)
```
```javascript
await client.vms.removeInterface(id, vmid, iface);
```
```php
$client->vms->removeInterface($id, $vmid, $iface);
```

---

### `vms.getInterface`

`GET /service/{id}/vms/{vmid}/interfaces/{iface}` — Bearer token · verified live

**Get Network Interfaces**

Get network Interface details

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |
| `iface` | path | string | yes | Interface name or id, ie '0' or 'net0' |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[]
```

</details>

**SDK**

```python
client.vms.get_interface(id, vmid, iface)
```
```javascript
await client.vms.getInterface(id, vmid, iface);
```
```php
$client->vms->getInterface($id, $vmid, $iface);
```

---

### `vms.updateInterface`

`PUT /service/{id}/vms/{vmid}/interfaces/{iface}` — Bearer token · spec only

**Update Network Interface**

Update network interface details

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |
| `iface` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `iface` | integer | no | Interface number |
| `firewall` | integer | no | Enable or disable firewall (may require specific permissions) |
| `ipv4` | array | no | List of IP v4 IDs |
| `ipv6` | array | no | List of IP v6 IDs |

```json
{
  "iface": "ifaceValue",
  "firewall": "firewallValue",
  "ipv4": "ipv4Value",
  "ipv6": "ipv6Value"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.update_interface(id, vmid, iface, iface=...)
```
```javascript
await client.vms.updateInterface(id, vmid, iface, { iface: ... });
```
```php
$client->vms->updateInterface($id, $vmid, $iface, ['iface' => ...]);
```

---

### `vms.listIpPools`

`GET /service/{id}/vms/{vmid}/ippool` — Bearer token · verified live

**List IP Pools**

List IP pools for a specific interface or network bridge

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `iface` | query | integer | no | Interface number [optional] |
| `bridge` | query | string | no | Bridge name [optional, ignored if interface provided] |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[
 {
  "id": "public",
  "name": "Public IP(s)",
  "type": "ipv4",
  "vlan_id": "41",
  "firstip": "203.0.113.10",
  "mask": "/24",
  "gateway": "203.0.113.10"
 },
 {
  "id": "public",
  "name": "Public IP(s)",
  "type": "ipv6",
  "vlan_id": "42",
  "firstip": "2001:db8::1::",
  "mask": "/64",
  "gateway": "2001:db8::1"
 }
]
```

</details>

**SDK**

```python
client.vms.list_ip_pools(id, vmid)
```
```javascript
await client.vms.listIpPools(id, vmid);
```
```php
$client->vms->listIpPools($id, $vmid);
```

---

### `vms.allocateIps`

`POST /service/{id}/vms/{vmid}/ippool/{pool}` — Bearer token · spec only

**Allocate IPs**

Allocate new IP for network interface.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |
| `pool` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `pool` | string | no | List ID to allocate new IP from |
| `type` | string | no | ipv4 or ipv6 |
| `iface` | integer | no | Interface number |
| `bridge` | string | no | Bridge name [optional, ignored if interface provided] |
| `number` | integer | no | Number of IPs to allocate |

```json
{
  "pool": "poolValue",
  "type": "typeValue",
  "iface": "ifaceValue",
  "bridge": "bridgeValue",
  "number": "numberValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.allocate_ips(id, vmid, pool, pool=...)
```
```javascript
await client.vms.allocateIps(id, vmid, pool, { pool: ... });
```
```php
$client->vms->allocateIps($id, $vmid, $pool, ['pool' => ...]);
```

---

### `vms.listIps`

`GET /service/{id}/vms/{vmid}/ips` — Bearer token · verified live

**List IPs**

List virtual machine IPs

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `type` | query | string | no | ipv4 or ipv6 |
| `iface` | query | integer | no | Interface number [optional] |
| `bridge` | query | string | no | Bridge name [optional, ignored if interface provided] |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[
 {
  "id": 930001,
  "interface": 0,
  "mac": "2001:db8::1",
  "ip": "203.0.113.10",
  "wanip": "",
  "mask": "/24",
  "network": "203.0.113.10",
  "gateway": "203.0.113.10",
  "main": 1,
  "type": "ipv4"
 },
 {
  "id": 27930,
  "interface": 0,
  "mac": "2001:db8::1",
  "ip": "203.0.113.10",
  "wanip": "",
  "mask": "/64",
  "network": "2001:db8::1",
  "gateway": "2001:db8::1",
  "main": 1,
  "type": "ipv6"
 }
]
```

</details>

**SDK**

```python
client.vms.list_ips(id, vmid)
```
```javascript
await client.vms.listIps(id, vmid);
```
```php
$client->vms->listIps($id, $vmid);
```

---

### `vms.reboot`

`POST /service/{id}/vms/{vmid}/reboot` — Bearer token · spec only

**Reboot VM**

Reboot virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `vmid` | string | no | Virtual server id |

```json
{
  "vmid": "vmidValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.reboot(id, vmid, vmid=...)
```
```javascript
await client.vms.reboot(id, vmid, { vmid: ... });
```
```php
$client->vms->reboot($id, $vmid, ['vmid' => ...]);
```

---

### `vms.rebuild`

`POST /service/{id}/vms/{vmid}/rebuild` — Bearer token · spec only

**Rebuild VM**

Rebuild server, you can get list of templates supported by this server
using '''/service/$id/templates'''

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `template` | string | no | Template ID |

```json
{
  "template": "templateValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.rebuild(id, vmid, template=...)
```
```javascript
await client.vms.rebuild(id, vmid, { template: ... });
```
```php
$client->vms->rebuild($id, $vmid, ['template' => ...]);
```

---

### `vms.reset`

`POST /service/{id}/vms/{vmid}/reset` — Bearer token · verified live

**Reset VM**

Reset virtual server power

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `vmid` | string | no | Virtual server id |

```json
{
  "vmid": "vmidValue"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "status": true
}
```

</details>

**SDK**

```python
client.vms.reset(id, vmid, vmid=...)
```
```javascript
await client.vms.reset(id, vmid, { vmid: ... });
```
```php
$client->vms->reset($id, $vmid, ['vmid' => ...]);
```

---

### `vms.resetRootPassword`

`POST /service/{id}/vms/{vmid}/resetpwd` — Bearer token · verified live

**Reset Root Password VM**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "status": true
}
```

</details>

**SDK**

```python
client.vms.reset_root_password(id, vmid)
```
```javascript
await client.vms.resetRootPassword(id, vmid);
```
```php
$client->vms->resetRootPassword($id, $vmid);
```

---

### `vms.shutdown`

`POST /service/{id}/vms/{vmid}/shutdown` — Bearer token · verified live

**Shutdown VM**

Perform graceful shutdown

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `vmid` | string | no | Virtual server id |

```json
{
  "vmid": "vmidValue"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "status": true
}
```

</details>

**SDK**

```python
client.vms.shutdown(id, vmid, vmid=...)
```
```javascript
await client.vms.shutdown(id, vmid, { vmid: ... });
```
```php
$client->vms->shutdown($id, $vmid, ['vmid' => ...]);
```

---

### `vms.listSnapshots`

`GET /service/{id}/vms/{vmid}/snapshots` — Bearer token · verified live

**VM List Snapshot**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "snapshots": null,
 "limit": {
  "unlimited": false,
  "can_create": true,
  "num_left": 1
 }
}
```

</details>

**SDK**

```python
client.vms.list_snapshots(id, vmid)
```
```javascript
await client.vms.listSnapshots(id, vmid);
```
```php
$client->vms->listSnapshots($id, $vmid);
```

---
