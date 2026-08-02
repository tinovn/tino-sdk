---
name: tino-userapi
description: >
  Integrate a project with the Tino UserAPI (https://api.tino.vn) using the official
  SDKs — services, domains, DNS, invoices, VMs, support tickets of a Tino customer
  account. Use when the task needs to read or change anything the customer sees in
  their Tino client area, or when writing code that talks to api.tino.vn. Do not use
  for Tino's internal admin/HostBill API, for provisioning on the hosting nodes
  directly, or when the project only needs Tino as a DNS/nameserver target.
---

# Tino UserAPI

The customer-facing API behind [tino.vn](https://tino.vn). One token = one customer
account; there is no admin or reseller surface here.

```
Base URL   https://api.tino.vn        (paths at the root — no /api prefix)
Auth       Authorization: Bearer <JWT>
Surface    255 operations across 17 resource groups
```

**Do not hand-roll HTTP calls.** The API has behaviours that silently corrupt naive
clients — errors arrive with HTTP 200, tokens rotate on refresh, query strings use
PHP bracket notation. Use the SDK; it absorbs all of it.

## Install

```bash
pip install tino-userapi                    # Python 3.8+
npm install @tinovn/tino-sdk                # Node 18+
composer require tinovn/tino-sdk            # PHP 7.4+
```

Not yet on the registry? Install from source:

```bash
pip install "git+https://github.com/tinovn/tino-sdk.git#subdirectory=sdk/python"
```

All three are zero-dependency.

## Authenticate

Prefer the one-time code: no password to store, and it is the flow Tino's own client
uses. The code is delivered by Zalo when the account has one linked, otherwise by
email — the response tells you which in `via`.

```python
from tino_userapi import TinoClient

client = TinoClient()
sent = client.request_login_otp("customer@example.com")   # -> {"via": "zalo"}
client.verify_login_otp("customer@example.com", code)     # stores both tokens
```

```javascript
const client = new TinoClient();
await client.requestLoginOtp('customer@example.com');
await client.verifyLoginOtp('customer@example.com', code);
```

```php
$client = new Tino\UserApi\TinoClient();
$client->requestLoginOtp('customer@example.com');
$client->verifyLoginOtp('customer@example.com', $code);
```

Password login (`client.login(email, password)`) and SSO (`POST /login-sso`) exist too.

### Persist the token pair — refreshing rotates both

A refresh invalidates the old refresh token **and** the old access token. Store what
the callback gives you, atomically, and never refresh twice from the same stored pair.

```python
client = TinoClient(
    token=load("access"), refresh_token=load("refresh"),
    on_token_refresh=lambda token, refresh: save(token, refresh),
)
```

Access tokens last ~7 days, refresh tokens 90. On `unauthorized` / `token_expired` the
SDK refreshes once and replays the call; if that fails it raises `TinoAuthError` and you
must re-authenticate the user.

**Never put a token in a task comment, an artifact, a commit or a log.** Keep it in the
project's secret store.

## Call the API

One property per resource group; `snake_case` in Python, `camelCase` in Node and PHP.

```python
client.account.get_summary()                                    # counts for a dashboard
client.services.list(filters={"hide_cancelled": 1})             # active services
client.domains.list()
client.billing.list_invoices_due()
client.dns.create_record(service_id, zone_id, name="www", type="A", content="203.0.113.10")
client.support.create_ticket(dept_id=2, subject="…", body="…")
client.vms.reboot(service_id, vm_id)
```

Signature rules: path parameters first in URL order (percent-encoded for you), then the
payload for writes, then extra query parameters. In Python the payload argument is
`payload=` — `body` is left free because `POST /tickets` has a field of that name.

See `references/resource-map.md` for what lives in each group, and
`references/recipes.md` for worked examples of the common jobs.

## Five rules that will bite you otherwise

**1. Errors come back as HTTP 200.** `{"error":["unauthorized"]}` with a `200 OK` is the
norm. Never branch on the status code — the SDK reads the body and raises a typed error.

```python
from tino_userapi import TinoAuthError, TinoNotFoundError, TinoValidationError, TinoApiError

try:
    client.domains.get(domain_id)
except TinoNotFoundError:
    ...                              # unknown route or record
except TinoValidationError as exc:
    print(exc.errors)                # ['field_marked_required', 'Ngày sinh']
except TinoApiError as exc:
    print(exc.status, exc.path, exc.body)
```

**2. Pagination is zero-based going in, one-based coming out.** `page=0` is the first
page; the response reports `page.current` as `1`. Empty collections are `null`, not `[]`
— guard before iterating.

**3. `POST /security/ipaccess` switches the account into whitelist mode.** The first rule
locks out every address that is not on the list, including the one you are calling from,
and `GET /security` then refuses to show you the list so you cannot undo it. Always allow
the current address first:

```python
own_ip = client.account.get_details()["client"]["ip"]
client.security.add_ip_access(rule=own_ip)
client.security.add_ip_access(rule=target_ip)
```

**4. Two GETs change state.** `GET /service/{sid}/dns/{zid}/password` generates a new
zone password; `GET /domain/{id}/epp` emails the EPP code to the registrant. Keep both
out of retry loops, health checks and cache warmers.

**5. VM actions are asynchronous.** `start`, `stop`, `reboot`, `rebuild`, `resetpwd`
return immediately; a second action while one is in flight answers `vm_act_wrong_state`.
Poll `client.vms.get(sid, vmid)["vm"]["status"]` until it settles.

## Money, dates, ids

Amounts arrive as strings (`"574723.00"`) — parse as decimal, never float. Ids arrive as
strings in most payloads and integers in newer ones — normalise on the way in. Dates are
`YYYY-MM-DD [HH:MM:SS]` in Asia/Ho_Chi_Minh, with `0000-00-00 00:00:00` meaning "never".
Text fields may contain HTML entities (`Y&ecirc;u cầu`); decode before display.

## Ordering

There is one ordering endpoint. `client.cart.order(items=[...])` places an order for any
mix of products — hosting, VPS, domains, SSL — in a single call.
`client.cart.quote(items=[...])` takes the same payload and returns the price breakdown
without creating anything. Always quote before you order, and show the user the total
including tax.

## Before you write code that changes anything

Ordering, renewing, adding funds, cancelling a service, deleting an invoice, rebuilding a
VM and resetting a cPanel account all have real consequences for a paying customer.
Treat them the way this company treats any irreversible action: get the board's approval
first, and say plainly in the approval request which endpoint you intend to call and what
it will do. Read-only work needs no gate.

## Reference

Full contract — every endpoint with parameters, request body, a live response sample and
the SDK call in all three languages: <https://github.com/tinovn/tino-sdk/tree/main/docs>

- [Getting started](https://github.com/tinovn/tino-sdk/blob/main/docs/getting-started.md)
- [Conventions](https://github.com/tinovn/tino-sdk/blob/main/docs/conventions.md)
- [Endpoint index](https://github.com/tinovn/tino-sdk/blob/main/docs/api-contract/README.md)
