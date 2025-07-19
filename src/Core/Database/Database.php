<?php

namespace Src\Core\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Core\Env\Env;

class Database
{
    public static function init()
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver' => Env::get('DB_CONNECTION', 'mysql'),
            'host' => Env::get('DB_HOST', '127.0.0.1'),
            'database' => Env::get('DB_DATABASE', 'forge'),
            'username' => Env::get('DB_USERNAME', 'forge'),
            'password' => Env::get('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'port' => Env::get('DB_PORT', 3306),
        ]);

        // Make this Capsule instance available globally via static methods
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM
        $capsule->bootEloquent();
    }
}
