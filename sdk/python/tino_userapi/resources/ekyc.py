"""Domain documents & eKYC.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class EkycResource(Resource):
    """Domain documents & eKYC — 14 operations."""

    def check_household(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """TaxID HKD

        POST /ekyc/households — Bearer token required, from the API specification.

        Kiểm tra thông tin hộ kinh doanh.

        Body fields:
          - taxid (string, required): id
        """
        return self._call("POST", "/ekyc/households", body=self._body(payload, fields))

    def check_national_id(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Nationalid check

        POST /ekyc/checkid — Bearer token required, verified against the live API.

        Bóc tách dữ liệu cccd.

        Body fields:
          - idnumber (string, required): id
        """
        return self._call("POST", "/ekyc/checkid", body=self._body(payload, fields))

    def check_url_status(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Check Url eKYC Status

        POST /ekyc/check-status-url-ekyc — Bearer token required, verified against the live API.

        Bóc tách dữ liệu cccd.

        Body fields:
          - request_id (string, required): id
        """
        return self._call("POST", "/ekyc/check-status-url-ekyc", body=self._body(payload, fields))

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

    def exists(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Ekyc exists check

        POST /ekyc/exists — Bearer token required, verified against the live API.

        Kiểm tra nhanh số CCCD đã có EKYC hay chưa. Trả true/false, không lộ thông tin khách
        hàng.

        Body fields:
          - idnumber (string, required): Số CCCD cần kiểm tra
        """
        return self._call("POST", "/ekyc/exists", body=self._body(payload, fields))

    def face_id_verification(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Faceid verification

        POST /ekyc/faceid/verification — Bearer token required, verified against the live API.

        Kiểm tra so sánh CCCD với khuôn mặt.

        Body fields:
          - request_id (string, required): Request id, Phải trùng khớp với RequestID của OCR 2 mặt CCCD
          - image_live (string, required): Live Face Image
          - image_live_1 (string, required): Live Face Image
          - image_live_2 (string, required): Live Face Image
          - image_live_3 (string, required): Live Face Image
          - token (string, required): Domain Token
        """
        return self._call("POST", "/ekyc/faceid/verification", body=self._body(payload, fields))

    def get_household(self, *, taxid: Any = None, **query: Any) -> Any:
        """TaxID HKD

        GET /ekyc/households — Bearer token required, verified against the live API.

        Kiểm tra thông tin hộ kinh doanh.

        Query parameters:
          - taxid (required): id
        """
        params = self._query({"taxid": taxid}, query)
        return self._call("GET", "/ekyc/households", query=params)

    def get_vnnic_promo_code(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Get Coupon VN Free

        POST /domain/vnnic/promocode — Bearer token required, from the API specification.

        Lấy mã giảm giá tên miền miễn phí.

        Body fields:
          - idnumber (integer, required): Số CCCD/Mã số thuế
          - domain (string, required): domain name
        """
        return self._call("POST", "/domain/vnnic/promocode", body=self._body(payload, fields))

    def list_domain_documents(self, id, **query: Any) -> Any:
        """Get list documents

        GET /domain/{id}/documents — Bearer token required, verified against the live API.

        Get a list of all documents.

        Path parameters:
          - id: Domain ID
        """
        path = self._path("/domain/{id}/documents", id=id)
        return self._call("GET", path, query=query)

    def ocr_recognition(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """OCR Recognition

        POST /ekyc/ocr/recognition — Bearer token required, verified against the live API.

        Bóc tách dữ liệu cccd.

        Body fields:
          - request_id (string, required): Request id, Phải trùng khớp với RequestID OCR 2 mặt CCCD
          - type (string, required, one of cardFront, cardBack)
          - image (string, required): Image card
        """
        return self._call("POST", "/ekyc/ocr/recognition", body=self._body(payload, fields))

    def sign_document(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Document Signatured

        POST /domain/documents/signed — Bearer token required, from the API specification.

        Signatured upload

        Body fields:
          - token (string): Domain token
          - image (string): Signature value
        """
        return self._call("POST", "/domain/documents/signed", body=self._body(payload, fields))

    def upload_company_profile(self, *, payload: Optional[dict] = None, **fields: Any) -> Any:
        """Company Profile Signatured

        POST /domain/documents/companyprofile — Bearer token required, verified against the live API.

        Company Profile upload

        Body fields:
          - token (string): Domain token
          - image (string): Signature value
        """
        return self._call("POST", "/domain/documents/companyprofile", body=self._body(payload, fields))

    def upload_domain_document(self, id, document_id, *, payload: Optional[dict] = None, **fields: Any) -> Any:
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
        return self._call("POST", path, body=self._body(payload, fields))

    def view_signable_document(self, token, **query: Any) -> Any:
        """Document Sign

        GET /domain/documents/view/{token} — Bearer token required, verified against the live API.

        View document signed.

        Path parameters:
          - token: Domain token
        """
        path = self._path("/domain/documents/view/{token}", token=token)
        return self._call("GET", path, query=query)
