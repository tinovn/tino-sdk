# Proxmox2 usage monitor

SDK namespace: `client.usage_monitor` (Python) · `client.usageMonitor` (Node.js, PHP).

5 operation(s) in this chapter, 1 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/usage-monitor/account/{id}` | [`getAccountUsage`](#usagemonitorgetaccountusage) | Bearer |
| `GET` | `/usage-monitor/nodes/{server_id}` | [`getNodeStatus`](#usagemonitorgetnodestatus) | Bearer |
| `POST` | `/usage-monitor/overage` | [`listOverage`](#usagemonitorlistoverage) | Bearer |
| `GET` | `/usage-monitor/products` | [`listProducts`](#usagemonitorlistproducts) | Bearer |
| `POST` | `/usage-monitor/scan` | [`scan`](#usagemonitorscan) | Bearer |

---

### `usageMonitor.getAccountUsage`

`GET /usage-monitor/account/{id}` — Bearer token · spec only

**Get usage for a specific account**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "error": [
  "internal_error_0"
 ]
}
```

</details>

**SDK**

```python
client.usage_monitor.get_account_usage(id)
```
```javascript
await client.usageMonitor.getAccountUsage(id);
```
```php
$client->usageMonitor->getAccountUsage($id);
```

---

### `usageMonitor.getNodeStatus`

`GET /usage-monitor/nodes/{server_id}` — Bearer token · spec only

**Get node status for a server (via Proxmox2 module)**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `server_id` | path | string | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "error": [
  "internal_error_0"
 ]
}
```

</details>

**SDK**

```python
client.usage_monitor.get_node_status(server_id)
```
```javascript
await client.usageMonitor.getNodeStatus(serverId);
```
```php
$client->usageMonitor->getNodeStatus($serverId);
```

---

### `usageMonitor.listOverage`

`POST /usage-monitor/overage` — Bearer token · spec only

**Get overage list with custom thresholds**

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.usage_monitor.list_overage()
```
```javascript
await client.usageMonitor.listOverage();
```
```php
$client->usageMonitor->listOverage();
```

---

### `usageMonitor.listProducts`

`GET /usage-monitor/products` — Bearer token · verified live

**List available Proxmox2 products**

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "error": [
  "internal_error_0"
 ]
}
```

</details>

**SDK**

```python
client.usage_monitor.list_products()
```
```javascript
await client.usageMonitor.listProducts();
```
```php
$client->usageMonitor->listProducts();
```

---

### `usageMonitor.scan`

`POST /usage-monitor/scan` — Bearer token · spec only

**Scan by product IDs and return full usage summary**

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.usage_monitor.scan()
```
```javascript
await client.usageMonitor.scan();
```
```php
$client->usageMonitor->scan();
```

---
