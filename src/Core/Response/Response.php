<?php

namespace Src\Core\Response;

use Nyholm\Psr7\Response as AppResponse;

class Response extends AppResponse
{
    public function __construct()
    {
        // parent::__construct($status, $headers, $body);
    }

    public function view($template = 'welcome', $data = [])
    {
        extract($data);

        ob_start();
        include dirname(__DIR__, 2) . '/Views/' . $template . '.php';
        $content = ob_get_clean();

        $headers = ['Content-Type' => 'text/html; charset=utf-8'];

        return new AppResponse(200, $headers, $content);
    }


    public static function json($status, $body, $headers = [])
    {
        $jsonBody = json_encode($body);

        $headers = array_merge(['Content-Type' => 'application/json; charset=utf-8'], $headers);

        return new AppResponse($status, $headers, $jsonBody);
    }
}