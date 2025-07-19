<?php

namespace Src\Core;

use Src\Core\Env\Env;

class kernel
{
    public function __construct(){
        $this->load();
    }

    public function load()
    {
        Env::load();
        require_once __DIR__ . "/Helpers/helpers.php";
    }
}