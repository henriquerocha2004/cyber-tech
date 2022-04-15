<?php

use CyberTech\Infra\Storage\Database\Mysql\PdoAdapterMysql;
use CyberTech\Infra\Storage\Database\ProductRepository;
use CyberTech\Infra\Storage\Database\StockRepository;
use CyberTech\Modules\Stock\Domain\Entity\Product;
use CyberTech\Modules\Stock\Domain\Entity\Stock;

$adapterMysql = new PdoAdapterMysql();
$productRepository = new ProductRepository($adapterMysql);
$stockRepository = new StockRepository(new PdoAdapterMysql());

test("this should create an stock in", function () use ($productRepository, $stockRepository) {
    $product = new Product(
        id: 1,
        description: "Wireless Router",
        brand: "TP_LINK",
        model: "TP-1000",
        minQuantity: 5,
        categoryId: 1,
        costPrice: 20.00,
        available: true
    );

    $stock = new Stock(
        id: 1,
        typeMovement: "IN",
        quantity: 13,
        invoice: "000000-111",
        date: "2022-04-15",
        supplierId: 1,
        productId: $product->id
    );

    $this->assertEquals($stock->quantity, 13);
});