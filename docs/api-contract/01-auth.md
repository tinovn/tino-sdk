# Authentication

SDK namespace: `client.auth` (Python) · `client.auth` (Node.js, PHP).

14 operation(s) in this chapter, 3 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `POST` | `/checkemail` | [`checkEmail`](#authcheckemail) | public |
| `POST` | `/login` | [`login`](#authlogin) | public |
| `POST` | `/login-otp` | [`requestLoginOtp`](#authrequestloginotp) | public |
| `POST` | `/login-sso` | [`loginSso`](#authloginsso) | public |
| `POST` | `/logout` | [`logout`](#authlogout) | Bearer |
| `POST` | `/password/change` | [`changePassword`](#authchangepassword) | Bearer |
| `POST` | `/password/forgot` | [`forgotPassword`](#authforgotpassword) | public |
| `POST` | `/password/passreset` | [`resetPassword`](#authresetpassword) | public |
| `POST` | `/revoke` | [`revokeToken`](#authrevoketoken) | Bearer |
| `POST` | `/signup` | [`signup`](#authsignup) | public |
| `POST` | `/token` | [`refreshToken`](#authrefreshtoken) | public |
| `POST` | `/verification/resend` | [`resendVerification`](#authresendverification) | Bearer |
| `POST` | `/verification/verify` | [`verifyAccount`](#authverifyaccount) | Bearer |
| `POST` | `/verify-login-otp` | [`verifyLoginOtp`](#authverifyloginotp) | public |

---

### `auth.checkEmail`

`POST /checkemail` — Public · verified live

**Verify Email Exists**

Return exists email client

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `email` | string | no | Your acount email address |

```json
{
  "email": "<email>"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "email": "user@example.com",
 "error": "",
 "exists": false
}
```

</details>

**SDK**

```python
client.auth.check_email(email=...)
```
```javascript
await client.auth.checkEmail({ email: ... });
```
```php
$client->auth->checkEmail(['email' => ...]);
```

---

### `auth.login`

`POST /login` — Public · spec only

**User Login**

Return Client details

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `username` | string | no | Your acount email address |
| `password` | string | no | Account password |
| `remember` | boolean | no | Remember login session with 360 day |

```json
{
  "username": "<username>",
  "password": "<password>",
  "remember": true
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.login(username=...)
```
```javascript
await client.auth.login({ username: ... });
```
```php
$client->auth->login(['username' => ...]);
```

---

### `auth.requestLoginOtp`

`POST /login-otp` — Public · verified live

**User Request OTP Login**

Return Client details

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `email` | string | no | Your acount email address |

```json
{
  "email": "<email>"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "status": false,
 "message": "If this account exists, an OTP has been sent.",
 "via": "email"
}
```

</details>

**SDK**

```python
client.auth.request_login_otp(email=...)
```
```javascript
await client.auth.requestLoginOtp({ email: ... });
```
```php
$client->auth->requestLoginOtp(['email' => ...]);
```

---

### `auth.loginSso`

`POST /login-sso` — Public · spec only

**Login**

Return Client

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.login_sso()
```
```javascript
await client.auth.loginSso();
```
```php
$client->auth->loginSso();
```

---

### `auth.logout`

`POST /logout` — Bearer token · spec only

**Logout**

Invalidate authorization token

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.logout()
```
```javascript
await client.auth.logout();
```
```php
$client->auth->logout();
```

---

### `auth.changePassword`

`POST /password/change` — Bearer token · spec only

**Change Password**

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `oldpassword` | string | no | old password |
| `password` | string | no | New password |
| `password2` | string | no | New password |

```json
{
  "oldpassword": "<oldpassword>",
  "password": "<password>",
  "password2": "<password2>"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.change_password(oldpassword=...)
```
```javascript
await client.auth.changePassword({ oldpassword: ... });
```
```php
$client->auth->changePassword(['oldpassword' => ...]);
```

---

### `auth.forgotPassword`

`POST /password/forgot` — Public · spec only

**Forgot Password**

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.forgot_password()
```
```javascript
await client.auth.forgotPassword();
```
```php
$client->auth->forgotPassword();
```

---

### `auth.resetPassword`

`POST /password/passreset` — Public · spec only

**Validate Reset Password**

Validate Reset Password From email link active

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `activate` | string | no | activate code |

```json
{
  "activate": "<activate>"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.reset_password(activate=...)
```
```javascript
await client.auth.resetPassword({ activate: ... });
```
```php
$client->auth->resetPassword(['activate' => ...]);
```

---

### `auth.revokeToken`

`POST /revoke` — Bearer token · spec only

**Revoke Token**

Invalidate authorization and refresh token.
Pass refresh token or call this method with valid access token

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `refresh_token` | string | no | — |

```json
{
  "refresh_token": "refresh_tokenValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.revoke_token(refresh_token=...)
```
```javascript
await client.auth.revokeToken({ refresh_token: ... });
```
```php
$client->auth->revokeToken(['refresh_token' => ...]);
```

---

### `auth.signup`

`POST /signup` — Public · spec only

**Sign up**

Create new account

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `type` | string | no | Account Type One of: `Private`, `Company` |
| `companyname` | string | no | Organization - Quý khách vui lòng nhập đầy đủ tên công ty chính xác, Nếu không có tên công ty đầy đủ vui lòng chọn loại tài khoản là cá nhân |
| `taxid` | string | no | Mã số thuế |
| `gender` | string | no | Danh xưng One of: `Male`, `Female` |
| `lastname` | string | no | Last Name |
| `firstname` | string | no | First Name - Họ và Tên phải đầy đủ và chính xác theo CCCD/CMND. Vì liên quan đến việc xác thực chủ thể sử dụng dịch vụ và tên miền. |
| `nationalid` | string | no | Số CCCD/Passport |
| `email` | string | no | Email Address |
| `birthday` | string | no | Ngày sinh - Định dạng đúng dd/mm/yyyy |
| `phonenumber` | string | no | Phone - Vui lòng nhập đúng số điện thoại di động. Hệ thống sẽ gửi thông báo qua Zalo, SMS, nhắc nhở dịch vụ đến hạn. |
| `country` | string | no | Country |
| `state` | string | no | State |
| `city` | string | no | City |
| `address1` | string | no | Address 1 |
| `password` | string | no | Password |
| `currency` | string | no | Currency One of: `VND` |

```json
{
  "type": "Private",
  "companyname": "<companyname>",
  "taxid": "<taxid>",
  "gender": "Male",
  "lastname": "<lastname>",
  "firstname": "<firstname>",
  "nationalid": "<nationalid>",
  "email": "<email>",
  "birthday": "<birthday>",
  "phonenumber": "<phonenumber>",
  "country": "<country>",
  "state": "<state>",
  "city": "<city>",
  "address1": "<address1>",
  "password": "<password>",
  "currency": "VND"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.signup(type=...)
```
```javascript
await client.auth.signup({ type: ... });
```
```php
$client->auth->signup(['type' => ...]);
```

---

### `auth.refreshToken`

`POST /token` — Public · spec only

**Refresh Token**

Generate new authorization token using refresh token

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `refresh_token` | string | no | Refresh token previously obtained from `POST /login` |

```json
{
  "refresh_token": "refresh_tokenValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.refresh_token(refresh_token=...)
```
```javascript
await client.auth.refreshToken({ refresh_token: ... });
```
```php
$client->auth->refreshToken(['refresh_token' => ...]);
```

---

### `auth.resendVerification`

`POST /verification/resend` — Bearer token · spec only

**Resend Verification**

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `code` | string | no | — |
| `type` | string | no | sms/email |

```json
{
  "code": "<code>",
  "type": "<type>"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.resend_verification(code=...)
```
```javascript
await client.auth.resendVerification({ code: ... });
```
```php
$client->auth->resendVerification(['code' => ...]);
```

---

### `auth.verifyAccount`

`POST /verification/verify` — Bearer token · spec only

**Account Verification**

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `code` | string | no | — |
| `type` | string | no | sms/email |

```json
{
  "type": "sms"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.verify_account(code=...)
```
```javascript
await client.auth.verifyAccount({ code: ... });
```
```php
$client->auth->verifyAccount(['code' => ...]);
```

---

### `auth.verifyLoginOtp`

`POST /verify-login-otp` — Public · verified live

**User Login OTP**

Return Client details

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `email` | string | no | Your acount email address |
| `otp` | string | no | otp |

```json
{
  "email": "<email>",
  "otp": "<otp>"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.auth.verify_login_otp(email=...)
```
```javascript
await client.auth.verifyLoginOtp({ email: ... });
```
```php
$client->auth->verifyLoginOtp(['email' => ...]);
```

---
