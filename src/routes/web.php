<?php

use Src\Core\Env\Env;

function registerRoutes($app)
{
    $app->get('/', function ($req, $res) {
        echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

        $browser = get_browser($_SERVER['HTTP_USER_AGENT']);
        print_r($browser);
        
        Env::get("TEST");
        // return view('welcome');
    });

    $app->get('/cat', function ($req, $res) {
        return "meow";
    }, 'cat.route');

    $app->post('/', function ($req, $res) {
        print_r($req->payload());

        // return $res->json(200, $data);
        // echo '1';
        // return view('welcome');
    });
}