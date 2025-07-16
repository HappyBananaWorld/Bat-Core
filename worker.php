<?php

use Src\Core\Routes\Routes;
use Src\Core\Server\ServerRunner;

ini_set('display_errors', 'stderr');
require __DIR__ . '/vendor/autoload.php';

$app = new ServerRunner();
$routes = new Routes($app);
require __DIR__ . '/src/routes/web.php';

registerRoutes($routes);

$app->run(); // run server