<?php

use CyberTech\Infra\Storage\Database\Mysql\PdoAdapterMysql;
use CyberTech\Infra\Storage\Database\StockRepository;
use CyberTech\Modules\Stock\Application\Query\Stock\GetQuantityProductStock;
use CyberTech\Modules\Stock\Application\UseCases\Stock\CreateStock;
use CyberTech\Modules\Stock\Application\UseCases\Stock\StockInput;

$adapterPdoMysql = new PdoAdapterMysql();
$stockRepository = new StockRepository($adapterPdoMysql);

beforeEach(function () use ($adapterPdoMysql) {
    $adapterPdoMysql->beginTransaction();
});

afterEach(function () use ($adapterPdoMysql) {
    $adapterPdoMysql->rollback();
});

test("should create stock in", function () use ($stockRepository, $adapterPdoMysql) {
    $dependency = createStockDependencies($adapterPdoMysql);
    $stockInput = new StockInput(
        typeMovement: "IN",
        quantity: 10,
        invoice: '12345678',
        date: '2022-04-15',
        supplierId: $dependency['supplierId'],
        productId: $dependency['productId']
    );
    $createStock = new CreateStock($stockRepository);
    $createStock->handle($stockInput);
    $stock = $stockRepository->findFirst();
    $this->assertEquals("IN", $stock->typeMovement);
    $this->assertEquals("12345678", $stock->invoice);
});

test('most obtain the quantity of a product in stock', function () use ($stockRepository, $adapterPdoMysql) {
    $dependency = createStockDependencies($adapterPdoMysql);
    $stockInput = new StockInput(
        typeMovement: "IN",
        quantity: 10,
        invoice: '12345678',
        date: '2022-04-15',
        supplierId: $dependency['supplierId'],
        productId: $dependency['productId']
    );
    $createStock = new CreateStock($stockRepository);
    $createStock->handle($stockInput);
    $stockInput = new StockInput(
        typeMovement: "OUT",
        quantity: 2,
        invoice: '12345678',
        date: '2022-04-15',
        supplierId: $dependency['supplierId'],
        productId: $dependency['productId']
    );
    $createStock = new CreateStock($stockRepository);
    $createStock->handle($stockInput);

    $query = new GetQuantityProductStock($adapterPdoMysql);
    $quantity = $query->execute($dependency['productId']);
    $this->assertEquals(8, $quantity);
});
