<?php

use CyberTech\Infra\Storage\Database\ProductRepository;
use CyberTech\Modules\Stock\Application\UseCases\Products\ProductManager;
use DI\Container;

return [
    ProductManager::class => function (Container $c) {
        return new ProductManager(
            $c->get(ProductRepository::class)
        );
    }
];
