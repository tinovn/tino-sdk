<?php

declare(strict_types=1);

/**
 * SSL certificates.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * SSL certificates — 6 operations.
 */
class Certificates extends Resource
{
    /**
     * Download certificate
     *
     * GET /certificate/{service_id}/crt — Bearer token required, verified against the live API.
     *
     * Return X.509 certificate data
     *
     * Path parameters:
     *   - service_id: Service id
     *
     * @param string|int $serviceId Service id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function download($serviceId, array $query = [])
    {
        $path = $this->path('/certificate/{service_id}/crt', ['service_id' => $serviceId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Certificate details
     *
     * GET /certificate/{id} — Bearer token required, verified against the live API.
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function get($id, array $query = [])
    {
        $path = $this->path('/certificate/{id}', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List SSL Certificates
     *
     * GET /certificates — Bearer token required, verified against the live API.
     *
     * List all ssl services under your account
     *
     * Query parameters:
     *   - page: Zero-based page index. page=0 is the first page; the response echoes it 1-based in page.current.
     *   - perpage: Rows per page. Defaults to the account's RecordsPerPage setting.
     *   - orderby: Sort expression in the form `field|DESC` or `field|ASC`, e.g. `date|DESC`.
     *   - filter: Endpoint-specific filters, serialised as filter[key]=value.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function list(array $query = [])
    {
        return $this->call('GET', '/certificates', ['query' => $query]);
    }

    /**
     * List available certificates
     *
     * GET /certificate/order — Bearer token required, verified against the live API.
     *
     * Return a list with certificate available for purchase
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listProducts(array $query = [])
    {
        return $this->call('GET', '/certificate/order', ['query' => $query]);
    }

    /**
     * List server software for certificates
     *
     * GET /certificate/order/{product_id}/software — Bearer token required, verified against the live API.
     *
     * Return a list with software IDs required or certificate
     *
     * Path parameters:
     *   - product_id: Certificate product ID
     *
     * @param string|int $productId Certificate product ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listServerSoftware($productId, array $query = [])
    {
        $path = $this->path('/certificate/order/{product_id}/software', ['product_id' => $productId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Order new certificates
     *
     * POST /certificate/order — Bearer token required, from the API specification.
     *
     * DEPRECATED — kept for compatibility; see the note below for the replacement.
     *
     * Create new order for a certificate
     *
     * Note: Certificates are ordered through cart.order together with any other item. This
     * route remains for the standalone certificate flow.
     *
     * Body fields:
     *   - product_id (integer): Certificate product ID
     *   - csr (string): Domain name
     *   - years (integer): Number of years
     *   - pay_method (integer): Payment method ID
     *   - approver_email (string): Email addres used in domain validation
     *   - admin (integer): Admin contact ID
     *   - tech (integer): Tech contact ID
     *   - billing (integer): Billing contact ID
     *   - organization (array): Organization details
     *   - software (integer): Server/Software ID
     *   - data (array): Addditional data required for some products
     *   - aff_id (integer): Affiliate ID
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function order(array $body = [], array $query = [])
    {
        return $this->call('POST', '/certificate/order', ['query' => $query, 'body' => $body]);
    }

}
