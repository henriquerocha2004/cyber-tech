<?php

use CyberTech\Infra\Storage\Database\CategoriesRepository;
use CyberTech\Infra\Storage\Database\Connection;
use CyberTech\Infra\Storage\Database\Mysql\PdoAdapterMysql;
use CyberTech\Infra\Storage\Database\ProductRepository;
use CyberTech\Modules\Stock\Application\UseCases\Products\{ProductManager};
use CyberTech\Modules\Stock\Application\UseCases\Products\ProductInput;
use CyberTech\Modules\Stock\Domain\Entity\Category;
use JetBrains\PhpStorm\ArrayShape;

$adapterPdoMysql = new PdoAdapterMysql();
$productRepository = new ProductRepository($adapterPdoMysql);

beforeEach(function () use ($adapterPdoMysql) {
    $adapterPdoMysql->beginTransaction();
});

afterEach(function () use ($adapterPdoMysql) {
    $adapterPdoMysql->rollback();
});


#[ArrayShape(['categoryId' => "int"])]
function createProductDependencies(Connection $connection): array {
   $categoryRepository = new CategoriesRepository($connection);
   $categoryRepository->create(
       new Category(
           description: "Roteadores"
       )
   );
   $category = $categoryRepository->findFirst();

   return ['categoryId' => $category->id];
}

test('should create new product', function () use ($productRepository, $adapterPdoMysql) {
    $dependencies = createProductDependencies($adapterPdoMysql);
    $input = new ProductInput(
        description: "Wireless Router",
        brand: "TP LINK",
        model: "TP-100WL",
        minQuantity: 5,
        categoryId: $dependencies['categoryId'],
        costPrice: 25.00,
        available: true,
    );

    $createProduct = new ProductManager($productRepository);
    $output = $createProduct->handleCreate($input);
    $this->assertEquals(true, $output->result);
});

test('should update product', function () use ($productRepository, $adapterPdoMysql) {
    $dependencies = createProductDependencies($adapterPdoMysql);
    $input = new ProductInput(
        description: "Wireless Router",
        brand: "TP LINK",
        model: "TP-100WL",
        minQuantity: 5,
        categoryId: $dependencies['categoryId'],
        costPrice: 25.00,
        available: true,
    );

    $createProduct = new ProductManager($productRepository);
    $createProduct->handleCreate($input);
    $product = $productRepository->findFirst();
    $product->description = "Wireless Router 2";
    $product->brand = "D-Link";
    $product->costPrice = 50.00;
    $productInput = new ProductInput(
        description: $product->description,
        brand: $product->brand,
        model: $product->model,
        minQuantity: $product->minQuantity,
        categoryId: $product->categoryId,
        costPrice: $product->costPrice,
        available: $product->available,
        salePrice: $product->salePrice
    );


    $productManager = new ProductManager($productRepository);
    $productManager->handleUpdate($productInput, $product->id);
    $product = $productRepository->findFirst();
    $this->assertEquals("Wireless Router 2", $product->description);
    $this->assertEquals("D-Link", $product->brand);
    $this->assertEquals(50.00, $product->costPrice);
});

test('should delete product', function () use ($productRepository, $adapterPdoMysql){
    $dependencies = createProductDependencies($adapterPdoMysql);
    $input = new ProductInput(
        description: "Wireless Router",
        brand: "TP LINK",
        model: "TP-100WL",
        minQuantity: 5,
        categoryId: $dependencies['categoryId'],
        costPrice: 25.00,
        available: true,
    );

    $createProduct = new ProductManager($productRepository);
    $createProduct->handleCreate($input);
    $product = $productRepository->findFirst();
    $productManager = new ProductManager($productRepository);
    $productManager->handleDelete($product->id);
    $product = $productRepository->findFirst();
    $this->assertNull($product);
});