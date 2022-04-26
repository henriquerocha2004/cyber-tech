<?php

use CyberTech\Infra\Controllers\CategoriesController;

return [
    [
        'uri' => '/categories',
        'resource' => [
            'controller' => CategoriesController::class,
            'action' => 'index'
        ],
        'methods' => ['GET']
    ],
    [
        'uri' => '/categories/create',
        'resource' => [
            'controller' => CategoriesController::class,
            'action' => 'create'
        ],
        'methods' => ['POST']
    ],
    [
        'uri' => '/categories/update/{id}}',
        'resource' => [
            'controller' => CategoriesController::class,
            'action' => 'update'
        ],
        'methods' => ['PUT']
    ],
    [
        'uri' => '/categories/delete/{id}}',
        'resource' => [
            'controller' => CategoriesController::class,
            'action' => 'delete'
        ],
        'methods' => ['DELETE']
    ],
];