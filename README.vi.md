# Tino SDK

> [English version](README.md)

SDK chính thức và tài liệu API contract cho **Tino UserAPI** — API khách hàng phía sau
[tino.vn](https://tino.vn), dùng để quản lý dịch vụ, tên miền, hoá đơn và ticket hỗ trợ
của một tài khoản Tino.

```
Base URL   https://api.tino.vn
Auth       Authorization: Bearer <JWT>
Phạm vi    255 endpoint · 17 nhóm tài nguyên
```

| | |
| --- | --- |
| 🐍 **Python** | [`sdk/python`](sdk/python) — 3.8+, không phụ thuộc thư viện ngoài |
| 🟩 **Node.js** | [`sdk/nodejs`](sdk/nodejs) — 18+, ESM, có type definitions, không phụ thuộc |
| 🐘 **PHP** | [`sdk/php`](sdk/php) — 7.4+, PSR-4, không phụ thuộc |
| 📖 **Tài liệu** | [`docs/`](docs/README.md) — từng endpoint kèm request, response và cách gọi bằng SDK |
| 🤖 **Skill cho agent** | [`skills/tino-userapi`](skills/README.md) — cắm thẳng vào Paperclip, Claude Code, Codex |

## Bắt đầu nhanh

```python
from tino_userapi import TinoClient

client = TinoClient()
client.request_login_otp("you@example.com")          # mã gửi qua Zalo hoặc email
client.verify_login_otp("you@example.com", "123456")

print(client.billing.get_balance())
print(client.domains.list())
client.support.create_ticket(dept_id=2, subject="Xin chào", body="…")
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

Cả ba SDK đều có cùng bề mặt: `client.<nhóm>.<thao_tác>()`, mỗi nhóm tương ứng một mảng
của API. Danh sách đầy đủ xem tại
[`docs/api-contract/README.md`](docs/api-contract/README.md).

## Vì sao nên dùng SDK thay vì gọi HTTP trực tiếp

Tino UserAPI có vài điểm dễ sập bẫy. SDK xử lý sẵn:

* **Lỗi trả về kèm HTTP 200.** `{"error":["unauthorized"]}` vẫn là `200 OK`. SDK đọc
  body chứ không chỉ nhìn status, rồi ném ra lỗi có kiểu (`TinoAuthError`,
  `TinoNotFoundError`, `TinoValidationError`, …) thay vì đưa cho bạn một response
  "thành công" giả.
* **Token xoay vòng.** Mỗi lần refresh sẽ vô hiệu hoá *cả* refresh token cũ *lẫn* access
  token cũ. SDK đổi cả cặp một lượt, tự thử lại request đã hỏng đúng một lần, và gọi
  hook `on_token_refresh` để bạn lưu lại cặp mới.
* **Query encode theo kiểu PHP.** `filter[hide_cancelled]=1`, `key[]=a&key[]=b`, boolean
  thành `1`/`0`. Bạn truyền cấu trúc dữ liệu bình thường, SDK lo phần mã hoá.
* **Phân trang gửi đi tính từ 0, trả về tính từ 1.** SDK ghi rõ điều này thay vì âm thầm
  "sửa hộ", nên code của bạn luôn đoán trước được.
* **Có endpoint trả nhị phân.** PDF và certificate được trả về dạng bytes gốc, không bị
  decode hỏng thành UTF-8.

## Cấu trúc repo

```
spec/
  tino-userapi-catalog.json    catalog chuẩn — nguồn sự thật duy nhất (255 endpoint)
  response-samples.json        response thật đã che thông tin, dùng làm ví dụ
docs/
  getting-started.md           base URL, các luồng đăng nhập, vòng đời token
  conventions.md               lỗi, phân trang, filter, kiểu dữ liệu, GET có tác dụng phụ
  api-contract/                tham chiếu từng endpoint, mỗi nhóm một chương
sdk/
  python/  nodejs/  php/       phần lõi viết tay + phần resource sinh tự động
tools/
  build-catalog.py             đặc tả + corrections -> catalog
  generate-sdk.py              catalog -> lớp resource cho cả ba ngôn ngữ
  generate-docs.py             catalog + samples -> docs/api-contract/
  sanitize-samples.py          response thật -> ví dụ công khai (đã lọc dữ liệu cá nhân)
skills/
  tino-userapi/                skill cho agent (SKILL.md + references)
examples/                      script chạy được từ đầu đến cuối
```

## Tài liệu được dựng thế nào

Mỗi endpoint được đối chiếu từ ba góc: đặc tả chính thức của API, cách client của Tino
gọi nó trong production, và những gì dịch vụ thật sự trả về — khi ba nguồn mâu thuẫn,
kết quả gọi thật là chuẩn.

195 endpoint đã được gọi thật vào `https://api.tino.vn` bằng một tài khoản thật; response
được ghi lại, che thông tin nhạy cảm và nhúng vào tài liệu. Đợt quét bao gồm cả endpoint ghi — đặt hàng, ticket, bản ghi DNS, thao tác nguồn VM,
huỷ dịch vụ — trên tài khoản sandbox, mỗi bước đều khôi phục lại thứ nó đã đổi. Số còn
lại đánh dấu *spec only*: cần dữ liệu sandbox không có, hoặc sẽ kết thúc phiên đăng nhập.

Catalog đã được commit sẵn, nên clone về là chạy lại được bộ sinh mà không cần thêm gì.

## Sinh lại

```bash
python3 tools/build-catalog.py <specification.json>   # -> spec/tino-userapi-catalog.json
python3 tools/generate-sdk.py                         # catalog -> sdk/*/resources
python3 tools/generate-docs.py                        # catalog + samples -> docs/api-contract
```

Phần lõi viết tay của SDK (transport, auth, error, client) không bao giờ bị bộ sinh động
tới; chỉ lớp resource theo từng endpoint là sinh tự động — đó là thứ giữ cho ba ngôn ngữ
luôn khớp nhau.

## Phát hành

Gắn tag là publish cả ba gói:

```bash
git tag v1.0.0 && git push origin v1.0.0
```

[`.github/workflows/release.yml`](.github/workflows/release.yml) kiểm tra tag khớp
version của cả ba gói, chạy đủ ba bộ test, xác nhận code sinh vẫn khớp catalog, rồi mới
publish. PyPI dùng Trusted Publishing nên không lưu token; npm cần secret `NPM_TOKEN`;
Packagist tự cập nhật theo tag sau khi repo được submit một lần.

## Trạng thái

Phiên bản 1.0.0. Catalog và lớp resource của cả ba SDK đã đầy đủ; response mẫu phủ 195
endpoint đã gọi được trên tài khoản sandbox. Hoan nghênh đóng góp thêm response mẫu đã kiểm
chứng cho các endpoint còn lại — quy tắc che dữ liệu mà một mẫu phải vượt qua nằm ở
[`tools/sanitize-samples.py`](tools/sanitize-samples.py).

## Giấy phép

MIT — xem [LICENSE](LICENSE).
