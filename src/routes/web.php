<?php

use Nyholm\Psr7\Response;

function registerRoutes($app)
{
    $app->get('/', function () {
        ob_start();
        include __DIR__ . "/../Views/index.php";
        $content = ob_get_clean();

        return new Response(200, ['Content-Type' => 'text/html'], $content);
    });
}