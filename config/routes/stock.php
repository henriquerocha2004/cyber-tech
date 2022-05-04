<?php

use CyberTech\Infra\Controllers\StockController;

return [
    [
        'uri' => '/stock/create',
        'resource' => [
            'controller' => StockController::class,
            'action' => 'create'
        ],
        'methods' => ['POST']
    ]
];
