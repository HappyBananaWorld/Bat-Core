<?php

// use Nyholm\Psr7\Response;

use Src\Core\Response\Response;

function registerRoutes($app)
{
    $app->get('/', function () {
        return ( new Response())->view();
    });

}