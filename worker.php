<?php

require __DIR__ . '/vendor/autoload.php';

use Nyholm\Psr7\Response;
use Nyholm\Psr7\Factory\Psr17Factory;

use Spiral\RoadRunner\Worker;
use Spiral\RoadRunner\Http\PSR7Worker;

$worker = Worker::create();
$factory = new Psr17Factory();
$psr7 = new PSR7Worker($worker, $factory, $factory, $factory);

while (true) {
    try {
        $request = $psr7->waitRequest();
        if ($request === null) {
            break;
        }
    } catch (\Throwable $e) {
        $psr7->respond(new Response(400));
        continue;
    }

    try {
        $path = $request->getUri()->getPath();

        if ($path === '/') {
            $response = new Response(200, [], 'hi index');
        } elseif ($path === '/cat') {
            $response = new Response(200, [], 'meow');
        } else {
            $response = new Response(404, [], 'not found');
        }

        $psr7->respond($response);
    } catch (\Throwable $e) {
        $psr7->respond(new Response(500, [], 'server error'));
    }
}
