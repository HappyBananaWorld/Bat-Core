<?php

namespace Src\Core\Server;

use Nyholm\Psr7\Response;
use Nyholm\Psr7\Factory\Psr17Factory;
use Spiral\RoadRunner\Worker;
use Spiral\RoadRunner\Http\PSR7Worker;
use Src\Core\kernel;

class ServerRunner
{
    private PSR7Worker $psr7;
    private array $routes = [];

    public function __construct()
    {
        (new kernel());
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

                $path = $request->getUri()->getPath();

                // 1. بررسی فایل‌های استاتیک
                $staticFile = assets('welcome.css');
                $response = new Response(200, ['Content-Type' => 'text/plain'], "Static path: " . $staticFile);
                $this->psr7->respond($response);
                continue;

                echo "1";

                if (is_file($staticFile) && is_readable($staticFile)) {
                    $content = file_get_contents($staticFile);
                    $mimeType = mime_content_type($staticFile) ?: 'application/octet-stream';

                    $response = new Response(200, ['Content-Type' => $mimeType], $content);
                    $this->psr7->respond($response);
                    continue; // بریم سراغ درخواست بعدی
                }

                // 2. اگر فایل استاتیک نبود، بریم سراغ روت‌ها
                if (isset($this->routes[$request->getMethod()][$path])) {
                    $handler = $this->routes[$request->getMethod()][$path];

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
