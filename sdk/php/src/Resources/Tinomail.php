<?php

declare(strict_types=1);

/**
 * TinoMail.
 *
 * Generated from spec/tino-userapi-catalog.json by tools/generate-sdk.py — do not edit by hand.
 */

namespace Tino\UserApi\Resources;

/**
 * TinoMail — 2 operations.
 */
class Tinomail extends Resource
{
    /**
     * Email Summary
     *
     * GET /service/{idtinomail}/summary — Bearer token required, from the API specification.
     *
     * Email details
     *
     * Note: Only valid for a TinoMail service id. Calling it on another service type returns
     * 404 invalid method.
     *
     * @param string|int $idtinomail
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function getSummary($idtinomail, $id, array $query = [])
    {
        $path = $this->path('/service/{idtinomail}/summary', ['idtinomail' => $idtinomail, 'id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

    /**
     * Email logs
     *
     * GET /service/{idtinomail}/logs — Bearer token required, from the API specification.
     *
     * Note: Only valid for a TinoMail service id. Calling it on another service type returns
     * 404 invalid method.
     *
     * @param string|int $idtinomail
     * @param string|int $id
     * @param array<string,mixed> $query Extra query-string parameters.
     *
     * @return mixed Decoded response body.
     */
    public function listLogs($idtinomail, $id, array $query = [])
    {
        $path = $this->path('/service/{idtinomail}/logs', ['idtinomail' => $idtinomail, 'id' => $id]);
        return $this->call('GET', $path, ['query' => $query]);
    }

}
