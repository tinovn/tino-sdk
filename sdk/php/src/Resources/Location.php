<?php

declare(strict_types=1);

/**
 * Countries, states & cities.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Countries, states & cities — 8 operations.
 */
class Location extends Resource
{
    /**
     * Get city by State Name V2
     *
     * GET /location/state/city-v2/{name} — Bearer token required, from the API specification.
     *
     * Path parameters:
     *   - name: State name
     *
     * @param string|int $name State name
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getCityByStateNameV2($name, array $query = [])
    {
        $path = $this->path('/location/state/city-v2/{name}', ['name' => $name]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get All citys
     *
     * GET /location/citys — no authentication required, verified against the live API.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listAllCities(array $query = [])
    {
        return $this->call('GET', '/location/citys', ['query' => $query, 'authenticated' => false]);
    }

    /**
     * Get city
     *
     * GET /location/state/{id}/city — no authentication required, verified against the live API.
     *
     * Path parameters:
     *   - id: State id
     *
     * @param string|int $id State id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listCitiesByStateId($id, array $query = [])
    {
        $path = $this->path('/location/state/{id}/city', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query, 'authenticated' => false]);
    }

    /**
     * Get city V2
     *
     * GET /location/state/{id}/city-v2 — no authentication required, verified against the live API.
     *
     * Path parameters:
     *   - id: State id
     *
     * @param string|int $id State id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listCitiesByStateIdV2($id, array $query = [])
    {
        $path = $this->path('/location/state/{id}/city-v2', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query, 'authenticated' => false]);
    }

    /**
     * Get city by State Name
     *
     * GET /location/state/city/{name} — no authentication required, verified against the live API.
     *
     * Path parameters:
     *   - name: State name
     *
     * @param string|int $name State name
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listCitiesByStateName($name, array $query = [])
    {
        $path = $this->path('/location/state/city/{name}', ['name' => $name]);
        return $this->call('GET', $path, ['query' => $query, 'authenticated' => false]);
    }

    /**
     * countries List
     *
     * GET /location/countries — no authentication required, verified against the live API.
     *
     * Return currencies details
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listCountries(array $query = [])
    {
        return $this->call('GET', '/location/countries', ['query' => $query, 'authenticated' => false]);
    }

    /**
     * Get state
     *
     * GET /location/{code}/state — no authentication required, verified against the live API.
     *
     * Path parameters:
     *   - code: Country Code
     *
     * @param string|int $code Country Code
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listStates($code, array $query = [])
    {
        $path = $this->path('/location/{code}/state', ['code' => $code]);
        return $this->call('GET', $path, ['query' => $query, 'authenticated' => false]);
    }

    /**
     * Get state V2
     *
     * GET /location/{code}/state-v2 — no authentication required, verified against the live API.
     *
     * Path parameters:
     *   - code: Country Code
     *
     * @param string|int $code Country Code
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listStatesV2($code, array $query = [])
    {
        $path = $this->path('/location/{code}/state-v2', ['code' => $code]);
        return $this->call('GET', $path, ['query' => $query, 'authenticated' => false]);
    }

}
