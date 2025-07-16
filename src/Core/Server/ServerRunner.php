<?php

namespace Src\Core\Server;

use Nyholm\Psr7\Response;
use Nyholm\Psr7\Factory\Psr17Factory;
use Spiral\RoadRunner\Worker;
use Spiral\RoadRunner\Http\PSR7Worker;

class ServerRunner
{
    private PSR7Worker $psr7;
    private array $routes = [];

    public function __construct()
    {
        $worker = Worker::create();
        $factory = new Psr17Factory();
        $this->psr7 = new PSR7Worker($worker, $factory, $factory, $factory);
    }

    public function addRoute(string $method, string $path, callable $handler): void
    {
        $this->routes[strtoupper($method)][$path] = $handler;
    }

    public function run(): void
    {
        while (true) {
            try {
                $request = $this->psr7->waitRequest();
                if ($request === null) {
                    break;
                }

                if (isset($this->routes[$request->getMethod()][$request->getUri()->getPath()])) {
                    $handler = $this->routes[$request->getMethod()][$request->getUri()->getPath()];

                    ob_start();
                    $result = $handler($request);
                    $output = ob_get_clean();

                    if ($result instanceof Response) {
                        $response = $result;
                    } elseif (is_string($result)) {
                        $response = new Response(200, [], $output . $result);
                    } else {
                        $response = new Response(200, [], $output);
                    }
                } else {
                    $response = new Response(404, [], 'Not Found');
                }
            } catch (\Throwable $e) {
                $response = new Response(500, [], 'Internal Server Error');
            }

            $this->psr7->respond($response);
        }

    }
}
