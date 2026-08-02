<?php

declare(strict_types=1);

namespace Tino\UserApi;

use Tino\UserApi\Exception\TinoTransportException;

/**
 * Zero-dependency HTTP transport (ext-curl) and query-string encoding.
 */
final class Http
{
    /**
     * Encode a query array the way the Tino UserAPI expects it.
     *
     * Nested arrays become `filter[key]=value`, lists become `key[]=value`,
     * booleans become `1` / `0`, and nulls are dropped.
     *
     * @param array<string,mixed> $params
     */
    public static function encodeQuery(array $params): string
    {
        $pairs = [];
        self::flatten($params, '', $pairs);

        return implode('&', array_map(
            static fn (array $pair): string => rawurlencode($pair[0]) . '=' . rawurlencode($pair[1]),
            $pairs
        ));
    }

    /**
     * @param array<string,mixed>         $params
     * @param list<array{0:string,1:string}> $pairs
     */
    private static function flatten(array $params, string $prefix, array &$pairs): void
    {
        foreach ($params as $key => $value) {
            $name = $prefix === '' ? (string) $key : $prefix . '[' . $key . ']';
            if ($value === null) {
                continue;
            }
            if (is_bool($value)) {
                $pairs[] = [$name, $value ? '1' : '0'];
            } elseif (is_array($value)) {
                if ($value === []) {
                    continue;
                }
                // A list becomes key[]=a&key[]=b; a map keeps its keys.
                if (array_keys($value) === range(0, count($value) - 1)) {
                    foreach ($value as $item) {
                        if ($item === null) {
                            continue;
                        }
                        $pairs[] = [$name . '[]', is_bool($item) ? ($item ? '1' : '0') : (string) $item];
                    }
                } else {
                    self::flatten($value, $name, $pairs);
                }
            } else {
                $pairs[] = [$name, (string) $value];
            }
        }
    }

    /**
     * @param array<string,mixed> $query
     */
    public static function buildUrl(string $baseUrl, string $path, array $query = []): string
    {
        $url = rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
        $encoded = self::encodeQuery($query);
        if ($encoded !== '') {
            $url .= (strpos($url, '?') === false ? '?' : '&') . $encoded;
        }

        return $url;
    }

    /** Percent-encode a value destined for a path segment. */
    public static function encodePathParam($value): string
    {
        return rawurlencode((string) $value);
    }

    /**
     * Perform one HTTP round trip and decode the JSON body when possible.
     *
     * @param array<string,string> $headers
     * @param mixed                $body
     *
     * The `text` entry holds the undecoded bytes, so binary payloads survive intact.
     *
     * @return array{status:int,headers:array<string,string>,text:string,json:mixed}
     */
    public static function send(string $method, string $url, array $headers = [], $body = null, int $timeout = 60): array
    {
        $handle = curl_init($url);
        if ($handle === false) {
            throw new TinoTransportException("Unable to initialise a cURL handle for {$url}");
        }

        if ($body !== null) {
            $headers['Content-Type'] = $headers['Content-Type'] ?? 'application/json';
            $payload = json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            curl_setopt($handle, CURLOPT_POSTFIELDS, $payload);
        }

        $headerLines = [];
        foreach ($headers as $name => $value) {
            $headerLines[] = $name . ': ' . $value;
        }

        curl_setopt_array($handle, [
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headerLines,
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_CONNECTTIMEOUT => min(15, $timeout),
            CURLOPT_ENCODING => '',
            CURLOPT_FOLLOWLOCATION => false,
        ]);

        $raw = curl_exec($handle);
        if ($raw === false) {
            $error = curl_error($handle);
            self::closeHandle($handle);
            throw new TinoTransportException("{$method} {$url} failed: {$error}");
        }

        $status = (int) curl_getinfo($handle, CURLINFO_RESPONSE_CODE);
        self::closeHandle($handle);

        $text = (string) $raw;
        $json = null;
        if ($text !== '') {
            $decoded = json_decode($text, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $json = $decoded;
            }
        }

        return ['status' => $status, 'headers' => [], 'text' => $text, 'json' => $json];
    }

    /**
     * Release a cURL handle.
     *
     * On PHP 8.0+ the handle is a CurlHandle object freed by the garbage collector,
     * and curl_close() is a deprecated no-op. Only PHP 7.x resources need closing.
     *
     * @param resource|\CurlHandle $handle
     */
    private static function closeHandle($handle): void
    {
        if (is_resource($handle)) {
            curl_close($handle);
        }
    }
}
