<?php

declare(strict_types=1);

/**
 * PSR-4 autoloader for use without Composer.
 *
 *     require '/path/to/tino-sdk/sdk/php/autoload.php';
 *     $client = new Tino\UserApi\TinoClient();
 *
 * With Composer, require vendor/autoload.php instead — this file is not needed.
 */

spl_autoload_register(static function (string $class): void {
    $prefix = 'Tino\\UserApi\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    $relative = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, strlen($prefix)));
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $relative . '.php';

    if (is_file($file)) {
        require $file;
    }
});
