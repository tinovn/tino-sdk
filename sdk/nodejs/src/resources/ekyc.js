// Domain documents & eKYC.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Domain documents & eKYC — 14 operations. */
export class EkycResource extends Resource {
  /**
   * TaxID HKD
   *
   * POST /ekyc/households — Bearer token required, from the API specification.
   *
   * Kiểm tra thông tin hộ kinh doanh.
   *
   * Body fields:
   *   - taxid (string, required): id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  checkHousehold(body = undefined, query = {}) {
    return this._call('POST', '/ekyc/households', { query, body });
  }

  /**
   * Nationalid check
   *
   * POST /ekyc/checkid — Bearer token required, verified against the live API.
   *
   * Bóc tách dữ liệu cccd.
   *
   * Body fields:
   *   - idnumber (string, required): id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  checkNationalId(body = undefined, query = {}) {
    return this._call('POST', '/ekyc/checkid', { query, body });
  }

  /**
   * Check Url eKYC Status
   *
   * POST /ekyc/check-status-url-ekyc — Bearer token required, verified against the live API.
   *
   * Bóc tách dữ liệu cccd.
   *
   * Body fields:
   *   - request_id (string, required): id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  checkUrlStatus(body = undefined, query = {}) {
    return this._call('POST', '/ekyc/check-status-url-ekyc', { query, body });
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
   * @param {string|number} id Domain ID
   * @param {string|number} documentId Document ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  downloadDomainDocument(id, documentId, query = {}) {
    const path = this._path('/domain/{id}/documents/{document_id}/download', { id: id, document_id: documentId });
    return this._call('GET', path, { query });
  }

  /**
   * Ekyc exists check
   *
   * POST /ekyc/exists — Bearer token required, verified against the live API.
   *
   * Kiểm tra nhanh số CCCD đã có EKYC hay chưa. Trả true/false, không lộ thông tin khách
   * hàng.
   *
   * Body fields:
   *   - idnumber (string, required): Số CCCD cần kiểm tra
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  exists(body = undefined, query = {}) {
    return this._call('POST', '/ekyc/exists', { query, body });
  }

  /**
   * Faceid verification
   *
   * POST /ekyc/faceid/verification — Bearer token required, verified against the live API.
   *
   * Kiểm tra so sánh CCCD với khuôn mặt.
   *
   * Body fields:
   *   - request_id (string, required): Request id, Phải trùng khớp với RequestID của OCR 2 mặt CCCD
   *   - image_live (string, required): Live Face Image
   *   - image_live_1 (string, required): Live Face Image
   *   - image_live_2 (string, required): Live Face Image
   *   - image_live_3 (string, required): Live Face Image
   *   - token (string, required): Domain Token
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  faceIdVerification(body = undefined, query = {}) {
    return this._call('POST', '/ekyc/faceid/verification', { query, body });
  }

  /**
   * TaxID HKD
   *
   * GET /ekyc/households — Bearer token required, verified against the live API.
   *
   * Kiểm tra thông tin hộ kinh doanh.
   *
   * Query parameters:
   *   - taxid (required): id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getHousehold(query = {}) {
    return this._call('GET', '/ekyc/households', { query });
  }

  /**
   * Get Coupon VN Free
   *
   * POST /domain/vnnic/promocode — Bearer token required, from the API specification.
   *
   * Lấy mã giảm giá tên miền miễn phí.
   *
   * Body fields:
   *   - idnumber (integer, required): Số CCCD/Mã số thuế
   *   - domain (string, required): domain name
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getVnnicPromoCode(body = undefined, query = {}) {
    return this._call('POST', '/domain/vnnic/promocode', { query, body });
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
   * @param {string|number} id Domain ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listDomainDocuments(id, query = {}) {
    const path = this._path('/domain/{id}/documents', { id: id });
    return this._call('GET', path, { query });
  }

  /**
   * OCR Recognition
   *
   * POST /ekyc/ocr/recognition — Bearer token required, verified against the live API.
   *
   * Bóc tách dữ liệu cccd.
   *
   * Body fields:
   *   - request_id (string, required): Request id, Phải trùng khớp với RequestID OCR 2 mặt CCCD
   *   - type (string, required, one of cardFront, cardBack)
   *   - image (string, required): Image card
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  ocrRecognition(body = undefined, query = {}) {
    return this._call('POST', '/ekyc/ocr/recognition', { query, body });
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
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  signDocument(body = undefined, query = {}) {
    return this._call('POST', '/domain/documents/signed', { query, body });
  }

  /**
   * Company Profile Signatured
   *
   * POST /domain/documents/companyprofile — Bearer token required, verified against the live API.
   *
   * Company Profile upload
   *
   * Body fields:
   *   - token (string): Domain token
   *   - image (string): Signature value
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  uploadCompanyProfile(body = undefined, query = {}) {
    return this._call('POST', '/domain/documents/companyprofile', { query, body });
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
   * @param {string|number} id Domain ID
   * @param {string|number} documentId Document ID
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  uploadDomainDocument(id, documentId, body = undefined, query = {}) {
    const path = this._path('/domain/{id}/documents/{document_id}/upload', { id: id, document_id: documentId });
    return this._call('POST', path, { query, body });
  }

  /**
   * Document Sign
   *
   * GET /domain/documents/view/{token} — Bearer token required, verified against the live API.
   *
   * View document signed.
   *
   * Path parameters:
   *   - token: Domain token
   * @param {string|number} token Domain token
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  viewSignableDocument(token, query = {}) {
    const path = this._path('/domain/documents/view/{token}', { token: token });
    return this._call('GET', path, { query });
  }

}
