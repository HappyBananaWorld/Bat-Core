<?php

namespace Src\Core\Server;

use Nyholm\Psr7\Response;
use Nyholm\Psr7\Factory\Psr17Factory;
use Spiral\RoadRunner\Worker;
use Spiral\RoadRunner\Http\PSR7Worker;

class ServerRunner
{
    private PSR7Worker $psr7;
    public array $routes = [];

    public function __construct()
    {
        $worker = Worker::create();
        $factory = new Psr17Factory();
        $this->psr7 = new PSR7Worker($worker, $factory, $factory, $factory);
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
                $method = $request->getMethod();
                $path = $request->getUri()->getPath();

                if (isset($this->routes[$method][$path])) {
                    $handler = $this->routes[$method][$path];
                    $response = $handler($request);

                    if (!$response instanceof Response) {
                        $response = new Response(200, [], (string) $response);
                    }
                } else {
                    $response = new Response(404, [], 'not found');
                }

                $this->psr7->respond($response);
            } catch (\Throwable $e) {
                $this->psr7->respond(new Response(500, [], 'server error'));
            }
        }
    }
}
