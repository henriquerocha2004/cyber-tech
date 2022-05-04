<?php

use CyberTech\Infra\Controllers\SuppliersController;

return [
    [
        'uri' => '/suppliers',
        'resource' => [
            'controller' => SuppliersController::class,
            'action' => 'index'
        ],
        'methods' => ['GET']
    ],
    [
        'uri' => '/suppliers/create',
        'resource' => [
            'controller' => SuppliersController::class,
            'action' => 'create'
        ],
        'methods' => ['POST']
    ],
    [
        'uri' => '/suppliers/update/{id}',
        'resource' => [
            'controller' => SuppliersController::class,
            'action' => 'update'
        ],
        'methods' => ['PUT']
    ],
    [
        'uri' => '/suppliers/delete/{id}',
        'resource' => [
            'controller' => SuppliersController::class,
            'action' => 'delete'
        ],
        'methods' => ['DELETE']
    ],
];
