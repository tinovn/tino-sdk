# Languages & translations

SDK namespace: `client.languages` (Python) · `client.languages` (Node.js, PHP).

3 operation(s) in this chapter, 3 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/languages` | [`list`](#languageslist) | public |
| `GET` | `/languages/file/{langname}` | [`getFile`](#languagesgetfile) | public |
| `GET` | `/languages/translate` | [`getBillingCycleLabels`](#languagesgetbillingcyclelabels) | public |

---

### `languages.list`

`GET /languages` — Public · verified live

**List language**

Return languages details

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "languages": [
  {
   "id": "2",
   "parent_id": "0",
   "target": "user",
   "name": "english",
   "status": "1",
   "direction": "ltr",
   "iso": "en",
   "date_format": ""
  },
  {
   "id": "7",
   "parent_id": "2",
   "target": "user",
   "name": "vietnamese",
   "status": "1",
   "direction": "ltr",
   "iso": "vi",
   "date_format": ""
  }
 ]
}
```

</details>

**SDK**

```python
client.languages.list()
```
```javascript
await client.languages.list();
```
```php
$client->languages->list();
```

---

### `languages.getFile`

`GET /languages/file/{langname}` — Public · verified live

**Get Language File**

List support tickets under my account

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `langname` | path | string | yes | lang name |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "Accepted": "Chấp nhận",
 "Active": "Kích hoạt",
 "Annually": "12 tháng",
 "Answered": "Đã trả lời",
 "Cancelled": "Huỷ bỏ",
 "Client-Reply": "Khách hàng trả lời",
 "Closed": "Đóng",
 "Collections": "Collections",
 "Credited": "Đã chuyển vào ví",
 "Dead": "Huỷ bỏ",
 "Draft": "Nháp",
 "Expired": "Hết hạn",
 "Fraud": "Gian lận",
 "Free": "Miễn phí",
 "Grace": "Grace",
 "In-Progress": "Đang xử lý",
 "Invoiced": "Đã phát hành hoá đơn",
 "Manager Service": "Quản lý dịch vụ",
 "Monthly": "Hàng tháng",
 "Open": "Mở",
 "…": "331 more key(s)"
}
```

</details>

**SDK**

```python
client.languages.get_file(langname)
```
```javascript
await client.languages.getFile(langname);
```
```php
$client->languages->getFile($langname);
```

---

### `languages.getBillingCycleLabels`

`GET /languages/translate` — Public · verified live

**Billing cycle labels in the active language**

Return languages translate

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `key` | path | string | yes | lang keyword |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "d": "Ngày",
 "m": "1 tháng",
 "a": "1 năm",
 "q": "3 tháng",
 "s": "6 tháng",
 "t": "3 năm",
 "p4": "4 năm",
 "p5": "5 năm"
}
```

</details>

**SDK**

```python
client.languages.get_billing_cycle_labels(key)
```
```javascript
await client.languages.getBillingCycleLabels(key);
```
```php
$client->languages->getBillingCycleLabels($key);
```

---
