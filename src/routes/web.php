<?php


function registerRoutes($app)
{
    $app->get('/', fn() => 'hi');
}