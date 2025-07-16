<?php

namespace Src\Core\Routes;

class Routes
{
    protected $serverRunner;

    public function __construct($serverRunner)
    {
        $this->serverRunner = $serverRunner;
    }

    public function get(string $path, callable $handler)
    {
        // $this->routes["GET"][$path] = $handler;
        $this->serverRunner->routes["GET"][$path] = $handler;
    }
}