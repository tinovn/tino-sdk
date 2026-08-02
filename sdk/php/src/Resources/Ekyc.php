<?php

declare(strict_types=1);

/**
 * Domain documents & eKYC.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Domain documents & eKYC — 14 operations.
 */
class Ekyc extends Resource
{
    /**
     * TaxID HKD
     *
     * POST /ekyc/households — Bearer token required, from the API specification.
     *
     * Kiểm tra thông tin hộ kinh doanh.
     *
     * Path parameters:
     *   - taxid: id
     *
     * @param string|int $taxid id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function checkHousehold($taxid, array $body = [], array $query = [])
    {
        $path = $this->path('/ekyc/households', ['taxid' => $taxid]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Nationalid check
     *
     * POST /ekyc/checkid — Bearer token required, verified against the live API.
     *
     * Bóc tách dữ liệu cccd.
     *
     * Path parameters:
     *   - idnumber: id
     *
     * @param string|int $idnumber id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function checkNationalId($idnumber, array $body = [], array $query = [])
    {
        $path = $this->path('/ekyc/checkid', ['idnumber' => $idnumber]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Check Url eKYC Status
     *
     * POST /ekyc/check-status-url-ekyc — Bearer token required, from the API specification.
     *
     * Bóc tách dữ liệu cccd.
     *
     * Path parameters:
     *   - request_id: id
     *
     * @param string|int $requestId id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function checkUrlStatus($requestId, array $body = [], array $query = [])
    {
        $path = $this->path('/ekyc/check-status-url-ekyc', ['request_id' => $requestId]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Download document
     *
     * GET /domain/{id}/documents/{document_id}/download — Bearer token required, from the API specification.
     *
     * Download document. Content-Type: application/pdf will be returned
     *
     * Path parameters:
     *   - id: Domain ID
     *   - document_id: Document ID
     *
     * @param string|int $id Domain ID
     * @param string|int $documentId Document ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function downloadDomainDocument($id, $documentId, array $query = [])
    {
        $path = $this->path('/domain/{id}/documents/{document_id}/download', ['id' => $id, 'document_id' => $documentId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Ekyc exists check
     *
     * POST /ekyc/exists — Bearer token required, verified against the live API.
     *
     * Kiểm tra nhanh số CCCD đã có EKYC hay chưa. Trả true/false, không lộ thông tin khách
     * hàng.
     *
     * Path parameters:
     *   - idnumber: Số CCCD cần kiểm tra
     *
     * @param string|int $idnumber Số CCCD cần kiểm tra
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function exists($idnumber, array $body = [], array $query = [])
    {
        $path = $this->path('/ekyc/exists', ['idnumber' => $idnumber]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Faceid verification
     *
     * POST /ekyc/faceid/verification — Bearer token required, from the API specification.
     *
     * Kiểm tra so sánh CCCD với khuôn mặt.
     *
     * Path parameters:
     *   - request_id: Request id, Phải trùng khớp với RequestID của OCR 2 mặt CCCD
     *   - image_live: Live Face Image
     *   - image_live_1 : Live Face Image
     *   - image_live_2: Live Face Image
     *   - image_live_3: Live Face Image
     *   - token: Domain Token
     *
     * @param string|int $requestId Request id, Phải trùng khớp với RequestID của OCR 2 mặt CCCD
     * @param string|int $imageLive Live Face Image
     * @param string|int $imageLive1 Live Face Image
     * @param string|int $imageLive2 Live Face Image
     * @param string|int $imageLive3 Live Face Image
     * @param string|int $token Domain Token
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function faceIdVerification($requestId, $imageLive, $imageLive1, $imageLive2, $imageLive3, $token, array $body = [], array $query = [])
    {
        $path = $this->path('/ekyc/faceid/verification', ['request_id' => $requestId, 'image_live' => $imageLive, 'image_live_1 ' => $imageLive1, 'image_live_2' => $imageLive2, 'image_live_3' => $imageLive3, 'token' => $token]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * TaxID HKD
     *
     * GET /ekyc/households — Bearer token required, verified against the live API.
     *
     * Kiểm tra thông tin hộ kinh doanh.
     *
     * Path parameters:
     *   - taxid: id
     *
     * @param string|int $taxid id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getHousehold($taxid, array $query = [])
    {
        $path = $this->path('/ekyc/households', ['taxid' => $taxid]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get Coupon VN Free
     *
     * POST /domain/vnnic/promocode — Bearer token required, from the API specification.
     *
     * Lấy mã giảm giá tên miền miễn phí.
     *
     * Path parameters:
     *   - idnumber: Số CCCD/Mã số thuế
     *   - domain: domain name
     *
     * @param string|int $idnumber Số CCCD/Mã số thuế
     * @param string|int $domain domain name
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getVnnicPromoCode($idnumber, $domain, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/vnnic/promocode', ['idnumber' => $idnumber, 'domain' => $domain]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Get list documents
     *
     * GET /domain/{id}/documents — Bearer token required, verified against the live API.
     *
     * Get a list of all documents.
     *
     * Path parameters:
     *   - id: Domain ID
     *
     * @param string|int $id Domain ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listDomainDocuments($id, array $query = [])
    {
        $path = $this->path('/domain/{id}/documents', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * OCR Recognition
     *
     * POST /ekyc/ocr/recognition — Bearer token required, from the API specification.
     *
     * Bóc tách dữ liệu cccd.
     *
     * Path parameters:
     *   - request_id: Request id, Phải trùng khớp với RequestID OCR 2 mặt CCCD
     *   - image: Image card
     *
     * @param string|int $requestId Request id, Phải trùng khớp với RequestID OCR 2 mặt CCCD
     * @param string|int $type
     * @param string|int $image Image card
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function ocrRecognition($requestId, $type, $image, array $body = [], array $query = [])
    {
        $path = $this->path('/ekyc/ocr/recognition', ['request_id' => $requestId, 'type' => $type, 'image' => $image]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Document Signatured
     *
     * POST /domain/documents/signed — Bearer token required, from the API specification.
     *
     * Signatured upload
     *
     * Body fields:
     *   - token (string): Domain token
     *   - image (string): Signature value
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function signDocument(array $body = [], array $query = [])
    {
        return $this->call('POST', '/domain/documents/signed', ['query' => $query, 'body' => $body]);
    }

    /**
     * Company Profile Signatured
     *
     * POST /domain/documents/companyprofile — Bearer token required, from the API specification.
     *
     * Company Profile upload
     *
     * Body fields:
     *   - token (string): Domain token
     *   - image (string): Signature value
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function uploadCompanyProfile(array $body = [], array $query = [])
    {
        return $this->call('POST', '/domain/documents/companyprofile', ['query' => $query, 'body' => $body]);
    }

    /**
     * Upload document
     *
     * POST /domain/{id}/documents/{document_id}/upload — Bearer token required, from the API specification.
     *
     * Upload signed document.
     *
     * Path parameters:
     *   - id: Domain ID
     *   - document_id: Document ID
     *
     * Body fields:
     *   - filename (string): File name, for example: myfile.pdf
     *   - content (string): File content, must be base64 encoded content.
     *
     * @param string|int $id Domain ID
     * @param string|int $documentId Document ID
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function uploadDomainDocument($id, $documentId, array $body = [], array $query = [])
    {
        $path = $this->path('/domain/{id}/documents/{document_id}/upload', ['id' => $id, 'document_id' => $documentId]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Document Sign
     *
     * GET /domain/documents/view/{token} — Bearer token required, from the API specification.
     *
     * View document signed.
     *
     * Path parameters:
     *   - token: Domain token
     *
     * @param string|int $token Domain token
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function viewSignableDocument($token, array $query = [])
    {
        $path = $this->path('/domain/documents/view/{token}', ['token' => $token]);
        return $this->call('GET', $path, ['query' => $query]);
    }

}
