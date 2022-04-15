<?php

use CyberTech\Infra\Storage\Database\CategoriesRepository;
use CyberTech\Infra\Storage\Database\Mysql\PdoAdapterMysql;
use CyberTech\Infra\Storage\Database\ProductRepository;
use CyberTech\Modules\Stock\Domain\Entity\Category;
use CyberTech\Modules\Stock\Domain\Entity\Product;

$adapterPdoMysql = new PdoAdapterMysql();
$productRepository = new ProductRepository($adapterPdoMysql);
$categoryRepository = new CategoriesRepository($adapterPdoMysql);

beforeEach(function () use ($adapterPdoMysql) {
    $adapterPdoMysql->beginTransaction();
});

afterEach(function () use ($adapterPdoMysql) {
    $adapterPdoMysql->rollback();
});


test("this should create an new product", function () use ($productRepository, $categoryRepository) {
    $category = new Category(
        description: "Roteadores"
    );
    $categoryRepository->create($category);
    $category = $categoryRepository->findFirst();

    $product = new Product(
        description: "Wireless Router",
        brand: "TP LINK",
        model: "TP-100WL",
        minQuantity: 5,
        categoryId: $category->id,
        costPrice: 25.00,
        available: true
    );
    $productRepository->create($product);
    $productDB = $productRepository->findFirst();
    $this->assertEquals($product->description, $productDB->description);
});

test('this should update a product', function () use ($productRepository, $categoryRepository) {
    $category = new Category(
        description: "Roteadores"
    );
    $categoryRepository->create($category);
    $category = $categoryRepository->findFirst();


    $product = new Product(
        description: "Wireless Router",
        brand: "TP LINK",
        model: "TP-100WL",
        minQuantity: 5,
        categoryId: $category->id,
        costPrice: 25.00,
        available: true,
    );
    $productRepository->create($product);
    $productDB = $productRepository->findFirst();
    $product->model = "TP-200WL";
    $productRepository->update($productDB->id, $product);
    $productDB = $productRepository->findFirst();
    $this->assertEquals($product->model, $productDB->model);
});

test('this should remove one product', function () use ($productRepository, $categoryRepository) {
    $category = new Category(
        description: "Roteadores"
    );
    $categoryRepository->create($category);
    $category = $categoryRepository->findFirst();

    $product = new Product(
        description: "Wireless Router",
        brand: "TP LINK",
        model: "TP-100WL",
        minQuantity: 5,
        categoryId: $category->id,
        costPrice: 25.00,
        available: true,
    );
    $productRepository->create($product);
    $productDB = $productRepository->findFirst();
    $productRepository->delete($productDB->id);
    $this->assertNull($productRepository->findById($product->id));
});


