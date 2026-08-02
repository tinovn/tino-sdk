// Support tickets, news & knowledgebase.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Support tickets, news & knowledgebase — 13 operations. */
export class SupportResource extends Resource {
  /**
   * Close ticket
   *
   * PUT /tickets/{number}/close — Bearer token required, from the API specification.
   *
   * Send request to close a ticket
   *
   * Body fields:
   *   - number (integer): Ticket number
   * @param {string|number} number
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  closeTicket(number, body = undefined, query = {}) {
    const path = this._path('/tickets/{number}/close', { number: number });
    return this._call('PUT', path, { query, body });
  }

  /**
   * Create Ticket
   *
   * POST /tickets — Bearer token required, from the API specification.
   *
   * Submit new ticket
   *
   * Body fields:
   *   - dept_id (integer): Department id
   *   - subject (string): Ticket subject
   *   - body (string): Ticket message
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  createTicket(body = undefined, query = {}) {
    return this._call('POST', '/tickets', { query, body });
  }

  /**
   * Ticket attachment
   *
   * GET /ticket/attachment/{file} — Bearer token required, verified against the live API.
   *
   * Get ticket attachment
   *
   * Path parameters:
   *   - file: Attachment id
   *
   * Query parameters:
   *   - number: Ticket number
   * @param {string|number} file Attachment id
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getAttachment(file, query = {}) {
    const path = this._path('/ticket/attachment/{file}', { file: file });
    return this._call('GET', path, { query });
  }

  /**
   * Get knowledgebase article
   *
   * GET /knowledgebase/article/{article_id} — Bearer token required, verified against the live API.
   *
   * Returns an article details
   * @param {string|number} articleId
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getKbArticle(articleId, query = {}) {
    const path = this._path('/knowledgebase/article/{article_id}', { article_id: articleId });
    return this._call('GET', path, { query });
  }

  /**
   * Get knowledgebase category details
   *
   * GET /knowledgebase/{category_id} — Bearer token required, verified against the live API.
   *
   * Returns subcategories and articles of the knowledgebase category
   * @param {string|number} categoryId
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getKbCategory(categoryId, query = {}) {
    const path = this._path('/knowledgebase/{category_id}', { category_id: categoryId });
    return this._call('GET', path, { query });
  }

  /**
   * Get news item
   *
   * GET /news/{news_id} — Bearer token required, from the API specification.
   *
   * Returns details of the news item
   * @param {string|number} newsId
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getNews(newsId, query = {}) {
    const path = this._path('/news/{news_id}', { news_id: newsId });
    return this._call('GET', path, { query });
  }

  /**
   * Ticket details
   *
   * GET /tickets/{number} — Bearer token required, verified against the live API.
   *
   * Get ticket details, including all replies
   *
   * Path parameters:
   *   - number: Ticket number
   * @param {string|number} number Ticket number
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getTicket(number, query = {}) {
    const path = this._path('/tickets/{number}', { number: number });
    return this._call('GET', path, { query });
  }

  /**
   * List ticket departments
   *
   * GET /ticket/departments — Bearer token required, verified against the live API.
   *
   * Get the list of ticket departments
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listDepartments(query = {}) {
    return this._call('GET', '/ticket/departments', { query });
  }

  /**
   * List all knowledgebase categories
   *
   * GET /knowledgebase — Bearer token required, verified against the live API.
   *
   * Returns list all knowledgebase categories
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listKbCategories(query = {}) {
    return this._call('GET', '/knowledgebase', { query });
  }

  /**
   * List News
   *
   * GET /news — Bearer token required, verified against the live API.
   *
   * Query parameters:
   *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
   *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
   *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
   *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listNews(query = {}) {
    return this._call('GET', '/news', { query });
  }

  /**
   * List Tickets
   *
   * GET /tickets — Bearer token required, verified against the live API.
   *
   * List support tickets under my account
   *
   * Query parameters:
   *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
   *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
   *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
   *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listTickets(query = {}) {
    return this._call('GET', '/tickets', { query });
  }

  /**
   * Re-open ticket
   *
   * PUT /tickets/{number}/open — Bearer token required, from the API specification.
   *
   * Try to re-open closed ticket
   *
   * Body fields:
   *   - number (integer): Ticket number
   * @param {string|number} number
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  reopenTicket(number, body = undefined, query = {}) {
    const path = this._path('/tickets/{number}/open', { number: number });
    return this._call('PUT', path, { query, body });
  }

  /**
   * Create Reply
   *
   * POST /tickets/{number} — Bearer token required, from the API specification.
   *
   * Reply to ticket
   *
   * Body fields:
   *   - number (integer): Ticket number
   *   - body (string): Reply message
   * @param {string|number} number
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  replyTicket(number, body = undefined, query = {}) {
    const path = this._path('/tickets/{number}', { number: number });
    return this._call('POST', path, { query, body });
  }

}
