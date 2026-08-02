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
   * Path parameters:
   *   - taxid: id
   * @param {string|number} taxid id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  checkHousehold(taxid, body = undefined, query = {}) {
    const path = this._path('/ekyc/households', { taxid: taxid });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} idnumber id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  checkNationalId(idnumber, body = undefined, query = {}) {
    const path = this._path('/ekyc/checkid', { idnumber: idnumber });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} requestId id
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  checkUrlStatus(requestId, body = undefined, query = {}) {
    const path = this._path('/ekyc/check-status-url-ekyc', { request_id: requestId });
    return this._call('POST', path, { query, body });
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
   * Path parameters:
   *   - idnumber: Số CCCD cần kiểm tra
   * @param {string|number} idnumber Số CCCD cần kiểm tra
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  exists(idnumber, body = undefined, query = {}) {
    const path = this._path('/ekyc/exists', { idnumber: idnumber });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} requestId Request id, Phải trùng khớp với RequestID của OCR 2 mặt CCCD
   * @param {string|number} imageLive Live Face Image
   * @param {string|number} imageLive1 Live Face Image
   * @param {string|number} imageLive2 Live Face Image
   * @param {string|number} imageLive3 Live Face Image
   * @param {string|number} token Domain Token
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  faceIdVerification(requestId, imageLive, imageLive1, imageLive2, imageLive3, token, body = undefined, query = {}) {
    const path = this._path('/ekyc/faceid/verification', { request_id: requestId, image_live: imageLive, image_live_1 : imageLive1, image_live_2: imageLive2, image_live_3: imageLive3, token: token });
    return this._call('POST', path, { query, body });
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
   * @param {string|number} taxid id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getHousehold(taxid, query = {}) {
    const path = this._path('/ekyc/households', { taxid: taxid });
    return this._call('GET', path, { query });
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
   * @param {string|number} idnumber Số CCCD/Mã số thuế
   * @param {string|number} domain domain name
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getVnnicPromoCode(idnumber, domain, body = undefined, query = {}) {
    const path = this._path('/domain/vnnic/promocode', { idnumber: idnumber, domain: domain });
    return this._call('POST', path, { query, body });
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
   * POST /ekyc/ocr/recognition — Bearer token required, from the API specification.
   *
   * Bóc tách dữ liệu cccd.
   *
   * Path parameters:
   *   - request_id: Request id, Phải trùng khớp với RequestID OCR 2 mặt CCCD
   *   - image: Image card
   * @param {string|number} requestId Request id, Phải trùng khớp với RequestID OCR 2 mặt CCCD
   * @param {string|number} type
   * @param {string|number} image Image card
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  ocrRecognition(requestId, type, image, body = undefined, query = {}) {
    const path = this._path('/ekyc/ocr/recognition', { request_id: requestId, type: type, image: image });
    return this._call('POST', path, { query, body });
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
   * POST /domain/documents/companyprofile — Bearer token required, from the API specification.
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
   * GET /domain/documents/view/{token} — Bearer token required, from the API specification.
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
