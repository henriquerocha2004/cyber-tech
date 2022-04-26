<?php

use DI\ContainerBuilder;

$controllerDependencies = require __DIR__ . '/container/controllerDependencies.php';
$managerDependencies = require __DIR__ . '/container/managerDependencies.php';
$repositoryDependencies = require __DIR__ . '/container/repositoryDependencies.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    ...$controllerDependencies,
    ...$managerDependencies,
    ...$repositoryDependencies,
]);

return $containerBuilder->build();
