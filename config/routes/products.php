<?php

use CyberTech\Infra\Controllers\ProductController;

return [
    [
        'uri' => '/products',
        'resource' => [
            'controller' => ProductController::class,
            'action' => 'index'
        ],
        'methods' => ['GET']
    ],
    [
        'uri' => '/products/create',
        'resource' => [
            'controller' => ProductController::class,
            'action' => 'create'
        ],
        'methods' => ['POST']
    ],
    [
        'uri' => '/products/update/{id}',
        'resource' => [
            'controller' => ProductController::class,
            'action' => 'update'
        ],
        'methods' => ['PUT']
    ],
    [
        'uri' => '/products/delete/{id}',
        'resource' => [
            'controller' => ProductController::class,
            'action' => 'delete'
        ],
        'methods' => ['DELETE']
    ],
];
