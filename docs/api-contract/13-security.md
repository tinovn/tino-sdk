# Account security (SSH keys, IP access)

SDK namespace: `client.security` (Python) · `client.security` (Node.js, PHP).

5 operation(s) in this chapter, 3 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/security` | [`get`](#securityget) | Bearer |
| `POST` | `/security/ipaccess` | [`addIpAccess`](#securityaddipaccess) | Bearer |
| `DELETE` | `/security/ipaccess/{id}` | [`removeIpAccess`](#securityremoveipaccess) | Bearer |
| `POST` | `/security/sshkey` | [`addSshKey`](#securityaddsshkey) | Bearer |
| `DELETE` | `/security/sshkey/{id}` | [`removeSshKey`](#securityremovesshkey) | Bearer |

---

### `security.get`

`GET /security` — Bearer token · verified live

**List security**

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "mfamodules": true,
 "otherauth": [],
 "acl": {
  "editipaccess": {
   "admin": "EnableClientScurity",
   "visible": true
  },
  "editsshkeys": {
   "admin": "EnableClientScuritySSHKey",
   "visible": true
  }
 },
 "yourip": "203.0.113.10",
 "rules": [],
 "sshkeys": []
}
```

</details>

**SDK**

```python
client.security.get()
```
```javascript
await client.security.get();
```
```php
$client->security->get();
```

---

### `security.addIpAccess`

`POST /security/ipaccess` — Bearer token · verified live

**Add IP access**

all - keyword matching all
IPs xxx.xxx.xxx.xxx - IP single
xxx.xxx.xxx.xxx/M - IP with Mask in CIDR format
xxx.xxx.xxx.xxx/mmm.mmm.mmm.mmm - IP with Mask in dotted quad format

> **Note.** The first rule switches the account into whitelist mode: every address that is not listed is refused, including the one you are calling from. Add your own address before adding any other, and remove it last.

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `rule` | string | no | Rule Access |

```json
{
  "rule": "10.10.10.10/32"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "info": [
  "addediprestriction"
 ]
}
```

</details>

**SDK**

```python
client.security.add_ip_access(rule=...)
```
```javascript
await client.security.addIpAccess({ rule: ... });
```
```php
$client->security->addIpAccess(['rule' => ...]);
```

---

### `security.removeIpAccess`

`DELETE /security/ipaccess/{id}` — Bearer token · verified live

**Remove IP access**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Rule id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "info": [
  "removediprestriction"
 ]
}
```

</details>

**SDK**

```python
client.security.remove_ip_access(id)
```
```javascript
await client.security.removeIpAccess(id);
```
```php
$client->security->removeIpAccess($id);
```

---

### `security.addSshKey`

`POST /security/sshkey` — Bearer token · spec only

**Add SSH Key**

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `ssh_key_name` | string | no | SSH Name |
| `ssh_key_key` | string | no | SSh Key |

```json
{
  "ssh_key_name": "<ssh_key_name>",
  "ssh_key_key": "<ssh_key_key>"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.security.add_ssh_key(ssh_key_name=...)
```
```javascript
await client.security.addSshKey({ ssh_key_name: ... });
```
```php
$client->security->addSshKey(['ssh_key_name' => ...]);
```

---

### `security.removeSshKey`

`DELETE /security/sshkey/{id}` — Bearer token · spec only

**Remove SSH Key**

Đang test chưa xong

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | sshkey id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.security.remove_ssh_key(id)
```
```javascript
await client.security.removeSshKey(id);
```
```php
$client->security->removeSshKey($id);
```

---
