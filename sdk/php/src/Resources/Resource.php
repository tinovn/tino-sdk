<?php

declare(strict_types=1);

namespace Tino\UserApi\Resources;

use Tino\UserApi\Http;
use Tino\UserApi\TinoClient;

/**
 * Base class for every resource group (`$client->domains`, `$client->billing`, ...).
 */
abstract class Resource
{
    /** @var TinoClient */
    protected $client;

    public function __construct(TinoClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param array{query?: array<string,mixed>, body?: mixed, authenticated?: bool, raw?: bool} $options
     *
     * @return mixed
     */
    protected function call(string $method, string $path, array $options = [])
    {
        if (isset($options['body']) && $options['body'] === []) {
            unset($options['body']);
        }

        return $this->client->request($method, $path, $options);
    }

    /**
     * Fill `{placeholder}` segments, percent-encoding each value.
     *
     * @param array<string,string|int> $params
     */
    protected function path(string $template, array $params = []): string
    {
        $path = $template;
        foreach ($params as $name => $value) {
            $path = str_replace('{' . $name . '}', Http::encodePathParam($value), $path);
        }

        return $path;
    }
}
