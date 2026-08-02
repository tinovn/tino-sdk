# cPanel service actions

SDK namespace: `client.cpanel` (Python) · `client.cpanel` (Node.js, PHP).

7 operation(s) in this chapter, 6 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `POST` | `/service/cpanel2/{id}/changedomain` | [`changePrimaryDomain`](#cpanelchangeprimarydomain) | Bearer |
| `GET` | `/service/cpanel2/{id}/changepasss` | [`changePassword`](#cpanelchangepassword) | Bearer |
| `GET` | `/service/cpanel2/{id}/login` | [`getLoginLink`](#cpanelgetloginlink) | Bearer |
| `GET` | `/service/cpanel2/{id}/phpmyadminlogin` | [`getPhpMyAdminLink`](#cpanelgetphpmyadminlink) | Bearer |
| `POST` | `/service/cpanel2/{id}/resetacount` | [`resetAccount`](#cpanelresetaccount) | Bearer |
| `GET` | `/service/cpanel2/{id}/statistics` | [`getStatistics`](#cpanelgetstatistics) | Bearer |
| `POST` | `/service/cpanel2/{id}/unblock` | [`unblockIp`](#cpanelunblockip) | Bearer |

---

### `cpanel.changePrimaryDomain`

`POST /service/cpanel2/{id}/changedomain` — Bearer token · verified live

**Change Domain cPanel**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `domain` | string | yes | — |

```json
{
  "domain": "<domain>"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "info": [
  "cpanel_cpd_domain_change"
 ]
}
```

</details>

**SDK**

```python
client.cpanel.change_primary_domain(id, domain=...)
```
```javascript
await client.cpanel.changePrimaryDomain(id, { domain: ... });
```
```php
$client->cpanel->changePrimaryDomain($id, ['domain' => ...]);
```

---

### `cpanel.changePassword`

`GET /service/cpanel2/{id}/changepasss` — Bearer token · verified live

**Change Passs cPanel**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "info": [
  "func_scheduled_for_execute"
 ]
}
```

</details>

**SDK**

```python
client.cpanel.change_password(id)
```
```javascript
await client.cpanel.changePassword(id);
```
```php
$client->cpanel->changePassword($id);
```

---

### `cpanel.getLoginLink`

`GET /service/cpanel2/{id}/login` — Bearer token · verified live

**Get cPanel link login**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "token": "<redacted>",
 "expiry_time": 1785679554
}
```

</details>

**SDK**

```python
client.cpanel.get_login_link(id)
```
```javascript
await client.cpanel.getLoginLink(id);
```
```php
$client->cpanel->getLoginLink($id);
```

---

### `cpanel.getPhpMyAdminLink`

`GET /service/cpanel2/{id}/phpmyadminlogin` — Bearer token · verified live

**Get cPanel phpmyadmin login**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "error": [
  "unknown error"
 ]
}
```

</details>

**SDK**

```python
client.cpanel.get_php_my_admin_link(id)
```
```javascript
await client.cpanel.getPhpMyAdminLink(id);
```
```php
$client->cpanel->getPhpMyAdminLink($id);
```

---

### `cpanel.resetAccount`

`POST /service/cpanel2/{id}/resetacount` — Bearer token · verified live

**Reset Acount cPanel**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "info": [
  "cpanel_reset_success"
 ]
}
```

</details>

**SDK**

```python
client.cpanel.reset_account(id)
```
```javascript
await client.cpanel.resetAccount(id);
```
```php
$client->cpanel->resetAccount($id);
```

---

### `cpanel.getStatistics`

`GET /service/cpanel2/{id}/statistics` — Bearer token · verified live

**Get cPanel statistics**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "statistics": {
  "bandwidthusage": {
   "is_maxed": 0,
   "module": "Stats",
   "item": "Monthly Bandwidth Transfer",
   "role": "WebServer",
   "maxed_phrase": "You have transferred your maximum allotment of data ([format_bytes,_1]) for this month.",
   "percent5": 0,
   "phrase": "Monthly Bandwidth Transfer",
   "normalized": 1,
   "_max": "unlimited",
   "name": "bandwidthusage",
   "near_limit_phrase": "You have transferred [format_bytes,_1] of your [format_bytes,_2] data allotment for this month.",
   "max": "unlimited",
   "percent20": 0,
   "feature": "bandwidth",
   "id": "bandwidthusage",
   "percent": 0,
   "_maxed": 0,
   "_count": "0.00",
   "zeroisunlimited": 1,
   "count": "0 bytes",
   "…": "2 more key(s)"
  },
  "diskusage": {
   "near_limit_phrase": "You are using [format_bytes,_1] of the [format_bytes,_2] of storage available to you.",
   "max": "5 GB",
   "percent10": 0,
   "name": "diskusage",
   "_max": "5120",
   "normalized": 1,
   "phrase": "Disk Space Usage",
   "percent5": 0,
   "count": "0 bytes",
   "units": "MB",
   "_count": "0",
   "zeroisunlimited": 1,
   "item": "Disk Space Usage",
   "maxed_phrase": "You are using your maximum storage allotment, [format_bytes,_1].",
   "percent": 0,
   "_maxed": 0,
   "is_maxed": 0,
   "percent20": 0,
   "module": "Quota",
  … 196 more line(s)
```

</details>

**SDK**

```python
client.cpanel.get_statistics(id)
```
```javascript
await client.cpanel.getStatistics(id);
```
```php
$client->cpanel->getStatistics($id);
```

---

### `cpanel.unblockIp`

`POST /service/cpanel2/{id}/unblock` — Bearer token · spec only

**Get cPanel unblock ip**

Get the details of a particular virtual server

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.cpanel.unblock_ip(id)
```
```javascript
await client.cpanel.unblockIp(id);
```
```php
$client->cpanel->unblockIp($id);
```

---
