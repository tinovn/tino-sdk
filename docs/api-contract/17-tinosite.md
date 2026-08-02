# TinoSite (managed WordPress)

SDK namespace: `client.tinosite` (Python) · `client.tinosite` (Node.js, PHP).

10 operation(s) in this chapter, 10 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `POST` | `/tinosite/{id}/autologin` | [`autoLogin`](#tinositeautologin) | Bearer |
| `POST` | `/tinosite/{id}/backups` | [`backup`](#tinositebackup) | Bearer |
| `POST` | `/tinosite/{id}/domainpointers` | [`domainPointerAction`](#tinositedomainpointeraction) | Bearer |
| `GET` | `/tinosite/{id}/metrics` | [`getMetrics`](#tinositegetmetrics) | Bearer |
| `GET` | `/tinosite/{id}/plugins` | [`listPlugins`](#tinositelistplugins) | Bearer |
| `POST` | `/tinosite/{id}/sslcerts` | [`sslCertificateAction`](#tinositesslcertificateaction) | Bearer |
| `POST` | `/tinosite/{id}/sslcerts/onoff` | [`toggleSslCertificate`](#tinositetogglesslcertificate) | Bearer |
| `GET` | `/tinosite/{id}/themes` | [`listThemes`](#tinositelistthemes) | Bearer |
| `GET` | `/tinosite/{id}/users` | [`listUsers`](#tinositelistusers) | Bearer |
| `POST` | `/tinosite/{id}/users` | [`createUser`](#tinositecreateuser) | Bearer |

---

### `tinosite.autoLogin`

`POST /tinosite/{id}/autologin` — Bearer token · verified live

**Auto Login**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `email` | string | yes | — |

```json
{
  "email": "<email>"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "service_id": "100001",
 "login_url": null
}
```

</details>

**SDK**

```python
client.tinosite.auto_login(id, email=...)
```
```javascript
await client.tinosite.autoLogin(id, { email: ... });
```
```php
$client->tinosite->autoLogin($id, ['email' => ...]);
```

---

### `tinosite.backup`

`POST /tinosite/{id}/backups` — Bearer token · verified live

**Backups**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "service_id": "100001",
 "backups": null
}
```

</details>

**SDK**

```python
client.tinosite.backup(id)
```
```javascript
await client.tinosite.backup(id);
```
```php
$client->tinosite->backup($id);
```

---

### `tinosite.domainPointerAction`

`POST /tinosite/{id}/domainpointers` — Bearer token · verified live

**Domain Pointer**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "service_id": "100001",
 "pointers": null
}
```

</details>

**SDK**

```python
client.tinosite.domain_pointer_action(id)
```
```javascript
await client.tinosite.domainPointerAction(id);
```
```php
$client->tinosite->domainPointerAction($id);
```

---

### `tinosite.getMetrics`

`GET /tinosite/{id}/metrics` — Bearer token · verified live

**Metrics**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "service_id": "100001",
 "metrics": null,
 "bandwidths": null,
 "infostat": null
}
```

</details>

**SDK**

```python
client.tinosite.get_metrics(id)
```
```javascript
await client.tinosite.getMetrics(id);
```
```php
$client->tinosite->getMetrics($id);
```

---

### `tinosite.listPlugins`

`GET /tinosite/{id}/plugins` — Bearer token · verified live

**List plugins**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "service_id": "100001",
 "list": null
}
```

</details>

**SDK**

```python
client.tinosite.list_plugins(id)
```
```javascript
await client.tinosite.listPlugins(id);
```
```php
$client->tinosite->listPlugins($id);
```

---

### `tinosite.sslCertificateAction`

`POST /tinosite/{id}/sslcerts` — Bearer token · verified live

**Action SSL**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "service_id": "100001",
 "certs": null
}
```

</details>

**SDK**

```python
client.tinosite.ssl_certificate_action(id)
```
```javascript
await client.tinosite.sslCertificateAction(id);
```
```php
$client->tinosite->sslCertificateAction($id);
```

---

### `tinosite.toggleSslCertificate`

`POST /tinosite/{id}/sslcerts/onoff` — Bearer token · verified live

**on/off ssl certs**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "service_id": "100001",
 "certs": null
}
```

</details>

**SDK**

```python
client.tinosite.toggle_ssl_certificate(id)
```
```javascript
await client.tinosite.toggleSslCertificate(id);
```
```php
$client->tinosite->toggleSslCertificate($id);
```

---

### `tinosite.listThemes`

`GET /tinosite/{id}/themes` — Bearer token · verified live

**List themes**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "service_id": "100001",
 "list": null
}
```

</details>

**SDK**

```python
client.tinosite.list_themes(id)
```
```javascript
await client.tinosite.listThemes(id);
```
```php
$client->tinosite->listThemes($id);
```

---

### `tinosite.listUsers`

`GET /tinosite/{id}/users` — Bearer token · verified live

**List User**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "service_id": "100001",
 "list": null
}
```

</details>

**SDK**

```python
client.tinosite.list_users(id)
```
```javascript
await client.tinosite.listUsers(id);
```
```php
$client->tinosite->listUsers($id);
```

---

### `tinosite.createUser`

`POST /tinosite/{id}/users` — Bearer token · verified live

**Add User**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `email` | string | yes | — |
| `role` | string | yes | — |
| `password` | string | yes | — |

```json
{
  "email": "<email>",
  "role": "<role>",
  "password": "<password>"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "service_id": "100001"
}
```

</details>

**SDK**

```python
client.tinosite.create_user(id, email=...)
```
```javascript
await client.tinosite.createUser(id, { email: ... });
```
```php
$client->tinosite->createUser($id, ['email' => ...]);
```

---
