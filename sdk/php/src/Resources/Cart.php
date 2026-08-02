<?php

declare(strict_types=1);

/**
 * Catalogue, cart & orders.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Catalogue, cart & orders — 10 operations.
 */
class Cart extends Resource
{
    /**
     * Get product configuration details
     *
     * GET /order/{product_id} — Bearer token required, verified against the live API.
     *
     * Return product details with form configuration, addons and subproducts if available.
     *
     * Path parameters:
     *   - product_id: Product ID
     *
     * @param string|int $productId Product ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getProduct($productId, array $query = [])
    {
        $path = $this->path('/order/{product_id}', ['product_id' => $productId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List product categories
     *
     * GET /category — Bearer token required, verified against the live API.
     *
     * Return a list of product categories.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listCategories(array $query = [])
    {
        return $this->call('GET', '/category', ['query' => $query]);
    }

    /**
     * List product categories
     *
     * GET /categories — no authentication required, verified against the live API.
     *
     * Return a list of product categories.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listCategoryTree(array $query = [])
    {
        return $this->call('GET', '/categories', ['query' => $query, 'authenticated' => false]);
    }

    /**
     * List coupon
     *
     * GET /cart/coupon — no authentication required, verified against the live API.
     *
     * Danh sách mã giảm giá đang có
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listCoupons(array $query = [])
    {
        return $this->call('GET', '/cart/coupon', ['query' => $query, 'authenticated' => false]);
    }

    /**
     * Available TLDs
     *
     * GET /cart/domain/tlds — no authentication required, verified against the live API.
     *
     * List TLDs available for registration and transfer
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listDomainTlds(array $query = [])
    {
        return $this->call('GET', '/cart/domain/tlds', ['query' => $query, 'authenticated' => false]);
    }

    /**
     * V2: Available TLDs
     *
     * GET /v2/cart/domain/tlds — no authentication required, verified against the live API.
     *
     * List TLDs available for registration and transfer
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listDomainTldsV2(array $query = [])
    {
        return $this->call('GET', '/v2/cart/domain/tlds', ['query' => $query, 'authenticated' => false]);
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
     *
     * @param string|int $categoryId Category ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listProducts($categoryId, array $query = [])
    {
        $path = $this->path('/category/{category_id}/product', ['category_id' => $categoryId]);
        return $this->call('GET', $path, ['query' => $query]);
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
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function order(array $body = [], array $query = [])
    {
        return $this->call('POST', '/order', ['query' => $query, 'body' => $body]);
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
     *
     * @param string|int $productId Product ID
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function orderProduct($productId, array $body = [], array $query = [])
    {
        $path = $this->path('/order/{product_id}', ['product_id' => $productId]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
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
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function quote(array $body = [], array $query = [])
    {
        return $this->call('POST', '/quote', ['query' => $query, 'body' => $body]);
    }

}
