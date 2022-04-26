<?php

use CyberTech\Infra\Storage\Database\Mysql\PdoAdapterMysql;
use CyberTech\Infra\Storage\Database\ProductRepository;
use DI\Container;

return [
    ProductRepository::class => function (Container $c) {
        return new ProductRepository(
            $c->get(PdoAdapterMysql::class)
        );
    }
];
