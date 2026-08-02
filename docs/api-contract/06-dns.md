# DNS zones & records

SDK namespace: `client.dns` (Python) · `client.dns` (Node.js, PHP).

12 operation(s) in this chapter, 9 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/dns` | [`listZonesAll`](#dnslistzonesall) | Bearer |
| `GET` | `/dns/templates` | [`listTemplates`](#dnslisttemplates) | Bearer |
| `GET` | `/service/{service_id}/dns` | [`listZones`](#dnslistzones) | Bearer |
| `POST` | `/service/{service_id}/dns` | [`createZone`](#dnscreatezone) | Bearer |
| `DELETE` | `/service/{service_id}/dns/{zone_id}` | [`deleteZone`](#dnsdeletezone) | Bearer |
| `GET` | `/service/{service_id}/dns/{zone_id}` | [`getZone`](#dnsgetzone) | Bearer |
| `GET` | `/service/{service_id}/dns/{zone_id}/dnssec` | [`getZoneDnssec`](#dnsgetzonednssec) | Bearer |
| `PUT` | `/service/{service_id}/dns/{zone_id}/dnssec` | [`updateZoneDnssec`](#dnsupdatezonednssec) | Bearer |
| `GET` | `/service/{service_id}/dns/{zone_id}/password` | [`resetZonePassword`](#dnsresetzonepassword) | Bearer |
| `POST` | `/service/{service_id}/dns/{zone_id}/records` | [`createRecord`](#dnscreaterecord) | Bearer |
| `DELETE` | `/service/{service_id}/dns/{zone_id}/records/{record_id}` | [`deleteRecord`](#dnsdeleterecord) | Bearer |
| `PUT` | `/service/{service_id}/dns/{zone_id}/records/{record_id}` | [`updateRecord`](#dnsupdaterecord) | Bearer |

---

### `dns.listZonesAll`

`GET /dns` — Bearer token · verified live

**List DNS**

Returns a list of all DNS

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "service_ids": [
  "100003"
 ],
 "zones": [
  {
   "domain_id": "500001",
   "name": "example.com",
   "service_id": "100003"
  }
 ]
}
```

</details>

**SDK**

```python
client.dns.list_zones_all()
```
```javascript
await client.dns.listZonesAll();
```
```php
$client->dns->listZonesAll();
```

---

### `dns.listTemplates`

`GET /dns/templates` — Bearer token · verified live

**DNS Templates**

Returns details of the DNS zone

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "templates": {
  "1": [
   {
    "id": "1",
    "template": "Default template",
    "flags": "12",
    "name": " {domain}",
    "type": "A",
    "content": "<redacted>",
    "ttl": "3600",
    "prio": "0",
    "record_id": "1",
    "sort_order": "0"
   },
   {
    "id": "1",
    "template": "Default template",
    "flags": "12",
    "name": "www",
    "type": "CNAME",
    "content": "<redacted>",
    "ttl": "3600",
    "prio": "0",
    "record_id": "2",
    "sort_order": "0"
   },
   "… 2 more item(s)"
  ],
  "4": [
   {
    "id": "4",
    "template": "LadiPage",
    "flags": "0",
    "name": "www.{domain}",
    "type": "CNAME",
    "content": "<redacted>",
    "ttl": "3600",
    "prio": "0",
    "record_id": "16",
    "sort_order": "0"
   },
   {
    "id": "4",
    "template": "LadiPage",
  … 66 more line(s)
```

</details>

**SDK**

```python
client.dns.list_templates()
```
```javascript
await client.dns.listTemplates();
```
```php
$client->dns->listTemplates();
```

---

### `dns.listZones`

`GET /service/{service_id}/dns` — Bearer token · verified live

**List DNS for service**

Returns a list of DNS zones under the service

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `service_id` | path | integer | yes | Service ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "zones": [
  {
   "domain_id": "500001",
   "name": "example.com",
   "service_id": "100003"
  }
 ]
}
```

</details>

**SDK**

```python
client.dns.list_zones(service_id)
```
```javascript
await client.dns.listZones(serviceId);
```
```php
$client->dns->listZones($serviceId);
```

---

### `dns.createZone`

`POST /service/{service_id}/dns` — Bearer token · spec only

**Add DNS Zone**

Creates a new DNS zone

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `service_id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `service_id` | integer | no | Service ID |
| `name` | string | no | Zone name |

```json
{
  "service_id": "service_idValue",
  "name": "testzone.com"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.dns.create_zone(service_id, service_id=...)
```
```javascript
await client.dns.createZone(serviceId, { service_id: ... });
```
```php
$client->dns->createZone($serviceId, ['service_id' => ...]);
```

---

### `dns.deleteZone`

`DELETE /service/{service_id}/dns/{zone_id}` — Bearer token · spec only

**Remove DNS zone**

Deletes the selected DNS zone

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `service_id` | path | integer | yes | Service ID |
| `zone_id` | path | integer | yes | Zone ID |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.dns.delete_zone(service_id, zone_id)
```
```javascript
await client.dns.deleteZone(serviceId, zoneId);
```
```php
$client->dns->deleteZone($serviceId, $zoneId);
```

---

### `dns.getZone`

`GET /service/{service_id}/dns/{zone_id}` — Bearer token · verified live

**Get DNS details**

Returns details of the DNS zone

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `service_id` | path | integer | yes | Service ID |
| `zone_id` | path | integer | yes | Zone ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "service_id": "100003",
 "name": "example.com",
 "records": {
  "0": {
   "id": 910001,
   "domain_id": 500001,
   "name": "example.com",
   "type": "SOA",
   "content": "<redacted>",
   "ttl": 7200,
   "prio": 0,
   "change_date": 0,
   "priority": 0
  },
  "1": {
   "id": 337915,
   "domain_id": 500001,
   "name": "example.com",
   "type": "NS",
   "content": "<redacted>",
   "ttl": 86400,
   "prio": 0,
   "change_date": 0,
   "priority": 0
  },
  "2": {
   "id": 337916,
   "domain_id": 500001,
   "name": "example.com",
   "type": "NS",
   "content": "<redacted>",
   "ttl": 86400,
   "prio": 0,
   "change_date": 0,
   "priority": 0
  },
  "3": {
   "id": 337917,
   "domain_id": 500001,
   "name": "webmail.example.com",
   "type": "CNAME",
   "content": "<redacted>",
   "ttl": 3600,
   "prio": 0,
  … 126 more line(s)
```

</details>

**SDK**

```python
client.dns.get_zone(service_id, zone_id)
```
```javascript
await client.dns.getZone(serviceId, zoneId);
```
```php
$client->dns->getZone($serviceId, $zoneId);
```

---

### `dns.getZoneDnssec`

`GET /service/{service_id}/dns/{zone_id}/dnssec` — Bearer token · verified live

**Get DNS DNSSEC**

Returns details of the DNS DNSSEC

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `service_id` | path | integer | yes | Service ID |
| `zone_id` | path | integer | yes | Zone ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "dnssec": false
}
```

</details>

**SDK**

```python
client.dns.get_zone_dnssec(service_id, zone_id)
```
```javascript
await client.dns.getZoneDnssec(serviceId, zoneId);
```
```php
$client->dns->getZoneDnssec($serviceId, $zoneId);
```

---

### `dns.updateZoneDnssec`

`PUT /service/{service_id}/dns/{zone_id}/dnssec` — Bearer token · spec only

**UPDATE DNS DNSSEC**

Returns details of the DNS DNSSEC

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `service_id` | path | integer | yes | Service ID |
| `zone_id` | path | integer | yes | Zone ID |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `widgetdo` | string | yes | widgetdo action |

```json
{
  "widgetdo": "<widgetdo>"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.dns.update_zone_dnssec(service_id, zone_id, widgetdo=...)
```
```javascript
await client.dns.updateZoneDnssec(serviceId, zoneId, { widgetdo: ... });
```
```php
$client->dns->updateZoneDnssec($serviceId, $zoneId, ['widgetdo' => ...]);
```

---

### `dns.resetZonePassword`

`GET /service/{service_id}/dns/{zone_id}/password` — Bearer token · verified live

**Change Zone DNS**

Returns details of the DNS zone

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `service_id` | path | integer | yes | Service ID |
| `zone_id` | path | integer | yes | Zone ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "newpass": "<redacted>"
}
```

</details>

**SDK**

```python
client.dns.reset_zone_password(service_id, zone_id)
```
```javascript
await client.dns.resetZonePassword(serviceId, zoneId);
```
```php
$client->dns->resetZonePassword($serviceId, $zoneId);
```

---

### `dns.createRecord`

`POST /service/{service_id}/dns/{zone_id}/records` — Bearer token · verified live

**Add DNS Record**

Creates a new record in the DNS zone

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `service_id` | path | string | yes | — |
| `zone_id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `service_id` | integer | no | Service ID |
| `zone_id` | integer | no | Zone ID |
| `name` | string | no | Record name |
| `ttl` | integer | no | Record ttl |
| `priority` | integer | no | Priority of the record |
| `type` | string | no | Record type |
| `content` | string | no | Contents of the record |

```json
{
  "service_id": "service_idValue",
  "zone_id": "zone_idValue",
  "name": "example.com",
  "ttl": 3600,
  "priority": 10,
  "type": "A",
  "content": "192.168.1.2"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "record": {
  "name": "tino-sdk-capture",
  "type": "TXT",
  "ttl": 3600,
  "priority": 0,
  "content": "<redacted>"
 },
 "info": [
  [
   "dnsnewrecordadded",
   "TXT"
  ]
 ]
}
```

</details>

**SDK**

```python
client.dns.create_record(service_id, zone_id, service_id=...)
```
```javascript
await client.dns.createRecord(serviceId, zoneId, { service_id: ... });
```
```php
$client->dns->createRecord($serviceId, $zoneId, ['service_id' => ...]);
```

---

### `dns.deleteRecord`

`DELETE /service/{service_id}/dns/{zone_id}/records/{record_id}` — Bearer token · verified live

**Remove DNS Record**

Removes the selected DNS zone record

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `service_id` | path | integer | yes | Service ID |
| `zone_id` | path | integer | yes | Zone ID |
| `record_id` | path | integer | yes | Record ID |

**Request body** — none documented; any JSON object is forwarded as-is.

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
client.dns.delete_record(service_id, zone_id, record_id)
```
```javascript
await client.dns.deleteRecord(serviceId, zoneId, recordId);
```
```php
$client->dns->deleteRecord($serviceId, $zoneId, $recordId);
```

---

### `dns.updateRecord`

`PUT /service/{service_id}/dns/{zone_id}/records/{record_id}` — Bearer token · verified live

**Edit DNS Record**

Edits the selected DNS zone record

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `service_id` | path | string | yes | — |
| `zone_id` | path | string | yes | — |
| `record_id` | path | string | yes | — |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `service_id` | integer | no | Service ID |
| `zone_id` | integer | no | Zone ID |
| `record_id` | integer | no | Record ID |
| `name` | string | no | Record name |
| `ttl` | integer | no | Record ttl |
| `priority` | integer | no | Priority of the record |
| `type` | string | no | Record type |
| `content` | string | no | Contents of the record |

```json
{
  "service_id": "service_idValue",
  "zone_id": "zone_idValue",
  "record_id": "record_idValue",
  "name": "example.com",
  "ttl": 3600,
  "priority": 10,
  "type": "A",
  "content": "192.168.1.2"
}
```

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "record": {
  "id": "419192",
  "type": "TXT",
  "ttl": 3600,
  "name": "tino-sdk-capture",
  "priority": 0,
  "content": "<redacted>"
 },
 "info": [
  "dnsrecordupdated"
 ]
}
```

</details>

**SDK**

```python
client.dns.update_record(service_id, zone_id, record_id, service_id=...)
```
```javascript
await client.dns.updateRecord(serviceId, zoneId, recordId, { service_id: ... });
```
```php
$client->dns->updateRecord($serviceId, $zoneId, $recordId, ['service_id' => ...]);
```

---
