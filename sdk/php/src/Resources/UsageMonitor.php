<?php

declare(strict_types=1);

/**
 * Proxmox2 usage monitor.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Proxmox2 usage monitor — 5 operations.
 */
class UsageMonitor extends Resource
{
    /**
     * Get usage for a specific account
     *
     * GET /usage-monitor/account/{id} — Bearer token required, from the API specification.
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getAccountUsage($id, array $query = [])
    {
        $path = $this->path('/usage-monitor/account/{id}', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get node status for a server (via Proxmox2 module)
     *
     * GET /usage-monitor/nodes/{server_id} — Bearer token required, from the API specification.
     *
     * @param string|int $serverId
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getNodeStatus($serverId, array $query = [])
    {
        $path = $this->path('/usage-monitor/nodes/{server_id}', ['server_id' => $serverId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get overage list with custom thresholds
     *
     * POST /usage-monitor/overage — Bearer token required, from the API specification.
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listOverage(array $body = [], array $query = [])
    {
        return $this->call('POST', '/usage-monitor/overage', ['query' => $query, 'body' => $body]);
    }

    /**
     * List available Proxmox2 products
     *
     * GET /usage-monitor/products — Bearer token required, verified against the live API.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listProducts(array $query = [])
    {
        return $this->call('GET', '/usage-monitor/products', ['query' => $query]);
    }

    /**
     * Scan by product IDs and return full usage summary
     *
     * POST /usage-monitor/scan — Bearer token required, from the API specification.
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function scan(array $body = [], array $query = [])
    {
        return $this->call('POST', '/usage-monitor/scan', ['query' => $query, 'body' => $body]);
    }

}
