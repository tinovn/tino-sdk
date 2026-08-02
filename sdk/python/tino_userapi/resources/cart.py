"""Catalogue, cart & orders.

Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
"""
from __future__ import annotations

from typing import Any, Optional

from .base import Resource


class CartResource(Resource):
    """Catalogue, cart & orders — 10 operations."""

    def get_product(self, product_id, **query: Any) -> Any:
        """Get product configuration details

        GET /order/{product_id} — Bearer token required, verified against the live API.

        Return product details with form configuration, addons and subproducts if available.

        Path parameters:
          - product_id: Product ID
        """
        path = self._path("/order/{product_id}", product_id=product_id)
        return self._call("GET", path, query=query)

    def list_categories(self, **query: Any) -> Any:
        """List product categories

        GET /category — Bearer token required, verified against the live API.

        Return a list of product categories.
        """
        return self._call("GET", "/category", query=query)

    def list_category_tree(self, **query: Any) -> Any:
        """List product categories

        GET /categories — no authentication required, verified against the live API.

        Return a list of product categories.
        """
        return self._call("GET", "/categories", query=query, authenticated=False)

    def list_coupons(self, **query: Any) -> Any:
        """List coupon

        GET /cart/coupon — no authentication required, verified against the live API.

        Danh sách mã giảm giá đang có
        """
        return self._call("GET", "/cart/coupon", query=query, authenticated=False)

    def list_domain_tlds(self, **query: Any) -> Any:
        """Available TLDs

        GET /cart/domain/tlds — no authentication required, verified against the live API.

        List TLDs available for registration and transfer
        """
        return self._call("GET", "/cart/domain/tlds", query=query, authenticated=False)

    def list_domain_tlds_v2(self, **query: Any) -> Any:
        """V2: Available TLDs

        GET /v2/cart/domain/tlds — no authentication required, verified against the live API.

        List TLDs available for registration and transfer
        """
        return self._call("GET", "/v2/cart/domain/tlds", query=query, authenticated=False)

    def list_products(self, category_id, **query: Any) -> Any:
        """List products in category

        GET /category/{category_id}/product — Bearer token required, verified against the live API.

        Return a list of product available for purchase under requested category

        Path parameters:
          - category_id: Category ID
        """
        path = self._path("/category/{category_id}/product", category_id=category_id)
        return self._call("GET", path, query=query)

    def order(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Order multiple services

        POST /order — Bearer token required, from the API specification.

        Create and submit new order for multiple services

        Each item in the `items` array needs to include order `type` and parameters used
        by one of the method listed below:

        • `POST /certificate/order` - use `certificate` for item type

        Body fields:
          - pay_method (integer): Payment method ID
          - ignore_errors (boolean): Process order even if some of the items were rejected due to errors
          - items (array): list with order items
          - aff_id (integer): Affiliate ID
        """
        return self._call("POST", "/order", body=self._body(body, fields))

    def order_product(self, product_id, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Order new service

        POST /order/{product_id} — Bearer token required, from the API specification.

        Create and submit new order for selected product.

        To get available cycle and configuration options lookup product details
        using `GET /order/@product_id`

        Path parameters:
          - product_id: Product ID

        Body fields:
          - domain (string): Domain name, ie. example.com, may be optional
          - cycle (string): Billing period symbol
          - pay_method (integer): Payment method ID
          - custom (array): Additional options data available for sop products
          - promocode (string): Promotion code
          - aff_id (integer): Affiliate ID
        """
        path = self._path("/order/{product_id}", product_id=product_id)
        return self._call("POST", path, body=self._body(body, fields))

    def quote(self, *, body: Optional[dict] = None, **fields: Any) -> Any:
        """Get order quote

        POST /quote — Bearer token required, verified against the live API.

        Calculate order cost and recurring prices for selected items.
        Use the same parameters as for `POST /order`

        Body fields:
          - pay_method (integer): Payment method ID
          - output (string): Type of output, default is short. Possible options    short</code> - Basic details about the item in cart</li>  config</code>- Basic details and form components</li>  full</code> - All details available in cart</li> </ul>
          - items (array): list with order items
        """
        return self._call("POST", "/quote", body=self._body(body, fields))
