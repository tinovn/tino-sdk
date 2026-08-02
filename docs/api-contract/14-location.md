# Countries, states & cities

SDK namespace: `client.location` (Python) · `client.location` (Node.js, PHP).

8 operation(s) in this chapter, 8 with a captured live response.

| Method | Path | SDK | Auth |
| --- | --- | --- | --- |
| `GET` | `/location/citys` | [`listAllCities`](#locationlistallcities) | public |
| `GET` | `/location/countries` | [`listCountries`](#locationlistcountries) | public |
| `GET` | `/location/state/city-v2/{name}` | [`getCityByStateNameV2`](#locationgetcitybystatenamev2) | Bearer |
| `GET` | `/location/state/city/{name}` | [`listCitiesByStateName`](#locationlistcitiesbystatename) | public |
| `GET` | `/location/state/{id}/city` | [`listCitiesByStateId`](#locationlistcitiesbystateid) | public |
| `GET` | `/location/state/{id}/city-v2` | [`listCitiesByStateIdV2`](#locationlistcitiesbystateidv2) | public |
| `GET` | `/location/{code}/state` | [`listStates`](#locationliststates) | public |
| `GET` | `/location/{code}/state-v2` | [`listStatesV2`](#locationliststatesv2) | public |

---

### `location.listAllCities`

`GET /location/citys` — Public · verified live

**Get All citys**

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "Thành phố Hà Nội": [
  "Phường Ba Đình",
  "Phường Ngọc Hà",
  "… 124 more item(s)"
 ],
 "Tỉnh Tuyên Quang": [
  "Phường Hà Giang 2",
  "Phường Hà Giang 1",
  "… 122 more item(s)"
 ],
 "Tỉnh Cao Bằng": [
  "Phường Thục Phán",
  "Phường Nùng Trí Cao",
  "… 54 more item(s)"
 ],
 "Tỉnh Thái Nguyên": [
  "Phường Đức Xuân",
  "Phường Bắc Kạn",
  "… 90 more item(s)"
 ],
 "Tỉnh Lào Cai": [
  "Phường Lào Cai",
  "Phường Cam Đường",
  "… 97 more item(s)"
 ],
 "Tỉnh Điện Biên": [
  "Phường Điện Biên Phủ",
  "Phường Mường Lay",
  "… 43 more item(s)"
 ],
 "Tỉnh Lai Châu": [
  "Phường Đoàn Kết",
  "Xã Bình Lư",
  "… 36 more item(s)"
 ],
 "Tỉnh Sơn La": [
  "Phường Tô Hiệu",
  "Phường Chiềng An",
  "… 73 more item(s)"
 ],
 "Tỉnh Phú Thọ": [
  "Phường Tân Hòa",
  "Phường Hòa Bình",
  "… 146 more item(s)"
  … 58 more line(s)
```

</details>

**SDK**

```python
client.location.list_all_cities()
```
```javascript
await client.location.listAllCities();
```
```php
$client->location->listAllCities();
```

---

### `location.listCountries`

`GET /location/countries` — Public · verified live

**countries List**

Return currencies details

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
{
 "AF": "Afghanistan",
 "AX": "Aland Islands",
 "AL": "Albania",
 "DZ": "Algeria",
 "AS": "American Samoa",
 "AD": "Andorra",
 "AO": "Angola",
 "AI": "Anguilla",
 "AQ": "Antarctica",
 "AG": "Antigua And Barbuda",
 "AR": "Argentina",
 "AM": "Armenia",
 "AW": "Aruba",
 "AU": "Australia",
 "AT": "Austria",
 "AZ": "Azerbaijan",
 "BS": "Bahamas",
 "BH": "Bahrain",
 "BD": "Bangladesh",
 "BB": "Barbados",
 "…": "226 more key(s)"
}
```

</details>

**SDK**

```python
client.location.list_countries()
```
```javascript
await client.location.listCountries();
```
```php
$client->location->listCountries();
```

---

### `location.getCityByStateNameV2`

`GET /location/state/city-v2/{name}` — Bearer token · verified live

**Get city by State Name V2**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `name` | path | string | yes | State name |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[
 {
  "id": 26882,
  "name": "Phường An Hội Tây",
  "state_id": "79",
  "code": null
 },
 {
  "id": 26878,
  "name": "Phường An Hội Đông",
  "state_id": "79",
  "code": null
 },
 "… 166 more item(s)"
]
```

</details>

**SDK**

```python
client.location.get_city_by_state_name_v2(name)
```
```javascript
await client.location.getCityByStateNameV2(name);
```
```php
$client->location->getCityByStateNameV2($name);
```

---

### `location.listCitiesByStateName`

`GET /location/state/city/{name}` — Public · verified live

**Get city by State Name**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `name` | path | string | yes | State name |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[
 {
  "id": 26882,
  "name": "Phường An Hội Tây",
  "state_id": "79",
  "code": null
 },
 {
  "id": 26878,
  "name": "Phường An Hội Đông",
  "state_id": "79",
  "code": null
 },
 "… 166 more item(s)"
]
```

</details>

**SDK**

```python
client.location.list_cities_by_state_name(name)
```
```javascript
await client.location.listCitiesByStateName(name);
```
```php
$client->location->listCitiesByStateName($name);
```

---

### `location.listCitiesByStateId`

`GET /location/state/{id}/city` — Public · verified live

**Get city**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | State id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[
 {
  "id": 4,
  "name": "Phường Ba Đình",
  "state_id": "1",
  "code": null
 },
 {
  "id": 292,
  "name": "Phường Bạch Mai",
  "state_id": "1",
  "code": null
 },
 "… 124 more item(s)"
]
```

</details>

**SDK**

```python
client.location.list_cities_by_state_id(id)
```
```javascript
await client.location.listCitiesByStateId(id);
```
```php
$client->location->listCitiesByStateId($id);
```

---

### `location.listCitiesByStateIdV2`

`GET /location/state/{id}/city-v2` — Public · verified live

**Get city V2**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `id` | path | integer | yes | State id |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[
 {
  "id": 4,
  "name": "Phường Ba Đình",
  "state_id": "1",
  "code": null
 },
 {
  "id": 292,
  "name": "Phường Bạch Mai",
  "state_id": "1",
  "code": null
 },
 "… 124 more item(s)"
]
```

</details>

**SDK**

```python
client.location.list_cities_by_state_id_v2(id)
```
```javascript
await client.location.listCitiesByStateIdV2(id);
```
```php
$client->location->listCitiesByStateIdV2($id);
```

---

### `location.listStates`

`GET /location/{code}/state` — Public · verified live

**Get state**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `code` | path | string | yes | Country Code |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[
 {
  "id": 1,
  "name": "Thành phố Hà Nội",
  "shortName": "Hà Nội",
  "code": "HNI",
  "placeType": null,
  "country": "VN",
  "order": "3"
 },
 {
  "id": 4,
  "name": "Tỉnh Cao Bằng",
  "shortName": "Cao Bằng",
  "code": "CBG",
  "placeType": null,
  "country": "VN",
  "order": "3"
 },
 "… 32 more item(s)"
]
```

</details>

**SDK**

```python
client.location.list_states(code)
```
```javascript
await client.location.listStates(code);
```
```php
$client->location->listStates($code);
```

---

### `location.listStatesV2`

`GET /location/{code}/state-v2` — Public · verified live

**Get state V2**

**Parameters**

| Name | In | Type | Required | Description |
| --- | --- | --- | --- | --- |
| `code` | path | string | yes | Country Code |

**Response** `200`

<details><summary>Live sample (values redacted, long arrays trimmed)</summary>

```json
[
 {
  "id": 1,
  "name": "Thành phố Hà Nội",
  "shortName": "Hà Nội",
  "code": "HNI",
  "placeType": null,
  "country": "VN",
  "order": "3"
 },
 {
  "id": 4,
  "name": "Tỉnh Cao Bằng",
  "shortName": "Cao Bằng",
  "code": "CBG",
  "placeType": null,
  "country": "VN",
  "order": "3"
 },
 "… 32 more item(s)"
]
```

</details>

**SDK**

```python
client.location.list_states_v2(code)
```
```javascript
await client.location.listStatesV2(code);
```
```php
$client->location->listStatesV2($code);
```

---
