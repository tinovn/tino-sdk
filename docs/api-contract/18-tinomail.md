# TinoMail

SDK namespace: `client.tinomail` (Python) · `client.tinomail` (Node.js, PHP).

2 operation(s) in this chapter, 0 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/service/{idtinomail}/logs` | [`listLogs`](#tinomaillistlogs) | Bearer |
| `GET` | `/service/{idtinomail}/summary` | [`getSummary`](#tinomailgetsummary) | Bearer |

---

### `tinomail.listLogs`

`GET /service/{idtinomail}/logs` — Bearer token · spec only

**Email logs**

> **Note.** Only valid for a TinoMail service id. Calling it on another service type returns 404 invalid method.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `idtinomail` | path | string | yes | — |
| `id` | path | integer | yes | — |

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.tinomail.list_logs(idtinomail, id)
```
```javascript
await client.tinomail.listLogs(idtinomail, id);
```
```php
$client->tinomail->listLogs($idtinomail, $id);
```

---

### `tinomail.getSummary`

`GET /service/{idtinomail}/summary` — Bearer token · spec only

**Email Summary**

Email details

> **Note.** Only valid for a TinoMail service id. Calling it on another service type returns 404 invalid method.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `idtinomail` | path | string | yes | — |
| `id` | path | integer | yes | — |

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.tinomail.get_summary(idtinomail, id)
```
```javascript
await client.tinomail.getSummary(idtinomail, id);
```
```php
$client->tinomail->getSummary($idtinomail, $id);
```

---
