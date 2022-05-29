<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../Core/Kernel.php';

use Core\Kernel;
use Symfony\Component\HttpFoundation\Request;

$routes = require __DIR__ . '/../config/routes.php';
$container = require __DIR__ . '/../config/container.php';

$request = Request::createFromGlobals();

$app = new Kernel();
$app->setContainer($container);

foreach ($routes as $route) {
    $app->map($route['uri'], $route['resource'], $route['methods']);
}

$response = $app->handle($request);
$response->send();



