<?php

use CyberTech\Infra\Controllers\ProductController;
use CyberTech\Modules\Stock\Application\UseCases\Products\ProductManager;
use DI\Container;

return [
    ProductController::class => function (Container $c) {
        return new ProductController(
            $c->get(ProductManager::class)
        );
    }
];
