<?php

use CyberTech\Infra\Storage\Database\CategoriesRepository;
use CyberTech\Infra\Storage\Database\Connection;
use CyberTech\Infra\Storage\Database\Mysql\PdoAdapterMysql;
use CyberTech\Infra\Storage\Database\ProductRepository;
use CyberTech\Infra\Storage\Database\StockRepository;
use CyberTech\Infra\Storage\Database\SupplierRepository;
use CyberTech\Modules\Stock\Domain\Entity\Category;
use CyberTech\Modules\Stock\Domain\Entity\Product;
use CyberTech\Modules\Stock\Domain\Entity\Stock;
use CyberTech\Modules\Stock\Domain\Entity\Supplier;
use CyberTech\Modules\Stock\Domain\ValueObjects\DocumentCPFCNPJ;
use JetBrains\PhpStorm\ArrayShape;

$adapterMysql = new PdoAdapterMysql();
$stockRepository = new StockRepository($adapterMysql);

beforeEach(function () use ($adapterMysql) {
    $adapterMysql->beginTransaction();
});

afterEach(function () use ($adapterMysql) {
   $adapterMysql->rollback();
});


test("this should create an stock in", function () use ($stockRepository, $adapterMysql) {
    $dependency = createStockDependencies($adapterMysql);
    $stockRepository->insert(
        new Stock(
            typeMovement: "IN",
            quantity: 10,
            invoice: '12345678',
            date: '2022-04-15',
            supplierId: $dependency['supplierId'],
            productId: $dependency['productId']
        )
    );

    $stock = $stockRepository->findFirst();
    $this->assertEquals("IN", $stock->typeMovement);
    $this->assertEquals("12345678", $stock->invoice);
    $this->assertEquals($dependency['supplierId'], $stock->supplierId);
    $this->assertEquals($dependency['productId'], $stock->productId);
});

test("this should create an stock out", function () use ($stockRepository, $adapterMysql) {
    $dependency = createStockDependencies($adapterMysql);
    $stockRepository->insert(
        new Stock(
            typeMovement: "OUT",
            quantity: 10,
            invoice: '12345678',
            date: '2022-04-15',
            supplierId: $dependency['supplierId'],
            productId: $dependency['productId']
        )
    );

    $stock = $stockRepository->findFirst();
    $this->assertEquals("OUT", $stock->typeMovement);
    $this->assertEquals("12345678", $stock->invoice);
    $this->assertEquals($dependency['supplierId'], $stock->supplierId);
    $this->assertEquals($dependency['productId'], $stock->productId);
});