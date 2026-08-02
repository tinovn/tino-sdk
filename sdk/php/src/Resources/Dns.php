<?php

declare(strict_types=1);

/**
 * DNS zones & records.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * DNS zones & records — 12 operations.
 */
class Dns extends Resource
{
    /**
     * Add DNS Record
     *
     * POST /service/{service_id}/dns/{zone_id}/records — Bearer token required, verified against the live API.
     *
     * Creates a new record in the DNS zone
     *
     * Body fields:
     *   - service_id (integer): Service ID
     *   - zone_id (integer): Zone ID
     *   - name (string): Record name
     *   - ttl (integer): Record ttl
     *   - priority (integer): Priority of the record
     *   - type (string): Record type
     *   - content (string): Contents of the record
     *
     * @param string|int $serviceId
     * @param string|int $zoneId
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function createRecord($serviceId, $zoneId, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{service_id}/dns/{zone_id}/records', ['service_id' => $serviceId, 'zone_id' => $zoneId]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Add DNS Zone
     *
     * POST /service/{service_id}/dns — Bearer token required, from the API specification.
     *
     * Creates a new DNS zone
     *
     * Body fields:
     *   - service_id (integer): Service ID
     *   - name (string): Zone name
     *
     * @param string|int $serviceId
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function createZone($serviceId, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{service_id}/dns', ['service_id' => $serviceId]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Remove DNS Record
     *
     * DELETE /service/{service_id}/dns/{zone_id}/records/{record_id} — Bearer token required, verified against the live API.
     *
     * Removes the selected DNS zone record
     *
     * Path parameters:
     *   - service_id: Service ID
     *   - zone_id: Zone ID
     *   - record_id: Record ID
     *
     * @param string|int $serviceId Service ID
     * @param string|int $zoneId Zone ID
     * @param string|int $recordId Record ID
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function deleteRecord($serviceId, $zoneId, $recordId, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{service_id}/dns/{zone_id}/records/{record_id}', ['service_id' => $serviceId, 'zone_id' => $zoneId, 'record_id' => $recordId]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Remove DNS zone
     *
     * DELETE /service/{service_id}/dns/{zone_id} — Bearer token required, from the API specification.
     *
     * Deletes the selected DNS zone
     *
     * Path parameters:
     *   - service_id: Service ID
     *   - zone_id: Zone ID
     *
     * @param string|int $serviceId Service ID
     * @param string|int $zoneId Zone ID
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function deleteZone($serviceId, $zoneId, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{service_id}/dns/{zone_id}', ['service_id' => $serviceId, 'zone_id' => $zoneId]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Get DNS details
     *
     * GET /service/{service_id}/dns/{zone_id} — Bearer token required, verified against the live API.
     *
     * Returns details of the DNS zone
     *
     * Path parameters:
     *   - service_id: Service ID
     *   - zone_id: Zone ID
     *
     * @param string|int $serviceId Service ID
     * @param string|int $zoneId Zone ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getZone($serviceId, $zoneId, array $query = [])
    {
        $path = $this->path('/service/{service_id}/dns/{zone_id}', ['service_id' => $serviceId, 'zone_id' => $zoneId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get DNS DNSSEC
     *
     * GET /service/{service_id}/dns/{zone_id}/dnssec — Bearer token required, verified against the live API.
     *
     * Returns details of the DNS DNSSEC
     *
     * Path parameters:
     *   - service_id: Service ID
     *   - zone_id: Zone ID
     *
     * @param string|int $serviceId Service ID
     * @param string|int $zoneId Zone ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getZoneDnssec($serviceId, $zoneId, array $query = [])
    {
        $path = $this->path('/service/{service_id}/dns/{zone_id}/dnssec', ['service_id' => $serviceId, 'zone_id' => $zoneId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * DNS Templates
     *
     * GET /dns/templates — Bearer token required, verified against the live API.
     *
     * Returns details of the DNS zone
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listTemplates(array $query = [])
    {
        return $this->call('GET', '/dns/templates', ['query' => $query]);
    }

    /**
     * List DNS for service
     *
     * GET /service/{service_id}/dns — Bearer token required, verified against the live API.
     *
     * Returns a list of DNS zones under the service
     *
     * Path parameters:
     *   - service_id: Service ID
     *
     * @param string|int $serviceId Service ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listZones($serviceId, array $query = [])
    {
        $path = $this->path('/service/{service_id}/dns', ['service_id' => $serviceId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List DNS
     *
     * GET /dns — Bearer token required, verified against the live API.
     *
     * Returns a list of all DNS
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listZonesAll(array $query = [])
    {
        return $this->call('GET', '/dns', ['query' => $query]);
    }

    /**
     * Change Zone DNS
     *
     * GET /service/{service_id}/dns/{zone_id}/password — Bearer token required, verified against the live API.
     *
     * Returns details of the DNS zone
     *
     * Path parameters:
     *   - service_id: Service ID
     *   - zone_id: Zone ID
     *
     * @param string|int $serviceId Service ID
     * @param string|int $zoneId Zone ID
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function resetZonePassword($serviceId, $zoneId, array $query = [])
    {
        $path = $this->path('/service/{service_id}/dns/{zone_id}/password', ['service_id' => $serviceId, 'zone_id' => $zoneId]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Edit DNS Record
     *
     * PUT /service/{service_id}/dns/{zone_id}/records/{record_id} — Bearer token required, verified against the live API.
     *
     * Edits the selected DNS zone record
     *
     * Body fields:
     *   - service_id (integer): Service ID
     *   - zone_id (integer): Zone ID
     *   - record_id (integer): Record ID
     *   - name (string): Record name
     *   - ttl (integer): Record ttl
     *   - priority (integer): Priority of the record
     *   - type (string): Record type
     *   - content (string): Contents of the record
     *
     * @param string|int $serviceId
     * @param string|int $zoneId
     * @param string|int $recordId
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateRecord($serviceId, $zoneId, $recordId, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{service_id}/dns/{zone_id}/records/{record_id}', ['service_id' => $serviceId, 'zone_id' => $zoneId, 'record_id' => $recordId]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * UPDATE DNS DNSSEC
     *
     * PUT /service/{service_id}/dns/{zone_id}/dnssec — Bearer token required, from the API specification.
     *
     * Returns details of the DNS DNSSEC
     *
     * Path parameters:
     *   - service_id: Service ID
     *   - zone_id: Zone ID
     *
     * Body fields:
     *   - widgetdo (string, required): widgetdo action
     *
     * @param string|int $serviceId Service ID
     * @param string|int $zoneId Zone ID
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function updateZoneDnssec($serviceId, $zoneId, array $body = [], array $query = [])
    {
        $path = $this->path('/service/{service_id}/dns/{zone_id}/dnssec', ['service_id' => $serviceId, 'zone_id' => $zoneId]);
        return $this->call('PUT', $path, ['query' => $query, 'body' => $body]);
    }

}
