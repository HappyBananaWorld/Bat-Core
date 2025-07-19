<?php

namespace Src\Core;

use Src\Core\Database\Database;
use Src\Core\Env\Env;

class kernel
{
    public function __construct(){
        $this->load();
    }

    public function load()
    {
        Env::load();
        Database::init();
        require_once __DIR__ . "/Helpers/helpers.php";
    }
}