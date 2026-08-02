# API conventions

Everything on this page was verified against `https://api.tino.vn`. It is the part of
the contract the per-endpoint reference does not repeat.

## Errors do not use HTTP status codes

This is the single most important thing to know about the Tino UserAPI.

**Most failures come back as HTTP 200 with an `error` key in the body.**

```http
POST /verify-login-otp        ->  200 OK
{"error": ["Wrong OTP code. You have 3 attempts left."]}
```
```http
GET /clientarea/businessinfo  ->  200 OK
{"error": ["Please enter taxid"]}
```

Checking `response.ok` or `status == 200` is therefore **not** enough. Always inspect
the body. The `error` key appears in four different shapes:

| Shape | Example |
| --- | --- |
| array of codes | `{"error": ["unauthorized"]}` |
| array of sentences | `{"error": ["Wrong OTP code. You have 3 attempts left."]}` |
| plain string next to `success` | `{"success": false, "error": "query is required"}` |
| bare array at the top level | `["file_not_found"]` |

HTTP status codes that *are* meaningful:

| Status | Meaning |
| --- | --- |
| `401` | no or invalid Bearer token on a protected route |
| `404` | unknown route — body is `{"error":["invalid method"]}` |

A `404` usually means the path does not exist on this deployment, not that the record is
missing. A missing record is normally `200` with `null` (`{"article": null}`).

### Error codes worth handling

| Code | Meaning |
| --- | --- |
| `unauthorized` | missing/invalid token, or the record belongs to another client |
| `token_expired` | access token past `exp` — refresh and retry |
| `refresh_token_invalid` | refresh token already used or expired — re-authenticate |
| `invalid method` | route does not exist |
| `internal_error_0` | server-side failure; the endpoint may be unavailable on this deployment |
| `category_not_found`, `file_not_found` | the addressed record does not exist |
| `useralreadyexistsemail_error` | returned by `POST /checkemail` when the email is taken |
| `cantloginwiththose` | the IP access whitelist excludes your address — see below |
| `vm_act_wrong_state` | a previous VM action is still running; poll and retry |
| `insufficient_credit` | account balance too low to place the order |
| `field_marked_required` | a profile field the API needs is empty; the value names it |

The SDKs map all of this onto typed errors so you never parse strings yourself:

| Condition | Python | Node.js | PHP |
| --- | --- | --- | --- |
| auth | `TinoAuthError` | `TinoAuthError` | `TinoAuthException` |
| unknown route / record | `TinoNotFoundError` | `TinoNotFoundError` | `TinoNotFoundException` |
| rejected payload | `TinoValidationError` | `TinoValidationError` | `TinoValidationException` |
| rate limited | `TinoRateLimitError` | `TinoRateLimitError` | `TinoRateLimitException` |
| anything else | `TinoApiError` | `TinoApiError` | `TinoApiException` |
| no response at all | `TinoTransportError` | `TinoTransportError` | `TinoTransportException` |

Every API error carries `status`, `errors`, `method`, `path` and the decoded `body`.

## Pagination

List endpoints accept `page`, `perpage` and `orderby`.

**`page` is zero-based on the way in and one-based on the way out.** `page=0` and
`page=1` are the first and second pages, while the response echoes `page.current` as
`1` and `2`. Off-by-one bugs here are easy — the SDKs pass your value through unchanged.

```
GET /invoices?page=0&perpage=25&orderby=date|DESC
```
```json
{ "success": true, "invoices": [ … ], "total": 1, "page": { "total": 1, "pages": 1, "current": 1 } }
```

The pagination envelope is not uniform. Expect one of:

| Shape | Seen on |
| --- | --- |
| `{"total": n, "pages": n, "current": n}` | `/invoices`, `/clientarea/histories`, `/notifications` |
| `{"current": n, "total": n}` | `/tickets`, `/contact` |
| no envelope at all | `/service`, `/domains`, `/dns` |

`perpage` defaults to the account's `RecordsPerPage` setting (`GET /clientarea/settings`).

`orderby` takes `field|DIRECTION`, e.g. `orderby=date|DESC`.

## Filters and query encoding

Filters use PHP bracket notation, and repeated values use `key[]`:

```
GET /service?filter[hide_cancelled]=1
GET /invoices?filter[service]=100001
```

```python
client.services.list(filters={"hide_cancelled": 1})
```
```javascript
await client.services.list({ filter: { hide_cancelled: 1 } });
```
```php
$client->services->list(['filter' => ['hide_cancelled' => 1]]);
```

The SDKs encode nested objects, arrays and booleans (`true` → `1`) for you, and drop
`null` values instead of sending empty parameters.

Known filters: `hide_cancelled` (services), `service` (invoices). Others are
endpoint-specific and undocumented upstream — unknown filters are ignored rather than
rejected, so verify that a filter actually narrows the result before relying on it.

## Path parameters

Path segments must be percent-encoded — several endpoints take a Vietnamese place name
in the path:

```
GET /location/state/city/Th%C3%A0nh%20ph%E1%BB%91%20H%E1%BB%93%20Ch%C3%AD%20Minh
```

All three SDKs encode path arguments automatically.

## Data types

* **Money arrives as a string**: `"total": "574723.00"`. Parse it as a decimal, never as
  a float, and never compare strings. `GET /v2/cart/domain/tlds` is the exception — it
  returns integers (`"register": 18182`), and those are pre-tax.
* **Numeric ids arrive as strings** in most list payloads (`"id": "200001"`) but as
  integers in a few newer ones (VM ids, `v2` endpoints). Compare loosely or normalise on
  the way in.
* **Dates** are `YYYY-MM-DD` or `YYYY-MM-DD HH:MM:SS` in Asia/Ho_Chi_Minh, with
  `0000-00-00 00:00:00` used as "never". Some fields (`expires` in search results) use
  `DD/MM/YYYY` instead.
* **Empty collections are `null`, not `[]`**: `{"campaigns": null}`, `{"vms": null}`.
  Guard before iterating.
* **HTML entities appear in text fields** — ticket subjects and email bodies come back
  as `Y&ecirc;u cầu`. Decode before display.

## Non-JSON responses

Some endpoints return a document rather than a JSON object:

| Endpoint | Payload |
| --- | --- |
| `GET /clientarea/downloadprofile` | raw PDF bytes |
| `GET /invoice/{id}/pdf` | JSON with a base64 PDF in `invoice` |
| `GET /estimate/{id}/pdf` | same as above |
| `GET /certificate/{id}/crt` | certificate text |
| `GET /download/{id}`, `GET /ticket/attachment/{file}` | file bytes |

Ask the SDK for the raw response when you need the bytes:

```python
response = client.request("GET", "/clientarea/downloadprofile", raw=True)
open("profile.pdf", "wb").write(response.content)      # .content is bytes, .text is decoded
```
```javascript
const response = await client.request('GET', '/clientarea/downloadprofile', { raw: true });
await writeFile('profile.pdf', response.content);      // .content is a Buffer
```
```php
$response = $client->request('GET', '/clientarea/downloadprofile', ['raw' => true]);
file_put_contents('profile.pdf', $response['text']);   // raw bytes
```

## GET is not always safe

`GET /service/{service_id}/dns/{zone_id}/password` **generates a new zone password** and
returns it. Despite the verb it is a state-changing call — do not put it in a retry loop,
a health check or a "warm the cache" sweep.

`GET /domain/{id}/epp` also has a side effect: it emails the EPP code to the registrant
contact rather than returning it.

## Calls that lock you out or run asynchronously

**`POST /security/ipaccess` switches the account into whitelist mode.** The moment the
first rule exists, every address that is not on the list is refused — including the one
you are calling from. `GET /security` then answers
`{"error": ["cantloginwiththose", "<your ip>"]}` and you can no longer read the list to
find the rule id and undo it.

```python
own_ip = client.account.get_details()["client"]["ip"]
client.security.add_ip_access(rule=own_ip)          # allow yourself first
client.security.add_ip_access(rule="203.0.113.10")  # then the address you actually wanted
```

Remove your own rule last, for the same reason.

**VM actions are asynchronous.** `start`, `stop`, `reboot`, `reset`, `rebuild`,
`resetpwd` and `addsshkey` return immediately with `{"status": true}` and the platform
applies them in the background. Issuing another action while one is in flight answers
`vm_act_wrong_state`. Poll `vms.get()` until `vm.status` settles (`running`, `stopped`)
before the next action rather than chaining calls back to back.

**Snapshot and backup names are generated by the platform.** `vms.createSnapshot()`
ignores any name you send and creates `A<unix-timestamp>`; read the real name back from
`vms.listSnapshots()` before deleting.

## Rate limiting

There is no documented rate limit and no `Retry-After` header, but WHOIS lookups are
throttled upstream and answer with `Rate limit exceeded` in the `raw` field. Treat WHOIS
as best-effort, cache results, and do not cache a rate-limited answer.

## Request headers

Only `Authorization`, `Accept` and `Content-Type` matter. The production client also
forwards the end user's address, which is what `GET /status` echoes back and what the
access token is pinned to in its `ip` claim:

```
X-Real-IP: 203.0.113.10
X-Forwarded-For: 203.0.113.10
X-Forwarded-Host: tino.vn
```

Pass them through `default_headers` when you proxy the API from your own backend:

```python
client = TinoClient(default_headers={"X-Real-IP": user_ip, "X-Forwarded-For": user_ip})
```
