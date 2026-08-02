# Domain names (part 3/3)

SDK namespace: `client.domains` (Python) · `client.domains` (Node.js, PHP).

3 operation(s) in this chapter, 3 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/domain/{id}/sync` | [`sync`](#domainssync) | Bearer |
| `GET` | `/domains` | [`list`](#domainslist) | Bearer |
| `GET` | `/whois/{domain}` | [`whois`](#domainswhois) | Bearer |

---

### `domains.sync`

`GET /domain/{id}/sync` — Bearer token · verified live

**Synchronize domain**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true
}
```

</details>

**SDK**

```python
client.domains.sync(id)
```
```javascript
await client.domains.sync(id);
```
```php
$client->domains->sync($id);
```

---

### `domains.list`

`GET /domains` — Bearer token · verified live

**List Domains**

List domains under your account
Using: &page=&perpage= for pagination. page start 0

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `page` | query | integer | no | Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current. Default: `0`. |
| `perpage` | query | integer | no | Rows per page. Defaults to the account's RecordsPerPage setting. |
| `orderby` | query | string | no | Sort expression in the form `field\|DESC` or `field\|ASC`, e.g. `date\|DESC`. |
| `filter` | query | object | no | Endpoint-specific filters, serialised as filter[key]=value. |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "domains": [
  {
   "id": "200001",
   "name": "example.com",
   "expires": "2026-12-07",
   "label": "",
   "recurring_amount": "585366.00",
   "date_created": "2025-12-07",
   "status": "Active",
   "period": "1",
   "idprotection": "1",
   "autorenew": "1",
   "daytoexpire": "127"
  }
 ],
 "total": 1,
 "page": {
  "current": 0,
  "total": 1
 }
}
```

</details>

**SDK**

```python
client.domains.list()
```
```javascript
await client.domains.list();
```
```php
$client->domains->list();
```

---

### `domains.whois`

`GET /whois/{domain}` — Bearer token · verified live

**Whois Domain**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `domain` | path | string | yes | Domain |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "domain": "example.com",
 "available": false,
 "status": "",
 "whois": {
  "domain": "example.com",
  "registrar": "Web Commerce Communications Ltd.",
  "createDate": "2025-12-07T11:33:03.471Z",
  "expiredDate": "2026-12-07T11:33:03.471Z",
  "updatedDate": "2026-03-30T16:45:54.697Z",
  "nameservers": [
   "ns1.tino.vn",
   "ns2.tino.vn"
  ],
  "status": [
   "clientDeleteProhibited https://icann.org/epp#clientDeleteProhibited",
   "clientUpdateProhibited https://icann.org/epp#clientUpdateProhibited",
   "… 1 more item(s)"
  ],
  "WhoisServer": "whois.webnic.cc"
 },
 "raw": "Domain Name: example.com<br />Registry Domain ID: DO_d59b4fbe41112c70f4c72e6116f376a3-ARUBA<br />Registrar WHOIS Server: whois.webnic.cc<br />Registrar URL: https://www.webnic.cc<br />Updated Date: 2026-03-30T16:45:54.697Z<br />Creation Date: 2025-12-07T11:33:03.471Z<br />Registry Expiry Date: 2026-…"
}
```

</details>

**SDK**

```python
client.domains.whois(domain)
```
```javascript
await client.domains.whois(domain);
```
```php
$client->domains->whois($domain);
```

---
