<?php


function registerRoutes($app)
{
    $app->get('/', function () {
        return "hi";
    });
}