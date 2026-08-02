<?php

declare(strict_types=1);

/**
 * Account security (SSH keys, IP access).
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * Account security (SSH keys, IP access) — 5 operations.
 */
class Security extends Resource
{
    /**
     * Add IP access
     *
     * POST /security/ipaccess — Bearer token required, verified against the live API.
     *
     * all - keyword matching all
     * IPs xxx.xxx.xxx.xxx - IP single
     * xxx.xxx.xxx.xxx/M - IP with Mask in CIDR format
     * xxx.xxx.xxx.xxx/mmm.mmm.mmm.mmm - IP with Mask in dotted quad format
     *
     * Note: The first rule switches the account into whitelist mode: every address that is not
     * listed is refused, including the one you are calling from. Add your own address before
     * adding any other, and remove it last.
     *
     * Body fields:
     *   - rule (string): Rule Access
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function addIpAccess(array $body = [], array $query = [])
    {
        return $this->call('POST', '/security/ipaccess', ['query' => $query, 'body' => $body]);
    }

    /**
     * Add SSH Key
     *
     * POST /security/sshkey — Bearer token required, from the API specification.
     *
     * Body fields:
     *   - ssh_key_name (string): SSH Name
     *   - ssh_key_key (string): SSh Key
     *
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function addSshKey(array $body = [], array $query = [])
    {
        return $this->call('POST', '/security/sshkey', ['query' => $query, 'body' => $body]);
    }

    /**
     * List security
     *
     * GET /security — Bearer token required, verified against the live API.
     *
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function get(array $query = [])
    {
        return $this->call('GET', '/security', ['query' => $query]);
    }

    /**
     * Remove IP access
     *
     * DELETE /security/ipaccess/{id} — Bearer token required, verified against the live API.
     *
     * Path parameters:
     *   - id: Rule id
     *
     * @param string|int $id Rule id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function removeIpAccess($id, array $body = [], array $query = [])
    {
        $path = $this->path('/security/ipaccess/{id}', ['id' => $id]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

    /**
     * Remove SSH Key
     *
     * DELETE /security/sshkey/{id} — Bearer token required, from the API specification.
     *
     * Đang test chưa xong
     *
     * Path parameters:
     *   - id: sshkey id
     *
     * @param string|int $id sshkey id
     * @param array<string,mixed> $body Request payload.
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function removeSshKey($id, array $body = [], array $query = [])
    {
        $path = $this->path('/security/sshkey/{id}', ['id' => $id]);
        return $this->call('DELETE', $path, ['query' => $query, 'body' => $body]);
    }

}
