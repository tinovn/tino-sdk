# Cloud instances / virtual machines (part 1/3)

SDK namespace: `client.vms` (Python) · `client.vms` (Node.js, PHP).

13 operation(s) in this chapter, 8 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/service/{id}/vms` | [`list`](#vmslist) | Bearer |
| `POST` | `/service/{id}/vms` | [`create`](#vmscreate) | Bearer |
| `DELETE` | `/service/{id}/vms/{vmid}` | [`destroy`](#vmsdestroy) | Bearer |
| `GET` | `/service/{id}/vms/{vmid}` | [`get`](#vmsget) | Bearer |
| `PUT` | `/service/{id}/vms/{vmid}` | [`resize`](#vmsresize) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/addsshkey` | [`setSshKeys`](#vmssetsshkeys) | Bearer |
| `DELETE` | `/service/{id}/vms/{vmid}/backup/{backup_id}/delete` | [`deleteBackup`](#vmsdeletebackup) | Bearer |
| `GET` | `/service/{id}/vms/{vmid}/backups` | [`listBackups`](#vmslistbackups) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/backups/create` | [`createBackup`](#vmscreatebackup) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/backups/{backup_id}/restore` | [`restoreBackup`](#vmsrestorebackup) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/console` | [`openConsole`](#vmsopenconsole) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/hostname` | [`changeHostname`](#vmschangehostname) | Bearer |
| `GET` | `/service/{id}/vms/{vmid}/interfaces` | [`listInterfaces`](#vmslistinterfaces) | Bearer |

---

### `vms.list`

`GET /service/{id}/vms` — Bearer token · verified live

**List VMs**

List virtual servers

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "vms": {
  "600001": {
   "id": 600001,
   "ha": false,
   "built": true,
   "locked": false,
   "power": true,
   "status": "running",
   "status_lang": "vm_state_running",
   "password": "<redacted>",
   "sshkeys": [
    "ssh-ed25519 AAAA<public-key> user@example.com"
   ],
   "username": "root",
   "memory": 1024,
   "disk": 20,
   "swap": null,
   "additional_storage": [],
   "uptime": 639603,
   "template_id": "template-vm:321/321/base-321-disk-0.raw",
   "template_name": "Ubuntu 26.04",
   "template_data": [],
   "replication": false,
   "cloudinit": true,
   "…": "14 more key(s)"
  }
 }
}
```

</details>

**SDK**

```python
client.vms.list(id)
```
```javascript
await client.vms.list(id);
```
```php
$client->vms->list($id);
```

---

### `vms.create`

`POST /service/{id}/vms` — Bearer token · spec only

**Create VM**

Add new virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `label` | string | no | VM label |
| `template` | string | no | Template ID |
| `memory` | string | no | Amount of RAM memory in MB |
| `cpu` | string | no | Amount of CPU cores |
| `disk` | string | no | Disk Space in GB |
| `interface` | array | no | Interface configuration |

```json
{
  "label": "labelValue",
  "template": "templateValue",
  "memory": "memoryValue",
  "cpu": "cpuValue",
  "disk": "diskValue",
  "interface": "interfaceValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.create(id, label=...)
```
```javascript
await client.vms.create(id, { label: ... });
```
```php
$client->vms->create($id, ['label' => ...]);
```

---

### `vms.destroy`

`DELETE /service/{id}/vms/{vmid}` — Bearer token · spec only

**Destroy VM**

Remove virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | Virtual server id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.destroy(id, vmid)
```
```javascript
await client.vms.destroy(id, vmid);
```
```php
$client->vms->destroy($id, $vmid);
```

---

### `vms.get`

`GET /service/{id}/vms/{vmid}` — Bearer token · verified live

**Get VM Details**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | Virtual server id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "vm": {
  "id": 600001,
  "ha": false,
  "built": true,
  "locked": false,
  "power": true,
  "status": "running",
  "status_lang": "vm_state_running",
  "password": "<redacted>",
  "sshkeys": [
   "ssh-ed25519 AAAA<public-key> user@example.com"
  ],
  "username": "root",
  "memory": 1024,
  "disk": 20,
  "swap": null,
  "additional_storage": [],
  "uptime": 639639,
  "template_id": "template-vm:321/321/base-321-disk-0.raw",
  "template_name": "Ubuntu 26.04",
  "template_data": [],
  "replication": false,
  "cloudinit": true,
  "…": "14 more key(s)"
 }
}
```

</details>

**SDK**

```python
client.vms.get(id, vmid)
```
```javascript
await client.vms.get(id, vmid);
```
```php
$client->vms->get($id, $vmid);
```

---

### `vms.resize`

`PUT /service/{id}/vms/{vmid}` — Bearer token · spec only

**Resize VM**

Edit a virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `vmid` | string | no | Virtual server id |
| `memory` | string | no | Amount of RAM in MB |
| `cpu` | string | no | Amount of CPU cores |

```json
{
  "vmid": "vmidValue",
  "memory": "memoryValue",
  "cpu": "cpuValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.resize(id, vmid, vmid=...)
```
```javascript
await client.vms.resize(id, vmid, { vmid: ... });
```
```php
$client->vms->resize($id, $vmid, ['vmid' => ...]);
```

---

### `vms.setSshKeys`

`POST /service/{id}/vms/{vmid}/addsshkey` — Bearer token · spec only

**Change SSHKEY**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `keys` | array | yes | SSK Key ID |

```json
{
  "keys": []
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.set_ssh_keys(id, vmid, keys=...)
```
```javascript
await client.vms.setSshKeys(id, vmid, { keys: ... });
```
```php
$client->vms->setSshKeys($id, $vmid, ['keys' => ...]);
```

---

### `vms.deleteBackup`

`DELETE /service/{id}/vms/{vmid}/backup/{backup_id}/delete` — Bearer token · verified live

**VM Delete Backup**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |
| `backup_id` | path | integer | yes | Backup VM id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "backups": null,
 "limit": null,
 "info": [
  "bckp_delete_info"
 ]
}
```

</details>

**SDK**

```python
client.vms.delete_backup(id, vmid, backup_id)
```
```javascript
await client.vms.deleteBackup(id, vmid, backupId);
```
```php
$client->vms->deleteBackup($id, $vmid, $backupId);
```

---

### `vms.listBackups`

`GET /service/{id}/vms/{vmid}/backups` — Bearer token · verified live

**VM List Backup**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "backups": [
  {
   "vmid": 600001,
   "date": "2026-08-02 2001:db8::1",
   "size": 21474838049,
   "id": 900001,
   "status": "created",
   "delete_warning": "",
   "can": {
    "restore": true,
    "filerestore": true,
    "delete": false
   }
  }
 ],
 "limit": {
  "unlimited": false,
  "can_create": true,
  "size_left": -1,
  "num_left": 1,
  "size_total": -1,
  "num_total": "2",
  "size_used": 0,
  "size_percent": 100
 }
}
```

</details>

**SDK**

```python
client.vms.list_backups(id, vmid)
```
```javascript
await client.vms.listBackups(id, vmid);
```
```php
$client->vms->listBackups($id, $vmid);
```

---

### `vms.createBackup`

`POST /service/{id}/vms/{vmid}/backups/create` — Bearer token · verified live

**VM Create Backup**

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
 "success": true,
 "info": [
  "bckp_create_info"
 ]
}
```

</details>

**SDK**

```python
client.vms.create_backup(id, vmid)
```
```javascript
await client.vms.createBackup(id, vmid);
```
```php
$client->vms->createBackup($id, $vmid);
```

---

### `vms.restoreBackup`

`POST /service/{id}/vms/{vmid}/backups/{backup_id}/restore` — Bearer token · spec only

**VM Restore Backup**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |
| `backup_id` | path | integer | yes | Backup VM id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.restore_backup(id, vmid, backup_id)
```
```javascript
await client.vms.restoreBackup(id, vmid, backupId);
```
```php
$client->vms->restoreBackup($id, $vmid, $backupId);
```

---

### `vms.openConsole`

`POST /service/{id}/vms/{vmid}/console` — Bearer token · verified live

**console VM**

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
 "status": true,
 "console": "qRMLlfK/Pxqo03/UY/qCxVlTNzB5V2JqQ1MydmNvc0t6WWlHSkwrK1dZbVJsTnQrUVZlRkhjV1BrRm9wM3FOVjE2L016bXhjYU16YzBlT3FZMWVrUHQydUdwMmxMOWVTSUJ1VzA1YW4wV0x1Y2VGQVkyQnVORnZVemhmWlVaZzZ0VlhiMnJoYW9RVTZ6b0wrUDBwaXJjVWdNOVBYSWFHTUp2WEI4Y2UvNTZmU1ZiKyt4UVZhcnpnb2NUcjdnWmFkcGQ0ZjlpWHMrU090VEJwM3h2eWNDd1I3aUNGSDI0Q1hl…"
}
```

</details>

**SDK**

```python
client.vms.open_console(id, vmid)
```
```javascript
await client.vms.openConsole(id, vmid);
```
```php
$client->vms->openConsole($id, $vmid);
```

---

### `vms.changeHostname`

`POST /service/{id}/vms/{vmid}/hostname` — Bearer token · verified live

**Change Hostname VM**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `server_name` | string | yes | Virtual server name |

```json
{
  "server_name": "<server_name>"
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
client.vms.change_hostname(id, vmid, server_name=...)
```
```javascript
await client.vms.changeHostname(id, vmid, { server_name: ... });
```
```php
$client->vms->changeHostname($id, $vmid, ['server_name' => ...]);
```

---

### `vms.listInterfaces`

`GET /service/{id}/vms/{vmid}/interfaces` — Bearer token · verified live

**List VM Network Interfaces**

Get network interfaces assigned to virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |
| `vmid` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[
 {
  "id": 0,
  "name": "net0",
  "model": "virtio",
  "mac": "2001:db8::1",
  "firewall": "1",
  "ip": [
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
  ],
  "bridge": "vmbr0",
  "vlan": "136",
  "link_down": null,
  "can_edit": true,
  "can_remove": false
 }
]
```

</details>

**SDK**

```python
client.vms.list_interfaces(id, vmid)
```
```javascript
await client.vms.listInterfaces(id, vmid);
```
```php
$client->vms->listInterfaces($id, $vmid);
```

---
