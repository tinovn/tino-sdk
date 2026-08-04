# Phone number verification

SDK namespace: `client.phone` (Python) · `client.phone` (Node.js, PHP).

2 operation(s) in this chapter, 0 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `POST` | `/phone/otp` | [`requestOtp`](#phonerequestotp) | Bearer |
| `POST` | `/phone/verify` | [`verify`](#phoneverify) | Bearer |

---

### `phone.requestOtp`

`POST /phone/otp` — Bearer token · spec only

**Send a phone verification code**

Send a one-time code over Zalo ZNS to prove the account owner holds the SIM. Omit phonenumber to verify the number already on the account. Accounts that have already verified a number are refused with already_verified — change the number through PUT /details first, which clears the previous verification.

> **Note.** Delivery is ZNS only — there is no email fallback, because the point is to prove possession of the SIM. The code lasts 300 seconds, may be resent after 60 seconds, at most 3 times, and is destroyed after 5 wrong attempts.

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `phonenumber` | string | no | Number to verify. Defaults to the one on the account. |

```json
{
  "phonenumber": "0987654321"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.phone.request_otp(phonenumber=...)
```
```javascript
await client.phone.requestOtp({ phonenumber: ... });
```
```php
$client->phone->requestOtp(['phonenumber' => ...]);
```

---

### `phone.verify`

`POST /phone/verify` — Bearer token · spec only

**Confirm a phone verification code**

Confirm the code sent by phone.requestOtp. On success the number is written to the profile when it changed, and ownership of it is claimed for this account. No new token is issued — the current session continues.

> **Note.** Returns {success, phone:{status, verified_at}}. A phone belongs to exactly one account: claiming is guarded by a unique index, so a race loses cleanly with phone_already_verified.

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `otp` | string | yes | Six-digit code |

```json
{
  "otp": "123456"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.phone.verify(otp=...)
```
```javascript
await client.phone.verify({ otp: ... });
```
```php
$client->phone->verify(['otp' => ...]);
```

---
