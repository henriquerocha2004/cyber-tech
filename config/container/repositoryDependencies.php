<?php

use CyberTech\Infra\Storage\Database\CategoriesRepository;
use CyberTech\Infra\Storage\Database\Mysql\PdoAdapterMysql;
use CyberTech\Infra\Storage\Database\ProductRepository;
use CyberTech\Infra\Storage\Database\StockRepository;
use CyberTech\Infra\Storage\Database\SupplierRepository;
use DI\Container;

$adapterPersistence = PdoAdapterMysql::class;

return [
    ProductRepository::class => function (Container $c) use ($adapterPersistence) {
        return new ProductRepository(
            $c->get($adapterPersistence)
        );
    },
    CategoriesRepository::class => function (Container $c) use ($adapterPersistence) {
        return new CategoriesRepository(
            $c->get($adapterPersistence)
        );
    },
    SupplierRepository::class => function (Container $c) use ($adapterPersistence) {
        return new SupplierRepository(
            $c->get($adapterPersistence)
        );
    },
    StockRepository::class => function (Container $c) use ($adapterPersistence) {
        return new StockRepository(
            $c->get($adapterPersistence)
        );
    }
];
