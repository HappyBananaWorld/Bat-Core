<?php

namespace Src\Core\Server;

use Nyholm\Psr7\Response;
use Nyholm\Psr7\Factory\Psr17Factory;
use Spiral\RoadRunner\Worker;
use Spiral\RoadRunner\Http\PSR7Worker;
use Src\Core\kernel;
use Src\Core\Request\Request;
use Src\Core\Response\Response as CoreResponse;

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

    private function getMimeType(string $path): string
    {
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $map = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'eot' => 'application/vnd.ms-fontobject',
            'otf' => 'font/otf',
            'html' => 'text/html',
            'htm' => 'text/html',
            // هر چی دیگه خواستی اضافه کن
        ];

        return $map[$ext] ?? 'application/octet-stream';
    }


    public function run(): void
    {
        while (true) {
            try {
                $psr7Request = $this->psr7->waitRequest();
                ;
                if ($psr7Request === null) {
                    break;
                }

                $request = Request::fromPsr7($psr7Request);
                $path = $request->getUri()->getPath();

                // find static file
                $staticFile = public_path($path);
                /*  $response = new Response(200, ['Content-Type' => 'text/plain'], 
                 "Static path: " . $staticFile . "|" . "path" . " " . $path);
                 $this->psr7->respond($response);
                 continue; */

                // testing fucking server.php

                if (is_file($staticFile) && is_readable($staticFile)) {
                    $content = file_get_contents($staticFile);
                    $mimeType = $this->getMimeType($staticFile);

                    $response = new Response(200, ['Content-Type' => $mimeType], $content);
                    $this->psr7->respond($response);
                    continue;
                }


                // 2. اگر فایل استاتیک نبود، بریم سراغ روت‌ها
                if (isset($this->routes[$request->getMethod()][$path])) {
                    $handler = $this->routes[$request->getMethod()][$path];

                    ob_start();
                    $result = $handler($request, new CoreResponse());
                    $output = ob_get_clean();

                    if ($result instanceof Response) {
                        $response = $result;
                    } elseif (is_string($result)) {
                        $response = new Response(200, [], $output . $result);
                    } else {
                        $response = new Response(200, [], $output);
                    }
                } else {
                    // $response = new Response(404, [], 'Not Found');
                    // $response = (new CoreResponse())->view('errors/404');
                    $response = view('errors/404');
                }
            } catch (\Throwable $e) {
                $response = new Response(500, [], 'Internal Server Error' . $e);
            }

            $this->psr7->respond($response);
        }
    }

}
