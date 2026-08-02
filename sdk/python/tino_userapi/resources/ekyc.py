"""Domain documents & eKYC.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class EkycResource(Resource):
    """Domain documents & eKYC — 14 operations."""

    def check_household(self, taxid, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """TaxID HKD

        POST /ekyc/households — Bearer token required, from the API specification.

        Kiểm tra thông tin hộ kinh doanh.

        Path parameters:
          - taxid: id
        """
        path = self._path("/ekyc/households", taxid=taxid)
        return self._call("POST", path, body=self._body(body, fields))

    def check_national_id(self, idnumber, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Nationalid check

        POST /ekyc/checkid — Bearer token required, verified against the live API.

        Bóc tách dữ liệu cccd.

        Path parameters:
          - idnumber: id
        """
        path = self._path("/ekyc/checkid", idnumber=idnumber)
        return self._call("POST", path, body=self._body(body, fields))

    def check_url_status(self, request_id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Check Url eKYC Status

        POST /ekyc/check-status-url-ekyc — Bearer token required, from the API specification.

        Bóc tách dữ liệu cccd.

        Path parameters:
          - request_id: id
        """
        path = self._path("/ekyc/check-status-url-ekyc", request_id=request_id)
        return self._call("POST", path, body=self._body(body, fields))

    def download_domain_document(self, id, document_id, **query: Any) -> Any:
        """Download document

        GET /domain/{id}/documents/{document_id}/download — Bearer token required, from the API specification.

        Download document. Content-Type: application/pdf will be returned

        Path parameters:
          - id: Domain ID
          - document_id: Document ID
        """
        path = self._path("/domain/{id}/documents/{document_id}/download", id=id, document_id=document_id)
        return self._call("GET", path, query=query)

    def exists(self, idnumber, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Ekyc exists check

        POST /ekyc/exists — Bearer token required, verified against the live API.

        Kiểm tra nhanh số CCCD đã có EKYC hay chưa. Trả true/false, không lộ thông tin khách
        hàng.

        Path parameters:
          - idnumber: Số CCCD cần kiểm tra
        """
        path = self._path("/ekyc/exists", idnumber=idnumber)
        return self._call("POST", path, body=self._body(body, fields))

    def face_id_verification(self, request_id, image_live, image_live_1, image_live_2, image_live_3, token, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Faceid verification

        POST /ekyc/faceid/verification — Bearer token required, from the API specification.

        Kiểm tra so sánh CCCD với khuôn mặt.

        Path parameters:
          - request_id: Request id, Phải trùng khớp với RequestID của OCR 2 mặt CCCD
          - image_live: Live Face Image
          - image_live_1 : Live Face Image
          - image_live_2: Live Face Image
          - image_live_3: Live Face Image
          - token: Domain Token
        """
        path = self._path("/ekyc/faceid/verification", request_id=request_id, image_live=image_live, image_live_1 =image_live_1, image_live_2=image_live_2, image_live_3=image_live_3, token=token)
        return self._call("POST", path, body=self._body(body, fields))

    def get_household(self, taxid, **query: Any) -> Any:
        """TaxID HKD

        GET /ekyc/households — Bearer token required, verified against the live API.

        Kiểm tra thông tin hộ kinh doanh.

        Path parameters:
          - taxid: id
        """
        path = self._path("/ekyc/households", taxid=taxid)
        return self._call("GET", path, query=query)

    def get_vnnic_promo_code(self, idnumber, domain, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Get Coupon VN Free

        POST /domain/vnnic/promocode — Bearer token required, from the API specification.

        Lấy mã giảm giá tên miền miễn phí.

        Path parameters:
          - idnumber: Số CCCD/Mã số thuế
          - domain: domain name
        """
        path = self._path("/domain/vnnic/promocode", idnumber=idnumber, domain=domain)
        return self._call("POST", path, body=self._body(body, fields))

    def list_domain_documents(self, id, **query: Any) -> Any:
        """Get list documents

        GET /domain/{id}/documents — Bearer token required, verified against the live API.

        Get a list of all documents.

        Path parameters:
          - id: Domain ID
        """
        path = self._path("/domain/{id}/documents", id=id)
        return self._call("GET", path, query=query)

    def ocr_recognition(self, request_id, type, image, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """OCR Recognition

        POST /ekyc/ocr/recognition — Bearer token required, from the API specification.

        Bóc tách dữ liệu cccd.

        Path parameters:
          - request_id: Request id, Phải trùng khớp với RequestID OCR 2 mặt CCCD
          - image: Image card
        """
        path = self._path("/ekyc/ocr/recognition", request_id=request_id, type=type, image=image)
        return self._call("POST", path, body=self._body(body, fields))

    def sign_document(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Document Signatured

        POST /domain/documents/signed — Bearer token required, from the API specification.

        Signatured upload

        Body fields:
          - token (string): Domain token
          - image (string): Signature value
        """
        return self._call("POST", "/domain/documents/signed", body=self._body(body, fields))

    def upload_company_profile(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Company Profile Signatured

        POST /domain/documents/companyprofile — Bearer token required, from the API specification.

        Company Profile upload

        Body fields:
          - token (string): Domain token
          - image (string): Signature value
        """
        return self._call("POST", "/domain/documents/companyprofile", body=self._body(body, fields))

    def upload_domain_document(self, id, document_id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Upload document

        POST /domain/{id}/documents/{document_id}/upload — Bearer token required, from the API specification.

        Upload signed document.

        Path parameters:
          - id: Domain ID
          - document_id: Document ID

        Body fields:
          - filename (string): File name, for example: myfile.pdf
          - content (string): File content, must be base64 encoded content.
        """
        path = self._path("/domain/{id}/documents/{document_id}/upload", id=id, document_id=document_id)
        return self._call("POST", path, body=self._body(body, fields))

    def view_signable_document(self, token, **query: Any) -> Any:
        """Document Sign

        GET /domain/documents/view/{token} — Bearer token required, from the API specification.

        View document signed.

        Path parameters:
          - token: Domain token
        """
        path = self._path("/domain/documents/view/{token}", token=token)
        return self._call("GET", path, query=query)
