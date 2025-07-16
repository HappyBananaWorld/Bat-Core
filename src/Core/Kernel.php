<?php

namespace Src\Core;

class kernel
{
    public function __construct(){
        $this->load();
    }

    public function load()
    {
        require_once __DIR__ . "/Helpers/helpers.php";
    }
}