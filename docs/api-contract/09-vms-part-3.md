# Cloud instances / virtual machines (part 3/3)

SDK namespace: `client.vms` (Python) · `client.vms` (Node.js, PHP).

5 operation(s) in this chapter, 1 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `POST` | `/service/{id}/vms/{vmid}/snapshotschedule/create` | [`createSnapshotSchedule`](#vmscreatesnapshotschedule) | Bearer |
| `DELETE` | `/service/{id}/vms/{vmid}/snapshotschedule/{schedule_id}/delete` | [`deleteSnapshotSchedule`](#vmsdeletesnapshotschedule) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/start` | [`start`](#vmsstart) | Bearer |
| `POST` | `/service/{id}/vms/{vmid}/stop` | [`stop`](#vmsstop) | Bearer |
| `GET` | `/service/{id}/vms/{vmid}/usage` | [`getUsage`](#vmsgetusage) | Bearer |

---

### `vms.createSnapshotSchedule`

`POST /service/{id}/vms/{vmid}/snapshotschedule/create` — Bearer token · spec only

**VM snapshot schedule Create**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |
| `dow` | path | string | yes | Array thứ |
| `hour` | path | string | yes | Giờ |
| `min` | path | string | yes | Phút |
| `vmstate` | path | integer | yes | vmstate |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.create_snapshot_schedule(id, vmid, dow, hour, min, vmstate)
```
```javascript
await client.vms.createSnapshotSchedule(id, vmid, dow, hour, min, vmstate);
```
```php
$client->vms->createSnapshotSchedule($id, $vmid, $dow, $hour, $min, $vmstate);
```

---

### `vms.deleteSnapshotSchedule`

`DELETE /service/{id}/vms/{vmid}/snapshotschedule/{schedule_id}/delete` — Bearer token · spec only

**VM snapshot schedule delete**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |
| `schedule_id` | path | string | yes | — |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.vms.delete_snapshot_schedule(id, vmid, schedule_id)
```
```javascript
await client.vms.deleteSnapshotSchedule(id, vmid, scheduleId);
```
```php
$client->vms->deleteSnapshotSchedule($id, $vmid, $scheduleId);
```

---

### `vms.start`

`POST /service/{id}/vms/{vmid}/start` — Bearer token · spec only

**Start VM**

Start virtual server

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
client.vms.start(id, vmid, vmid=...)
```
```javascript
await client.vms.start(id, vmid, { vmid: ... });
```
```php
$client->vms->start($id, $vmid, ['vmid' => ...]);
```

---

### `vms.stop`

`POST /service/{id}/vms/{vmid}/stop` — Bearer token · spec only

**Stop VM**

Stop virtual server

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
client.vms.stop(id, vmid, vmid=...)
```
```javascript
await client.vms.stop(id, vmid, { vmid: ... });
```
```php
$client->vms->stop($id, $vmid, ['vmid' => ...]);
```

---

### `vms.getUsage`

`GET /service/{id}/vms/{vmid}/usage` — Bearer token · verified live

**Get VM usage**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |
| `vmid` | path | string | yes | Virtual server id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "last": {
  "maxmem": 1073741824,
  "time": 1785679440,
  "diskread": 0,
  "maxcpu": 1,
  "netout": 250.616666666667,
  "cpu": 1.83,
  "maxdisk": 21474836480,
  "mem": 596055608,
  "disk": 0,
  "netin": 966.106666666666,
  "diskwrite": 20964.6933333333,
  "date_time": "2026-08-02 21:04:00"
 },
 "usage": [
  {
   "diskwrite": 12349.44,
   "netin": 934.313333333333,
   "mem": 596055608,
   "disk": 0,
   "maxdisk": 21474836480,
   "diskread": 0,
   "maxcpu": 1,
   "netout": 274.256666666667,
   "cpu": 1.24,
   "time": 1785675300,
   "maxmem": 1073741824,
   "date_time": "2026-08-02 19:55:00"
  },
  {
   "diskwrite": 23278.9333333333,
   "mem": 596055608,
   "disk": 0,
   "netin": 991.83,
   "diskread": 0,
   "maxcpu": 1,
   "netout": 303.44,
   "cpu": 1.39,
   "maxdisk": 21474836480,
   "maxmem": 1073741824,
   "time": 1785675360,
   "date_time": "2026-08-02 19:56:00"
  },
  "… 68 more item(s)"
  … 2 more line(s)
```

</details>

**SDK**

```python
client.vms.get_usage(id, vmid)
```
```javascript
await client.vms.getUsage(id, vmid);
```
```php
$client->vms->getUsage($id, $vmid);
```

---
