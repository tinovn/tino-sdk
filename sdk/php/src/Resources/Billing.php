<?php

declare(strict_types=1);

/**
 * Billing, invoices & payments.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Billing, invoices & payments — 21 operations.
 */
class Billing extends Resource
{
    /**
     * Add Funds
     *
     * POST /billing/addfunds — Bearer token required, verified against the live API.
     *
     * Create Invoice Add Credits
     *
     * Body fields:
     *   - funds (integer): Amount of money
     *   - gateway (integer): Payment Method
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function addFunds(array $body = [], array $query = [])
    {
        return $this->call('POST', '/billing/addfunds', ['query' => $query, 'body' => $body]);
    }

    /**
     * Add Funds
     *
     * POST /addfunds — Bearer token required, verified against the live API.
     *
     * Generate add funds invoice
     *
     * Body fields:
     *   - amount (number): Amount to add to account
     *   - gateway (number): Payment gateway ID, use `GET /addfunds` to list available gateways
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function addFundsLegacy(array $body = [], array $query = [])
    {
        return $this->call('POST', '/addfunds', ['query' => $query, 'body' => $body]);
    }

    /**
     * Apply Credit
     *
     * POST /invoice/{id}/credit — Bearer token required, from the API specification.
     *
     * Calculate order cost and recurring prices for selected items.
     * Use the same parameters as for `POST /order`
     *
     * Body fields:
     *   - id (integer): Payment method ID
     *   - amount (string)
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function applyCredit($id, array $body = [], array $query = [])
    {
        $path = $this->path('/invoice/{id}/credit', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Delete Invoice
     *
     * DELETE /invoice/{id} — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Invoice id
     *
     * @param string|int $id Invoice id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function deleteInvoice($id, array $body = [], array $query = [])
    {
        $path = $this->path('/invoice/{id}', ['id' => $id]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Get Add Funds Information
     *
     * GET /addfunds — Bearer token required, verified against the live API.
     *
     * Get add funds configuration: minimum and maximum deposit amounts and available payment
     * gateways
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getAddFundsInfo(array $query = [])
    {
        return $this->call('GET', '/addfunds', ['query' => $query]);
    }

    /**
     * Account balance
     *
     * GET /balance — Bearer token required, verified against the live API.
     *
     * Get current account balance(unpaid invoices total), account credit
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getBalance(array $query = [])
    {
        return $this->call('GET', '/balance', ['query' => $query]);
    }

    /**
     * Credit logs
     *
     * GET /billing/creditlogs — Bearer token required, verified against the live API.
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
    public function getCreditLogs(array $query = [])
    {
        return $this->call('GET', '/billing/creditlogs', ['query' => $query]);
    }

    /**
     * Currencies List
     *
     * GET /currencies — no authentication required, verified against the live API.
     *
     * Return currencies details
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getCurrencies(array $query = [])
    {
        return $this->call('GET', '/currencies', ['query' => $query, 'authenticated' => false]);
    }

    /**
     * Estimates Details
     *
     * GET /estimates/{id} — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - id: Estimates id
     *
     * @param string|int $id Estimates id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getEstimate($id, array $query = [])
    {
        $path = $this->path('/estimates/{id}', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Download Invoice Pdf
     *
     * GET /estimate/{id}/pdf — Bearer token required, from the API specification.
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getEstimatePdf($id, array $query = [])
    {
        $path = $this->path('/estimate/{id}/pdf', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Invoice Details
     *
     * GET /invoice/{id} — Bearer token required, verified against the live API.
     *
     * Get invoice details
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getInvoiceDetails($id, array $query = [])
    {
        $path = $this->path('/invoice/{id}', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Invoice PDF
     *
     * GET /invoice/{id}/pdf — Bearer token required, verified against the live API.
     *
     * Get specific invoice PDF as base64 string
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getInvoicePdf($id, array $query = [])
    {
        $path = $this->path('/invoice/{id}/pdf', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Payment link
     *
     * GET /billing/{invoice_id}/pay/{gateway_id} — Bearer token required, verified against the live API.
     *
     * Get Payment link from Gateways.
     *
     * Path parameters:
     *   - invoice_id: Invoice ID
     *   - gateway_id: Gateway ID
     *
     * @param string|int $invoiceId Invoice ID
     * @param string|int $gatewayId Gateway ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getPaymentLink($invoiceId, $gatewayId, array $query = [])
    {
        $path = $this->path('/billing/{invoice_id}/pay/{gateway_id}', ['invoice_id' => $invoiceId, 'gateway_id' => $gatewayId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List Estimates
     *
     * GET /estimates — Bearer token required, verified against the live API.
     *
     * List all estimates under my account
     * Using: &page=&perpage= for pagination. page start 0.
     * filter[service_status]= search invoice by service status, filter[service]= search
     * invoice by service id
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
    public function listEstimates(array $query = [])
    {
        return $this->call('GET', '/estimates', ['query' => $query]);
    }

    /**
     * List Invoices
     *
     * GET /invoices — Bearer token required, verified against the live API.
     *
     * List all invoices under my account
     * Using: &page=&perpage= for pagination. page start 0.
     * filter[service_status]= search invoice by service status, filter[service]= search
     * invoice by service id
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
    public function listInvoices(array $query = [])
    {
        return $this->call('GET', '/invoices', ['query' => $query]);
    }

    /**
     * List Invoices Due
     *
     * GET /invoices/due — Bearer token required, verified against the live API.
     *
     * List all invoices due under my account
     * Using: &page=&perpage= for pagination. page start 0
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
    public function listInvoicesDue(array $query = [])
    {
        return $this->call('GET', '/invoices/due', ['query' => $query]);
    }

    /**
     * List Invoices
     *
     * GET /invoice — Bearer token required, verified against the live API.
     *
     * List all invoices under my account
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
    public function listInvoicesLegacy(array $query = [])
    {
        return $this->call('GET', '/invoice', ['query' => $query]);
    }

    /**
     * Payment Methods Fees
     *
     * GET /payment/fees — no authentication required, verified against the live API.
     *
     * List available payment methods with fees
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listPaymentMethodFees(array $query = [])
    {
        return $this->call('GET', '/payment/fees', ['query' => $query, 'authenticated' => false]);
    }

    /**
     * Payment Methods
     *
     * GET /payment — no authentication required, verified against the live API.
     *
     * List available payment methods
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listPaymentMethods(array $query = [])
    {
        return $this->call('GET', '/payment', ['query' => $query, 'authenticated' => false]);
    }

    /**
     * Payall Invoice
     *
     * POST /invoices/payall — Bearer token required, verified against the live API.
     *
     * Body fields:
     *   - selected (array): selected invoice id
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function payAllInvoices(array $body = [], array $query = [])
    {
        return $this->call('POST', '/invoices/payall', ['query' => $query, 'body' => $body]);
    }

    /**
     * Redeem a voucher
     *
     * POST /billing/creditvoucher — Bearer token required, from the API specification.
     *
     * Using Redeem a voucher
     *
     * Body fields:
     *   - code (string): Voucher Code
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function redeemCreditVoucher(array $body = [], array $query = [])
    {
        return $this->call('POST', '/billing/creditvoucher', ['query' => $query, 'body' => $body]);
    }

}
