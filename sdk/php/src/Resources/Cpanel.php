<?php

declare(strict_types=1);

/**
 * cPanel service actions.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * cPanel service actions — 7 operations.
 */
class Cpanel extends Resource
{
    /**
     * Change Passs cPanel
     *
     * GET /service/cpanel2/{id}/changepasss — Bearer token required, verified against the live API.
     *
     * Get the details of a particular virtual server
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function changePassword($id, array $query = [])
    {
        $path = $this->path('/service/cpanel2/{id}/changepasss', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Change Domain cPanel
     *
     * POST /service/cpanel2/{id}/changedomain — Bearer token required, verified against the live API.
     *
     * Body fields:
     *   - domain (string, required)
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function changePrimaryDomain($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/cpanel2/{id}/changedomain', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Get cPanel link login
     *
     * GET /service/cpanel2/{id}/login — Bearer token required, verified against the live API.
     *
     * Get the details of a particular virtual server
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getLoginLink($id, array $query = [])
    {
        $path = $this->path('/service/cpanel2/{id}/login', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get cPanel phpmyadmin login
     *
     * GET /service/cpanel2/{id}/phpmyadminlogin — Bearer token required, verified against the live API.
     *
     * Get the details of a particular virtual server
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getPhpMyAdminLink($id, array $query = [])
    {
        $path = $this->path('/service/cpanel2/{id}/phpmyadminlogin', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Get cPanel statistics
     *
     * GET /service/cpanel2/{id}/statistics — Bearer token required, verified against the live API.
     *
     * Get the details of a particular virtual server
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getStatistics($id, array $query = [])
    {
        $path = $this->path('/service/cpanel2/{id}/statistics', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Reset Acount cPanel
     *
     * POST /service/cpanel2/{id}/resetacount — Bearer token required, verified against the live API.
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function resetAccount($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/cpanel2/{id}/resetacount', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Get cPanel unblock ip
     *
     * POST /service/cpanel2/{id}/unblock — Bearer token required, from the API specification.
     *
     * Get the details of a particular virtual server
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function unblockIp($id, array $body = [], array $query = [])
    {
        $path = $this->path('/service/cpanel2/{id}/unblock', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

}
