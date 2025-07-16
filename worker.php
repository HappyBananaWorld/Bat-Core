<?php

require __DIR__ . '/vendor/autoload.php';

use Nyholm\Psr7\Response;
use Nyholm\Psr7\Factory\Psr17Factory;

use Spiral\RoadRunner\Worker;
use Spiral\RoadRunner\Http\PSR7Worker;


class BatCore
{
    private PSR7Worker $psr7;
    private array $routes = [];

    public function __construct()
    {
        $worker = Worker::create();
        $factory = new Psr17Factory();
        $this->psr7 = new PSR7Worker($worker, $factory, $factory, $factory);
    }

    public function get(string $path, callable $handler)
    {
        $this->routes["GET"][$path] = $handler;
    }

    public function run(): void
    {
        while (true) {
            try {
                $request = $this->psr7->waitRequest();
                if ($request === null) {
                    break;
                }
            } catch (\Throwable $e) {
                $this->psr7->respond(new Response(400));
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

                $this->psr7->respond($response);
            } catch (\Throwable $e) {
                $this->psr7->respond(new Response(500, [], 'server error'));
            }
        }
    }

    public function __destruct()
    {
        $this->run();
    }
}

$app = new BatCore();

$app->get('/', function () {
    return 'hi index';
});

$app->get('/cat', function () {
    return 'meow';
});

