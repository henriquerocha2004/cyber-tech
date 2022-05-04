<?php

use CyberTech\Infra\Storage\Database\CategoriesRepository;
use CyberTech\Infra\Storage\Database\ProductRepository;
use CyberTech\Infra\Storage\Database\StockRepository;
use CyberTech\Infra\Storage\Database\SupplierRepository;
use CyberTech\Modules\Stock\Application\UseCases\Categories\CategoryManager;
use CyberTech\Modules\Stock\Application\UseCases\Products\ProductManager;
use CyberTech\Modules\Stock\Application\UseCases\Stock\CreateStock;
use CyberTech\Modules\Stock\Application\UseCases\Suppliers\SupplierManager;
use DI\Container;

return [
    ProductManager::class => function (Container $c) {
        return new ProductManager(
            $c->get(ProductRepository::class)
        );
    },
    CategoryManager::class => function (Container $c) {
        return new CategoryManager(
            $c->get(CategoriesRepository::class)
        );
    },
    SupplierManager::class => function (Container $c) {
        return new SupplierManager(
            $c->get(SupplierRepository::class)
        );
    },
    CreateStock::class => function (Container $c) {
        return new CreateStock(
            $c->get(StockRepository::class)
        );
    }
];
