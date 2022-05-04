<?php

use CyberTech\Infra\Controllers\CategoriesController;
use CyberTech\Infra\Controllers\ProductController;
use CyberTech\Infra\Controllers\StockController;
use CyberTech\Infra\Controllers\SuppliersController;
use CyberTech\Modules\Stock\Application\UseCases\Categories\CategoryManager;
use CyberTech\Modules\Stock\Application\UseCases\Products\ProductManager;
use CyberTech\Modules\Stock\Application\UseCases\Stock\CreateStock;
use CyberTech\Modules\Stock\Application\UseCases\Suppliers\SupplierManager;
use DI\Container;

return [
    ProductController::class => function (Container $c) {
        return new ProductController(
            $c->get(ProductManager::class)
        );
    },
    CategoriesController::class => function (Container $c) {
        return new CategoriesController(
            $c->get(CategoryManager::class)
        );
    },
    SuppliersController::class => function (Container $c) {
        return new SuppliersController(
            $c->get(SupplierManager::class)
        );
    },
    StockController::class => function (Container $c) {
        return new StockController(
            $c->get(CreateStock::class)
        );
    }
];
