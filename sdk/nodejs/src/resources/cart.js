// Catalogue, cart & orders.
// Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.

import { Resource } from './base.js';

/** Catalogue, cart & orders — 10 operations. */
export class CartResource extends Resource {
  /**
   * Get product configuration details
   *
   * GET /order/{product_id} — Bearer token required, verified against the live API.
   *
   * Return product details with form configuration, addons and subproducts if available.
   *
   * Path parameters:
   *   - product_id: Product ID
   * @param {string|number} productId Product ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  getProduct(productId, query = {}) {
    const path = this._path('/order/{product_id}', { product_id: productId });
    return this._call('GET', path, { query });
  }

  /**
   * List product categories
   *
   * GET /category — Bearer token required, verified against the live API.
   *
   * Return a list of product categories.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listCategories(query = {}) {
    return this._call('GET', '/category', { query });
  }

  /**
   * List product categories
   *
   * GET /categories — no authentication required, verified against the live API.
   *
   * Return a list of product categories.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listCategoryTree(query = {}) {
    return this._call('GET', '/categories', { query, authenticated: false });
  }

  /**
   * List coupon
   *
   * GET /cart/coupon — no authentication required, verified against the live API.
   *
   * Danh sách mã giảm giá đang có
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listCoupons(query = {}) {
    return this._call('GET', '/cart/coupon', { query, authenticated: false });
  }

  /**
   * Available TLDs
   *
   * GET /cart/domain/tlds — no authentication required, verified against the live API.
   *
   * List TLDs available for registration and transfer
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listDomainTlds(query = {}) {
    return this._call('GET', '/cart/domain/tlds', { query, authenticated: false });
  }

  /**
   * V2: Available TLDs
   *
   * GET /v2/cart/domain/tlds — no authentication required, verified against the live API.
   *
   * List TLDs available for registration and transfer
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listDomainTldsV2(query = {}) {
    return this._call('GET', '/v2/cart/domain/tlds', { query, authenticated: false });
  }

  /**
   * List products in category
   *
   * GET /category/{category_id}/product — Bearer token required, verified against the live API.
   *
   * Return a list of product available for purchase under requested category
   *
   * Path parameters:
   *   - category_id: Category ID
   * @param {string|number} categoryId Category ID
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  listProducts(categoryId, query = {}) {
    const path = this._path('/category/{category_id}/product', { category_id: categoryId });
    return this._call('GET', path, { query });
  }

  /**
   * Order multiple services
   *
   * POST /order — Bearer token required, from the API specification.
   *
   * Create and submit new order for multiple services
   *
   * Each item in the `items` array needs to include order `type` and parameters used
   * by one of the method listed below:
   *
   * • `POST /certificate/order` - use `certificate` for item type
   *
   * Note: The single entry point for placing an order. It accepts several items of any
   * product type in one call — hosting, VPS, domains, SSL — so the per-product and per-
   * domain order routes are not needed. Preview the price first with cart.quote, which takes
   * the same payload and creates nothing.
   *
   * Body fields:
   *   - pay_method (integer): Payment method ID
   *   - ignore_errors (boolean): Process order even if some of the items were rejected due to errors
   *   - items (array): list with order items
   *   - aff_id (integer): Affiliate ID
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  order(body = undefined, query = {}) {
    return this._call('POST', '/order', { query, body });
  }

  /**
   * Order new service
   *
   * POST /order/{product_id} — Bearer token required, from the API specification.
   *
   * DEPRECATED — kept for compatibility; see the note below for the replacement.
   *
   * Create and submit new order for selected product.
   *
   * To get available cycle and configuration options lookup product details
   * using `GET /order/@product_id`
   *
   * Note: Legacy single-product form. Use cart.order instead — it is the supported way to
   * place an order and handles multiple items in one call.
   *
   * Path parameters:
   *   - product_id: Product ID
   *
   * Body fields:
   *   - domain (string): Domain name, ie. example.com, may be optional
   *   - cycle (string): Billing period symbol
   *   - pay_method (integer): Payment method ID
   *   - custom (array): Additional options data available for sop products
   *   - promocode (string): Promotion code
   *   - aff_id (integer): Affiliate ID
   * @param {string|number} productId Product ID
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  orderProduct(productId, body = undefined, query = {}) {
    const path = this._path('/order/{product_id}', { product_id: productId });
    return this._call('POST', path, { query, body });
  }

  /**
   * Get order quote
   *
   * POST /quote — Bearer token required, verified against the live API.
   *
   * Calculate order cost and recurring prices for selected items.
   * Use the same parameters as for `POST /order`
   *
   * Note: Price preview for a cart.order payload. Returns the subtotal, tax, discounts and
   * recurring amounts without creating an order or an invoice.
   *
   * Body fields:
   *   - pay_method (integer): Payment method ID
   *   - output (string): Type of output, default is short. Possible options    short</code> - Basic details about the item in cart</li>  config</code>- Basic details and form components</li>  full</code> - All details available in cart</li> </ul>
   *   - items (array): list with order items
   * @param {object} [body] Request payload.
   * @param {object} [query] Extra query-string parameters.
   * @returns {Promise<any>}
   */
  quote(body = undefined, query = {}) {
    return this._call('POST', '/quote', { query, body });
  }

}
