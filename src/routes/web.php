<?php

function registerRoutes($app)
{
    $app->get('/', function ($req, $res) {
        return view('welcome');
    });

    $app->post('/', function ($req, $res) {
        $body = (string) $req->getBody();
        $data = json_decode($body, true); // آرایه‌ی PHP


        return $res->json(200, $data);
        // echo '1';
        // return view('welcome');
    });
}