# Tino UserAPI — Python SDK

Zero-dependency client for `https://api.tino.vn`. Python 3.8+.

```bash
pip install tino-userapi
```

Not on PyPI yet? Install straight from the repository:

```bash
pip install "git+https://github.com/tinovn/tino-sdk.git#subdirectory=sdk/python"
```

## Log in

```python
from tino_userapi import TinoClient

client = TinoClient()

sent = client.request_login_otp("you@example.com")
print(f"Code sent via {sent['via']}")          # 'zalo' or 'email'

client.verify_login_otp("you@example.com", input("Code: "))
print(client.account.get_details()["client"]["email"])
```

Password login works too, and so does resuming a stored session:

```python
client.login("you@example.com", password, remember=True)

client = TinoClient(token=stored_token, refresh_token=stored_refresh)
```

## Persist rotating tokens

A refresh invalidates both the old refresh token **and** the old access token, so store
whatever the callback hands you:

```python
def persist(token: str, refresh: str) -> None:
    keyring.set_password("tino", "access", token)
    keyring.set_password("tino", "refresh", refresh)

client = TinoClient(
    token=keyring.get_password("tino", "access"),
    refresh_token=keyring.get_password("tino", "refresh"),
    on_token_refresh=persist,
)
```

When a call fails with `unauthorized` / `token_expired`, the client refreshes once and
replays the request. If the refresh also fails it raises `TinoAuthError`.

## Call the API

Every resource group is an attribute; method names are `snake_case`.

```python
client.billing.get_balance()
client.billing.list_invoices(page=0, perpage=25, orderby="date|DESC")
client.domains.list()
client.domains.get(200001)
client.services.list(filters={"hide_cancelled": 1})
client.dns.create_record(service_id, zone_id, name="www", type="A", content="203.0.113.10")
client.support.create_ticket(dept_id=2, subject="Hello", body="…")
client.vms.reboot(service_id, vm_id)
```

Rules that hold everywhere:

* **Path parameters are positional**, in the order they appear in the URL, and are
  percent-encoded for you.
* **Query parameters are keyword-only.** Documented ones are named; anything else goes
  through `**query`. Because `filter` shadows a builtin it is spelled `filters`.
* **Write operations take a payload**, either as keyword fields or as `payload={...}`.
  The explicit argument is called `payload`, not `body`, so it never shadows an API
  field of that name — `POST /tickets` really does have a field called `body`:

  ```python
  client.support.create_ticket(dept_id=2, subject="Hi", body="the message")
  client.support.create_ticket(payload={"dept_id": 2, "subject": "Hi", "body": "…"})
  ```

* **Responses are plain dicts and lists** — the raw JSON, unmodified. Nothing is
  re-shaped behind your back.

## Handle errors

```python
from tino_userapi import (
    TinoApiError, TinoAuthError, TinoNotFoundError,
    TinoValidationError, TinoTransportError,
)

try:
    client.domains.get(999999)
except TinoNotFoundError:
    ...                                   # unknown route or record
except TinoAuthError:
    ...                                   # re-authenticate
except TinoValidationError as exc:
    print(exc.errors)                     # ['Please enter taxid']
except TinoApiError as exc:
    print(exc.status, exc.errors, exc.path, exc.body)
except TinoTransportError:
    ...                                   # never reached the server
```

The API reports most failures with HTTP 200 and an `error` key in the body, so raising
on the body — not the status — is the whole point of this layer.

## Binary payloads

```python
response = client.request("GET", "/clientarea/downloadprofile", raw=True)
open("profile.pdf", "wb").write(response.content)
```

## Escape hatch

Anything the resource layer does not cover:

```python
client.request("GET", "/some/new/endpoint", query={"page": 0})
client.request("POST", "/some/new/endpoint", body={"field": "value"})
```

## Configuration

| Option | Default | Purpose |
| --- | --- | --- |
| `base_url` | `https://api.tino.vn` | Point at a staging deployment |
| `token`, `refresh_token` | `None` | Resume a stored session |
| `timeout` | `60.0` | Seconds per request |
| `auto_refresh` | `True` | Refresh once and retry on an auth error |
| `user_agent` | `tino-sdk-python/<version>` | Identify your integration |
| `default_headers` | `{}` | Forward `X-Real-IP` etc. when proxying |
| `on_token_refresh` | `None` | `(token, refresh) -> None` persistence hook |

## Reference

* [Getting started](../../docs/getting-started.md)
* [API conventions](../../docs/conventions.md)
* [Endpoint reference](../../docs/api-contract/README.md)
