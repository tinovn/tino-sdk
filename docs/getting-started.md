# Getting started with the Tino UserAPI

The Tino UserAPI is the customer-facing HTTP API behind [tino.vn](https://tino.vn):
it manages the services, domains, invoices and support tickets of **one** client account.

| | |
| --- | --- |
| Base URL | `https://api.tino.vn` |
| Protocol | HTTPS only |
| Payloads | JSON in, JSON out (`Content-Type: application/json`) |
| Auth | `Authorization: Bearer <token>` (JWT, RS256) |
| Scope | a single client account — there is no admin/reseller surface here |

> **Paths sit at the root, with no `/api` prefix** — `https://api.tino.vn/details`, not
> `https://api.tino.vn/api/details`. The prefixed form returns
> `404 {"error":["invalid method"]}`.

## Install an SDK

```bash
pip install tino-userapi
```
```bash
npm install @tinovn/tino-sdk
```
```bash
composer require tinovn/tino-sdk
```

Until the packages are published to PyPI / npm / Packagist, point the dependency at this
repository — see each SDK's README under [`sdk/`](../sdk).

## Authentication

Three ways to obtain a token. All of them return the same payload.

### 1. One-time code (recommended)

No password, no password storage. Tino delivers a numeric code to the account owner and
you exchange it for a token.

```python
from tino_userapi import TinoClient

client = TinoClient()
sent = client.request_login_otp("you@example.com")
# {"status": "success", "message": "If this account exists, an OTP has been sent.", "via": "zalo"}

client.verify_login_otp("you@example.com", input("Code: "))
print(client.account.get_details())
```
```javascript
import { TinoClient } from '@tinovn/tino-sdk';

const client = new TinoClient();
await client.requestLoginOtp('you@example.com');
await client.verifyLoginOtp('you@example.com', code);
console.log(await client.account.getDetails());
```
```php
$client = new Tino\UserApi\TinoClient();
$client->requestLoginOtp('you@example.com');
$client->verifyLoginOtp('you@example.com', $code);
print_r($client->account->getDetails());
```

Behaviour worth knowing:

* **`via` tells you the channel.** Accounts with a linked Zalo number get `"via": "zalo"`;
  otherwise the code arrives by email. Show the value to the user so they look in the
  right place.
* **The response never reveals whether the account exists.** `POST /login-otp` always
  answers `"If this account exists, an OTP has been sent."`. The `status` field is
  `"success"` for a real account and `false` for an unknown one — do not surface that
  difference in a UI, it is an account-enumeration signal.
* **Three attempts.** A wrong code answers
  `{"error": ["Wrong OTP code. You have 3 attempts left."]}` and counts down.
* **A resend issues a fresh code.** Tell the user to read the most recent message.
  Whether an older code stays valid until it expires is not documented, so do not rely
  on it either way.

### 2. Password

```python
client = TinoClient()
client.login("you@example.com", "••••••••", remember=True)
```

`remember=True` asks for a long-lived session (documented as 360 days).

### 3. SSO

`POST /login-sso` exchanges a provider assertion for the same token pair. The accepted
payload depends on the provider configured for your brand — contact Tino support before
using it.

## What a successful login returns

```json
{
  "client":  { "id": "700001", "email": "user@example.com", "firstname": "…", "…": "…" },
  "currency": { "iso": "VND", "code": "đ", "decimal": "0", "id": 0 },
  "verify":  { "email": true },
  "update_required": true,
  "token":   "<access token>",
  "refresh": "<refresh token>"
}
```

`update_required: true` means the profile is missing data Tino needs (national id,
address, …). Domain registration for `.vn` will fail until the user completes it.

## Token lifecycle

Both tokens are RS256 JWTs issued by `https://tino.vn/`.

| Token | Lifetime | Sent as |
| --- | --- | --- |
| `token` (access) | ~7 days (`exp - iat` = 600 000 s) | `Authorization: Bearer <token>` |
| `refresh` | 90 days (7 776 000 s) | body of `POST /token` |

```
POST /token   {"refresh_token": "<refresh>"}   ->   {"token": "…", "refresh": "…"}
```

**Refreshing rotates *both* tokens.** After a successful `POST /token`:

* the refresh token you sent is dead — reusing it returns `refresh_token_invalid`;
* the previous **access** token is revoked too, and further calls with it return
  `{"error":["unauthorized"]}`.

So a refresh is a full credential swap: persist the new pair atomically, and never run
two refreshes concurrently from the same stored pair. All three SDKs do the swap for
you and expose a callback for persistence:

```python
def persist(token, refresh):
    keyring.set_password("tino", "access", token)
    keyring.set_password("tino", "refresh", refresh)

client = TinoClient(token=..., refresh_token=..., on_token_refresh=persist)
```
```javascript
const client = new TinoClient({ token, refreshToken, onTokenRefresh: (t, r) => save(t, r) });
```
```php
$client = new TinoClient(['token' => $t, 'refreshToken' => $r,
    'onTokenRefresh' => fn ($t, $r) => save($t, $r)]);
```

When a call comes back `unauthorized` / `token_expired`, the SDK refreshes once and
replays the request. If the refresh also fails it raises `TinoAuthError` —
re-authenticate the user at that point.

`POST /logout` invalidates the access token; `POST /revoke` invalidates the refresh
token. Call both when a user signs out.

## Endpoints that need no token

A handful of catalogue and reference endpoints are public, which is what lets you build
a price page or a domain search before the visitor signs in:

`GET /status` · `GET /currencies` · `GET /categories` · `GET /cart/domain/tlds` ·
`GET /v2/cart/domain/tlds` · `GET /cart/coupon` · `GET /payment` · `GET /payment/fees` ·
`GET /languages` · `GET /languages/file/{lang}` · `GET /languages/translate` ·
`GET /location/*` · `POST /domain/lookup` · `POST /domain/suggest` · `POST /checkemail`

Everything else answers `{"error":["unauthorized"]}` without a Bearer token — including
`GET /category`, `GET /news`, `GET /knowledgebase` and `GET /ticket/departments`, which
look public but are not.

## Next

* [conventions.md](conventions.md) — errors, pagination, filters, encoding, money and dates.
* [api-contract/](api-contract/README.md) — all 263 operations with request and response.
