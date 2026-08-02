# Services (hosting, VPS, ...) (part 3/3)

SDK namespace: `client.services` (Python) · `client.services` (Node.js, PHP).

2 operation(s) in this chapter, 2 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/services/active` | [`listActive`](#serviceslistactive) | Bearer |
| `GET` | `/services/{cid}` | [`listByCategory`](#serviceslistbycategory) | Bearer |

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
