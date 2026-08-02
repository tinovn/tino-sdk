# Domain documents & eKYC

SDK namespace: `client.ekyc` (Python) · `client.ekyc` (Node.js, PHP).

14 operation(s) in this chapter, 4 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `POST` | `/domain/documents/companyprofile` | [`uploadCompanyProfile`](#ekycuploadcompanyprofile) | Bearer |
| `POST` | `/domain/documents/signed` | [`signDocument`](#ekycsigndocument) | Bearer |
| `GET` | `/domain/documents/view/{token}` | [`viewSignableDocument`](#ekycviewsignabledocument) | Bearer |
| `POST` | `/domain/vnnic/promocode` | [`getVnnicPromoCode`](#ekycgetvnnicpromocode) | Bearer |
| `GET` | `/domain/{id}/documents` | [`listDomainDocuments`](#ekyclistdomaindocuments) | Bearer |
| `GET` | `/domain/{id}/documents/{document_id}/download` | [`downloadDomainDocument`](#ekycdownloaddomaindocument) | Bearer |
| `POST` | `/domain/{id}/documents/{document_id}/upload` | [`uploadDomainDocument`](#ekycuploaddomaindocument) | Bearer |
| `POST` | `/ekyc/check-status-url-ekyc` | [`checkUrlStatus`](#ekyccheckurlstatus) | Bearer |
| `POST` | `/ekyc/checkid` | [`checkNationalId`](#ekycchecknationalid) | Bearer |
| `POST` | `/ekyc/exists` | [`exists`](#ekycexists) | Bearer |
| `POST` | `/ekyc/faceid/verification` | [`faceIdVerification`](#ekycfaceidverification) | Bearer |
| `GET` | `/ekyc/households` | [`getHousehold`](#ekycgethousehold) | Bearer |
| `POST` | `/ekyc/households` | [`checkHousehold`](#ekyccheckhousehold) | Bearer |
| `POST` | `/ekyc/ocr/recognition` | [`ocrRecognition`](#ekycocrrecognition) | Bearer |

---

### `ekyc.uploadCompanyProfile`

`POST /domain/documents/companyprofile` — Bearer token · spec only

**Company Profile Signatured**

Company Profile upload

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `token` | string | no | Domain token |
| `image` | string | no | Signature value |

```json
{
  "token": "idValue",
  "image": "idValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.ekyc.upload_company_profile(token=...)
```
```javascript
await client.ekyc.uploadCompanyProfile({ token: ... });
```
```php
$client->ekyc->uploadCompanyProfile(['token' => ...]);
```

---

### `ekyc.signDocument`

`POST /domain/documents/signed` — Bearer token · spec only

**Document Signatured**

Signatured upload

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `token` | string | no | Domain token |
| `image` | string | no | Signature value |

```json
{
  "token": "idValue",
  "image": "idValue"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.ekyc.sign_document(token=...)
```
```javascript
await client.ekyc.signDocument({ token: ... });
```
```php
$client->ekyc->signDocument(['token' => ...]);
```

---

### `ekyc.viewSignableDocument`

`GET /domain/documents/view/{token}` — Bearer token · spec only

**Document Sign**

View document signed.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `token` | path | string | yes | Domain token |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[]
```

</details>

**SDK**

```python
client.ekyc.view_signable_document(token)
```
```javascript
await client.ekyc.viewSignableDocument(token);
```
```php
$client->ekyc->viewSignableDocument($token);
```

---

### `ekyc.getVnnicPromoCode`

`POST /domain/vnnic/promocode` — Bearer token · spec only

**Get Coupon VN Free**

Lấy mã giảm giá tên miền miễn phí.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `idnumber` | path | integer | yes | Số CCCD/Mã số thuế |
| `domain` | path | string | yes | domain name |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.ekyc.get_vnnic_promo_code(idnumber, domain)
```
```javascript
await client.ekyc.getVnnicPromoCode(idnumber, domain);
```
```php
$client->ekyc->getVnnicPromoCode($idnumber, $domain);
```

---

### `ekyc.listDomainDocuments`

`GET /domain/{id}/documents` — Bearer token · verified live

**Get list documents**

Get a list of all documents.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain ID |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "error": [
  "internal_error_0"
 ]
}
```

</details>

**SDK**

```python
client.ekyc.list_domain_documents(id)
```
```javascript
await client.ekyc.listDomainDocuments(id);
```
```php
$client->ekyc->listDomainDocuments($id);
```

---

### `ekyc.downloadDomainDocument`

`GET /domain/{id}/documents/{document_id}/download` — Bearer token · spec only

**Download document**

Download document. Content-Type: application/pdf will be returned

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain ID |
| `document_id` | path | integer | yes | Document ID |

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.ekyc.download_domain_document(id, document_id)
```
```javascript
await client.ekyc.downloadDomainDocument(id, documentId);
```
```php
$client->ekyc->downloadDomainDocument($id, $documentId);
```

---

### `ekyc.uploadDomainDocument`

`POST /domain/{id}/documents/{document_id}/upload` — Bearer token · spec only

**Upload document**

Upload signed document.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | Domain ID |
| `document_id` | path | integer | yes | Document ID |

**Request body**

| Field | Type | Required | Description |
| --- | --- | --- | --- |
| `filename` | string | no | File name, for example: myfile.pdf |
| `content` | string | no | File content, must be base64 encoded content. |

```json
{
  "filename": "examplefile.pdf"
}
```

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.ekyc.upload_domain_document(id, document_id, filename=...)
```
```javascript
await client.ekyc.uploadDomainDocument(id, documentId, { filename: ... });
```
```php
$client->ekyc->uploadDomainDocument($id, $documentId, ['filename' => ...]);
```

---

### `ekyc.checkUrlStatus`

`POST /ekyc/check-status-url-ekyc` — Bearer token · spec only

**Check Url eKYC Status**

Bóc tách dữ liệu cccd.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `request_id` | path | string | yes | id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.ekyc.check_url_status(request_id)
```
```javascript
await client.ekyc.checkUrlStatus(requestId);
```
```php
$client->ekyc->checkUrlStatus($requestId);
```

---

### `ekyc.checkNationalId`

`POST /ekyc/checkid` — Bearer token · verified live

**Nationalid check**

Bóc tách dữ liệu cccd.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `idnumber` | path | string | yes | id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": false,
 "token": "<redacted>"
}
```

</details>

**SDK**

```python
client.ekyc.check_national_id(idnumber)
```
```javascript
await client.ekyc.checkNationalId(idnumber);
```
```php
$client->ekyc->checkNationalId($idnumber);
```

---

### `ekyc.exists`

`POST /ekyc/exists` — Bearer token · verified live

**Ekyc exists check**

Kiểm tra nhanh số CCCD đã có EKYC hay chưa. Trả true/false, không lộ thông tin khách hàng.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `idnumber` | path | string | yes | Số CCCD cần kiểm tra |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "success": true,
 "exists": true
}
```

</details>

**SDK**

```python
client.ekyc.exists(idnumber)
```
```javascript
await client.ekyc.exists(idnumber);
```
```php
$client->ekyc->exists($idnumber);
```

---

### `ekyc.faceIdVerification`

`POST /ekyc/faceid/verification` — Bearer token · spec only

**Faceid verification**

Kiểm tra so sánh CCCD với khuôn mặt.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `request_id` | path | string | yes | Request id, Phải trùng khớp với RequestID của OCR 2 mặt CCCD |
| `image_live` | path | string | yes | Live Face Image |
| `image_live_1 ` | path | string | yes | Live Face Image |
| `image_live_2` | path | string | yes | Live Face Image |
| `image_live_3` | path | string | yes | Live Face Image |
| `token` | path | string | yes | Domain Token |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.ekyc.face_id_verification(request_id, image_live, image_live_1, image_live_2, image_live_3, token)
```
```javascript
await client.ekyc.faceIdVerification(requestId, imageLive, imageLive1, imageLive2, imageLive3, token);
```
```php
$client->ekyc->faceIdVerification($requestId, $imageLive, $imageLive1, $imageLive2, $imageLive3, $token);
```

---

### `ekyc.getHousehold`

`GET /ekyc/households` — Bearer token · verified live

**TaxID HKD**

Kiểm tra thông tin hộ kinh doanh.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `taxid` | path | string | yes | id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "0": false,
 "error": [
  "Please enter taxid."
 ]
}
```

</details>

**SDK**

```python
client.ekyc.get_household(taxid)
```
```javascript
await client.ekyc.getHousehold(taxid);
```
```php
$client->ekyc->getHousehold($taxid);
```

---

### `ekyc.checkHousehold`

`POST /ekyc/households` — Bearer token · spec only

**TaxID HKD**

Kiểm tra thông tin hộ kinh doanh.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `taxid` | path | string | yes | id |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.ekyc.check_household(taxid)
```
```javascript
await client.ekyc.checkHousehold(taxid);
```
```php
$client->ekyc->checkHousehold($taxid);
```

---

### `ekyc.ocrRecognition`

`POST /ekyc/ocr/recognition` — Bearer token · spec only

**OCR Recognition**

Bóc tách dữ liệu cccd.

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `request_id` | path | string | yes | Request id, Phải trùng khớp với RequestID OCR 2 mặt CCCD |
| `type` | path | string | yes | One of: `cardFront`, `cardBack` |
| `image` | path | string | yes | Image card |

**Request body** — none documented; any JSON object is forwarded as-is.

**Response** `200`

_Not captured live — this endpoint changes state, or it needs data the documentation account does not have. Request shape above comes from the API specification; the response is a JSON object, and failures follow the standard error envelope described in [conventions](../conventions.md)._

**SDK**

```python
client.ekyc.ocr_recognition(request_id, type, image)
```
```javascript
await client.ekyc.ocrRecognition(requestId, type, image);
```
```php
$client->ekyc->ocrRecognition($requestId, $type, $image);
```

---
