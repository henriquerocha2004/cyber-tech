<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

use CyberTech\Infra\Storage\Database\CategoriesRepository;
use CyberTech\Infra\Storage\Database\Connection;
use CyberTech\Infra\Storage\Database\ProductRepository;
use CyberTech\Infra\Storage\Database\SupplierRepository;
use CyberTech\Modules\Stock\Domain\Entity\Category;
use CyberTech\Modules\Stock\Domain\Entity\Product;
use CyberTech\Modules\Stock\Domain\Entity\Supplier;
use CyberTech\Modules\Stock\Domain\ValueObject\DocumentCPFCNPJ;
use JetBrains\PhpStorm\ArrayShape;

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

#[ArrayShape(['productId' => "int", 'supplierId' => "int"])]
function createStockDependencies(Connection $connection): array {
    $categoryRepository = new CategoriesRepository($connection);
    $productRepository = new ProductRepository($connection);
    $supplierRepository = new SupplierRepository($connection);

    $categoryRepository->create(
        new Category(
            description: "Roteadores"
        )
    );
    $category = $categoryRepository->findFirst();

    $productRepository->create(
        new Product(
            description: "Wireless Router",
            brand: "TP LINK",
            model: "TP-100WL",
            minQuantity: 5,
            categoryId: $category->id,
            costPrice: 25.00,
            available: true,
        )
    );
    $product = $productRepository->findFirst();
    $supplierRepository->create(
        new Supplier(
            name: "Henrique Rocha",
            document: new DocumentCPFCNPJ("287.497.580-04"),
            address: "Rua Bela vista do aeroporto",
            neighborhood: "São Cristóvão",
            city: "Salvador",
            state: "BA"
        )
    );
    $supplier = $supplierRepository->findFirst();

    return [
        'productId' => $product->id,
        'supplierId' => $supplier->id,
    ];
}
