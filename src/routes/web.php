<?php

function registerRoutes($app)
{
    $app->get('/', function ($req, $res) {
        echo $req->ip();
        // return view('welcome');
    });

    $app->post('/', function ($req, $res) {
        print_r($req->payload());

        // return $res->json(200, $data);
        // echo '1';
        // return view('welcome');
    });
}