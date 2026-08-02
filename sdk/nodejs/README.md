# Tino UserAPI — Node.js SDK

Zero-dependency client for `https://api.tino.vn`. Node 18+, ESM, with TypeScript
definitions.

```bash
npm install @tinovn/tino-sdk
```

Not on npm yet? Install straight from the repository:

```bash
npm install github:tinovn/tino-sdk#main --workspace-root
```

…or vendor `sdk/nodejs` into your project.

## Log in

```javascript
import { TinoClient } from '@tinovn/tino-sdk';

const client = new TinoClient();

const sent = await client.requestLoginOtp('you@example.com');
console.log(`Code sent via ${sent.via}`);      // 'zalo' or 'email'

await client.verifyLoginOtp('you@example.com', code);
const { client: account } = await client.account.getDetails();
```

Password login and resuming a stored session:

```javascript
await client.login('you@example.com', password, true);

const client = new TinoClient({ token: storedToken, refreshToken: storedRefresh });
```

## Persist rotating tokens

A refresh invalidates both the old refresh token **and** the old access token, so store
whatever the callback hands you:

```javascript
const client = new TinoClient({
  token, refreshToken,
  onTokenRefresh: (token, refresh) => saveCredentials({ token, refresh }),
});
```

When a call fails with `unauthorized` / `token_expired`, the client refreshes once and
replays the request. If the refresh also fails it throws `TinoAuthError`.

## Call the API

Every resource group is a property; method names are `camelCase`.

```javascript
await client.billing.getBalance();
await client.billing.listInvoices({ page: 0, perpage: 25, orderby: 'date|DESC' });
await client.domains.list();
await client.domains.get(200001);
await client.services.list({ filter: { hide_cancelled: 1 } });
await client.dns.createRecord(serviceId, zoneId, { name: 'www', type: 'A', content: '203.0.113.10' });
await client.support.createTicket({ dept_id: 2, subject: 'Hello', body: '…' });
await client.vms.reboot(serviceId, vmId);
```

Signature rules:

* **Path parameters come first**, in URL order, percent-encoded for you.
* **Read operations** end with an optional `query` object.
* **Write operations** take `(…pathParams, body, query)` — the body is the second-to-last
  argument.
* **Responses are plain JSON**, unmodified.

## Handle errors

```javascript
import { TinoAuthError, TinoNotFoundError, TinoValidationError, TinoApiError } from '@tinovn/tino-sdk';

try {
  await client.domains.get(999999);
} catch (error) {
  if (error instanceof TinoNotFoundError) { /* unknown route or record */ }
  else if (error instanceof TinoAuthError) { /* re-authenticate */ }
  else if (error instanceof TinoValidationError) { console.log(error.errors); }
  else if (error instanceof TinoApiError) { console.log(error.status, error.path, error.body); }
  else throw error;
}
```

The API reports most failures with HTTP 200 and an `error` key in the body, so throwing
on the body — not the status — is the whole point of this layer.

## Binary payloads

```javascript
import { writeFile } from 'node:fs/promises';

const response = await client.request('GET', '/clientarea/downloadprofile', { raw: true });
await writeFile('profile.pdf', response.content);   // Buffer
```

## Escape hatch

```javascript
await client.request('GET', '/some/new/endpoint', { query: { page: 0 } });
await client.request('POST', '/some/new/endpoint', { body: { field: 'value' } });
```

## TypeScript

Type definitions ship alongside the source — `TinoClient`, `TinoClientOptions`,
`TinoLoginResult`, the error classes and every resource class are typed. Responses are
`any` on purpose: the API returns loosely-typed payloads and inventing strict interfaces
would be guessing.

## Configuration

| Option | Default | Purpose |
| --- | --- | --- |
| `baseUrl` | `https://api.tino.vn` | Point at a staging deployment |
| `token`, `refreshToken` | `null` | Resume a stored session |
| `timeout` | `60000` | Milliseconds per request |
| `autoRefresh` | `true` | Refresh once and retry on an auth error |
| `userAgent` | `tino-sdk-node/<version>` | Identify your integration |
| `defaultHeaders` | `{}` | Forward `X-Real-IP` etc. when proxying |
| `onTokenRefresh` | `null` | `(token, refresh) => void` persistence hook |

## Reference

* [Getting started](../../docs/getting-started.md)
* [API conventions](../../docs/conventions.md)
* [Endpoint reference](../../docs/api-contract/README.md)
