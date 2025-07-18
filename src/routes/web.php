<?php

// use Nyholm\Psr7\Response;

use Src\Core\Response\Response as Res;

function registerRoutes($app)
{
    $app->get('/', function ($req, $res) {
        // return view('welcome');
        return $res->view();
    });
}