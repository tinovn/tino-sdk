# Tino SDK

> [Bản tiếng Việt](README.vi.md)

Official SDKs and API contract documentation for the **Tino UserAPI** — the customer
API behind [tino.vn](https://tino.vn) that manages services, domains, invoices and
support tickets for a Tino account.

```
Base URL   https://api.tino.vn
Auth       Authorization: Bearer <JWT>
Surface    263 operations · 19 resource groups
```

| | |
| --- | --- |
| 🐍 **Python** | [`sdk/python`](sdk/python) — 3.8+, zero dependencies |
| 🟩 **Node.js** | [`sdk/nodejs`](sdk/nodejs) — 18+, ESM, TypeScript definitions, zero dependencies |
| 🐘 **PHP** | [`sdk/php`](sdk/php) — 7.4+, PSR-4, zero dependencies |
| 📖 **Docs** | [`docs/`](docs/README.md) — every endpoint with request, response and SDK call |

## Quick start

```python
from tino_userapi import TinoClient

client = TinoClient()
client.request_login_otp("you@example.com")          # code is sent by Zalo or email
client.verify_login_otp("you@example.com", "123456")

print(client.billing.get_balance())
print(client.domains.list())
client.support.create_ticket(dept_id=2, subject="Hello", body="…")
```

```javascript
import { TinoClient } from '@tinovn/tino-sdk';

const client = new TinoClient();
await client.requestLoginOtp('you@example.com');
await client.verifyLoginOtp('you@example.com', '123456');

console.log(await client.billing.getBalance());
console.log(await client.domains.list());
```

```php
require 'vendor/autoload.php';

$client = new Tino\UserApi\TinoClient();
$client->requestLoginOtp('you@example.com');
$client->verifyLoginOtp('you@example.com', '123456');

print_r($client->billing->getBalance());
print_r($client->domains->list());
```

All three expose the same surface: `client.<group>.<operation>()`, one group per section
of the API. See [`docs/api-contract/README.md`](docs/api-contract/README.md) for the full
list.

## Why use the SDK instead of raw HTTP

The Tino UserAPI has sharp edges. The SDKs absorb them:

* **Errors arrive with HTTP 200.** `{"error":["unauthorized"]}` comes back as a `200 OK`.
  The SDKs inspect the body and raise a typed error (`TinoAuthError`,
  `TinoNotFoundError`, `TinoValidationError`, …) instead of handing you a "successful"
  response.
* **Tokens rotate.** A refresh invalidates *both* the old refresh token and the old
  access token. The SDKs swap the pair atomically, retry the failed call once, and call
  your `on_token_refresh` hook so you can persist the new credentials.
* **Query encoding is PHP-flavoured.** `filter[hide_cancelled]=1`, `key[]=a&key[]=b`,
  booleans as `1`/`0`. Pass native structures; the SDK encodes them.
* **Pagination is zero-based going in, one-based coming out.** Documented, not silently
  "fixed", so your code stays predictable.
* **Some responses are binary.** PDFs and certificates are exposed as raw bytes rather
  than mangled UTF-8.

## Repository layout

```
spec/
  tino-userapi-catalog.json    canonical catalog — single source of truth (263 operations)
  response-samples.json        redacted live responses used as documentation samples
docs/
  getting-started.md           base URL, login flows, token lifecycle
  conventions.md               errors, pagination, filters, data types, unsafe GETs
  api-contract/                per-endpoint reference, one chapter per resource group
sdk/
  python/  nodejs/  php/       hand-written core + generated resource layer
tools/
  build-catalog.py             specification + corrections -> catalog
  generate-sdk.py              catalog -> resource layer for all three languages
  generate-docs.py             catalog + samples -> docs/api-contract/
  sanitize-samples.py          live captures -> publishable samples (PII stripped)
examples/                      runnable end-to-end scripts
```

## How the contract was built

Every operation is described from three angles: the API's formal specification, the way
Tino's own client calls it in production, and what the live service actually answers —
with the live service as the tie-breaker.

134 operations were executed against `https://api.tino.vn` with a real account and their
responses captured, redacted and embedded in the documentation. Operations that create,
charge or delete were deliberately not called; they are documented and marked
*spec only*.

The catalog is committed, so the SDKs and the reference can be regenerated from a fresh
clone without any additional input.

## Regenerating

```bash
python3 tools/build-catalog.py <specification.json>   # -> spec/tino-userapi-catalog.json
python3 tools/generate-sdk.py                         # catalog -> sdk/*/resources
python3 tools/generate-docs.py                        # catalog + samples -> docs/api-contract
```

The catalog is committed, so `generate-sdk.py` and `generate-docs.py` run on a fresh
clone. `build-catalog.py` is only needed when a new specification export lands.

Hand-written SDK code (transport, auth, errors, client) is never touched by the
generator; only the per-endpoint resource layer is generated, which is what keeps the
three languages in step.

## Status

Version 1.0.0. The catalog and both generated layers are complete; response samples cover
the 134 operations that are safe to call read-only. Contributions that add verified
samples for the remaining operations are welcome — see
[`tools/sanitize-samples.py`](tools/sanitize-samples.py) for the redaction rules that
publishable samples must pass.

## License

MIT — see [LICENSE](LICENSE).
