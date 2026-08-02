<?php

declare(strict_types=1);

/**
 * TinoSite (managed WordPress).
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * TinoSite (managed WordPress) — 10 operations.
 */
class Tinosite extends Resource
{
    /**
     * Auto Login
     *
     * POST /tinosite/{id}/autologin — Bearer token required, from the API specification.
     *
     * @param string|int $id
     * @param string|int $email
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function autoLogin($id, $email, array $body = [], array $query = [])
    {
        $path = $this->path('/tinosite/{id}/autologin', ['id' => $id, 'email' => $email]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Backups
     *
     * POST /tinosite/{id}/backups — Bearer token required, from the API specification.
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function backup($id, array $body = [], array $query = [])
    {
        $path = $this->path('/tinosite/{id}/backups', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Add User
     *
     * POST /tinosite/{id}/users — Bearer token required, from the API specification.
     *
     * @param string|int $id
     * @param string|int $email
     * @param string|int $role
     * @param string|int $password
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function createUser($id, $email, $role, $password, array $body = [], array $query = [])
    {
        $path = $this->path('/tinosite/{id}/users', ['id' => $id, 'email' => $email, 'role' => $role, 'password' => $password]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Domain Pointer
     *
     * POST /tinosite/{id}/domainpointers — Bearer token required, from the API specification.
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function domainPointerAction($id, array $body = [], array $query = [])
    {
        $path = $this->path('/tinosite/{id}/domainpointers', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Metrics
     *
     * GET /tinosite/{id}/metrics — Bearer token required, from the API specification.
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getMetrics($id, array $query = [])
    {
        $path = $this->path('/tinosite/{id}/metrics', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List plugins
     *
     * GET /tinosite/{id}/plugins — Bearer token required, verified against the live API.
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listPlugins($id, array $query = [])
    {
        $path = $this->path('/tinosite/{id}/plugins', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List themes
     *
     * GET /tinosite/{id}/themes — Bearer token required, verified against the live API.
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listThemes($id, array $query = [])
    {
        $path = $this->path('/tinosite/{id}/themes', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * List User
     *
     * GET /tinosite/{id}/users — Bearer token required, from the API specification.
     *
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listUsers($id, array $query = [])
    {
        $path = $this->path('/tinosite/{id}/users', ['id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Action SSL
     *
     * POST /tinosite/{id}/sslcerts — Bearer token required, from the API specification.
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function sslCertificateAction($id, array $body = [], array $query = [])
    {
        $path = $this->path('/tinosite/{id}/sslcerts', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * on/off ssl certs
     *
     * POST /tinosite/{id}/sslcerts/onoff — Bearer token required, from the API specification.
     *
     * @param string|int $id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function toggleSslCertificate($id, array $body = [], array $query = [])
    {
        $path = $this->path('/tinosite/{id}/sslcerts/onoff', ['id' => $id]);
        return $this->call('POST', $path, ['query' => $query, 'body' => $body]);
    }

}
