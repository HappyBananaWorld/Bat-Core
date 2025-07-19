<?php

namespace Src\Core\Env;

class Env
{
    public static function load($path = null): void
    {
        if (is_null($path))
            $path = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . ".env";

        if (!file_exists($path)) {
            throw new \Exception(".env file not found at $path");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);

            $key = trim($key);
            $value = trim($value);

            $value = trim($value, '"\'');

            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }

    public static function get(string $key, $default = null): mixed
    {
        return $_ENV[$key] ?? getenv($key) ?? $default;
    }
}
