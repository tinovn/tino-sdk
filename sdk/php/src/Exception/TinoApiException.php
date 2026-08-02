<?php

declare(strict_types=1);

namespace Tino\UserApi\Exception;

/**
 * The API answered, but the answer describes a failure.
 *
 * The Tino UserAPI reports most failures with HTTP 200 plus an `error` key in the
 * body, so the HTTP status alone is not enough to detect them.
 */
class TinoApiException extends TinoException
{
    /** @var int HTTP status code of the response. */
    public $status;

    /** @var list<string> Error strings extracted from the response body. */
    public $errors;

    /** @var string HTTP method of the failed call. */
    public $method;

    /** @var string Path of the failed call. */
    public $path;

    /** @var mixed Decoded response body, when it was JSON. */
    public $body;

    /**
     * @param list<string> $errors
     * @param mixed        $body
     */
    public function __construct(
        string $message,
        int $status = 0,
        array $errors = [],
        string $method = '',
        string $path = '',
        $body = null
    ) {
        parent::__construct($message, $status);
        $this->status = $status;
        $this->errors = $errors;
        $this->method = $method;
        $this->path = $path;
        $this->body = $body;
    }

    public function __toString(): string
    {
        $where = trim($this->method . ' ' . $this->path);

        return sprintf('[%d] %s%s', $this->status, $this->getMessage(), $where !== '' ? " ({$where})" : '');
    }
}
