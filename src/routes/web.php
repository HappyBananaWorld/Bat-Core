<?php

// use Nyholm\Psr7\Response;

use Src\Core\Response\Response;

function registerRoutes($app)
{
    $app->get('/', function () {
        try {
            // کد اصلی
            return Response::json(200, ['hi' => 'meow']);
        } catch (\Throwable $e) {
            // خطا رو لاگ یا نمایش بده
            error_log($e->getMessage());
            return new \Nyholm\Psr7\Response(500, ['Content-Type' => 'text/plain'], "Error: " . $e->getMessage());
        }
    });

}