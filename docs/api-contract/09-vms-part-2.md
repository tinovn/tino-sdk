# Cloud instances / virtual machines (part 2/3)

SDK namespace: `client.vms` (Python) · `client.vms` (Node.js, PHP).

15 operation(s) in this chapter, 4 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
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
| `POST` | `/service/{id}/vms/{vmid}/snapshots/create` | [`createSnapshot`](#vmscreatesnapshot) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/snapshots/{snapshot_id}/restore` | [`restoreSnapshot`](#vmsrestoresnapshot) | Bearer |
| `DELETE` | `/service/{id}/vms/{vmid}/snapshots/{snapshot_name}/delete` | [`deleteSnapshot`](#vmsdeletesnapshot) | Bearer |
| `GET` | `/service/{id}/vms/{vmid}/snapshotschedule` | [`listSnapshotSchedules`](#vmslistsnapshotschedules) | Bearer |

---

### `vms.getInterface`

`GET /service/{id}/vms/{vmid}/interfaces/{iface}` — Bearer token · spec only

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
  "firstip": "2405:2840:0:137::",
  "mask": "/64",
  "gateway": "2405:2840:0:137::1"
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
  "mac": "A0:35:D1:3B:C3:A8",
  "ip": "203.0.113.10",
  "wanip": "",
  "mask": "/24",
  "network": "203.0.113.10/24",
  "gateway": "203.0.113.10",
  "main": 1,
  "type": "ipv4"
 },
 {
  "id": 27930,
  "interface": 0,
  "mac": "A0:35:D1:3B:C3:A8",
  "ip": "203.0.113.10",
  "wanip": "",
  "mask": "/64",
  "network": "2405:2840:0:136::/64",
  "gateway": "2405:2840:0:136::1",
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

`POST /service/{id}/vms/{vmid}/reset` — Bearer token · spec only

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

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

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

`POST /service/{id}/vms/{vmid}/resetpwd` — Bearer token · spec only

**Reset Root Password VM**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

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

`POST /service/{id}/vms/{vmid}/shutdown` — Bearer token · spec only

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

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

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

### `vms.createSnapshot`

`POST /service/{id}/vms/{vmid}/snapshots/create` — Bearer token · spec only

**VM Create Snapshot**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |
| `description` | path | string | yes | description |
| `vmstate` | path | integer | yes | vmstate |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.create_snapshot(id, vmid, description, vmstate)
```
```javascript
await client.vms.createSnapshot(id, vmid, description, vmstate);
```
```php
$client->vms->createSnapshot($id, $vmid, $description, $vmstate);
```

---

### `vms.restoreSnapshot`

`POST /service/{id}/vms/{vmid}/snapshots/{snapshot_id}/restore` — Bearer token · spec only

**VM Restore Snapshot**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |
| `snapshot_id` | path | integer | yes | Snapshot VM id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.restore_snapshot(id, vmid, snapshot_id)
```
```javascript
await client.vms.restoreSnapshot(id, vmid, snapshotId);
```
```php
$client->vms->restoreSnapshot($id, $vmid, $snapshotId);
```

---

### `vms.deleteSnapshot`

`DELETE /service/{id}/vms/{vmid}/snapshots/{snapshot_name}/delete` — Bearer token · spec only

**VM Delete Snapshot**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |
| `snapshot_name` | path | string | yes | Snapshot VM id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.delete_snapshot(id, vmid, snapshot_name)
```
```javascript
await client.vms.deleteSnapshot(id, vmid, snapshotName);
```
```php
$client->vms->deleteSnapshot($id, $vmid, $snapshotName);
```

---

### `vms.listSnapshotSchedules`

`GET /service/{id}/vms/{vmid}/snapshotschedule` — Bearer token · verified live

**VM snapshot schedule**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "schedules": [],
 "limit": 1
}
```

</details>

**SDK**

```python
client.vms.list_snapshot_schedules(id, vmid)
```
```javascript
await client.vms.listSnapshotSchedules(id, vmid);
```
```php
$client->vms->listSnapshotSchedules($id, $vmid);
```

---
