<?php

declare(strict_types=1);

namespace Tino\UserApi\Exception;

/** The request never produced an HTTP response (DNS, TCP, TLS, timeout). */
class TinoTransportException extends TinoException
{
}
