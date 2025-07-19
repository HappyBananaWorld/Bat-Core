<?php

namespace Src\Core\Routes;

class Routes
{
    protected static $instance = null;
    protected $serverRunner;
    protected static $namedRoutes = [];

    public function __construct($serverRunner)
    {
        $this->serverRunner = $serverRunner;
        self::$instance = $this;
    }

    public function get(string $path, callable $handler, ?string $name = null)
    {
        $this->serverRunner->addRoute("GET", $path, $handler);
        if ($name) {
            self::$namedRoutes[$name] = $path;
        }
    }

    public function post(string $path, callable $handler, ?string $name = null)
    {
        $this->serverRunner->addRoute("POST", $path, $handler);
        if ($name) {
            self::$namedRoutes[$name] = $path;
        }
    }

    public static function route(string $name)
    {
        return self::$namedRoutes[$name] ?? "not found";
    }

    public static function getInstance(): ?self
    {
        return self::$instance;
    }
}
