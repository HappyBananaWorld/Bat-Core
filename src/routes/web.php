<?php

use Src\Core\Env\Env;
use Src\Core\Logger\Logger;
use Src\Models\Config;

function registerRoutes($app)
{
    $app->get('/', function ($req, $res) {
        // $data =  Config::get();
        // return $res->json(200,$data);
       $log = new Logger();
       $log->info('meow');

        return view('welcome');
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