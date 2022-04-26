<?php

use CyberTech\Infra\Storage\Database\CategoriesRepository;
use CyberTech\Infra\Storage\Database\Mysql\PdoAdapterMysql;
use CyberTech\Modules\Stock\Application\UseCases\Categories\CategoryInput;
use CyberTech\Modules\Stock\Application\UseCases\Categories\CategoryManager;

$adapterPdoMysql = new PdoAdapterMysql();
$categoriesRepository = new CategoriesRepository($adapterPdoMysql);

beforeEach(function () use ($adapterPdoMysql) {
    $adapterPdoMysql->beginTransaction();
});

afterEach(function () use ($adapterPdoMysql) {
    $adapterPdoMysql->rollback();
});

test("should create category", function () use ($categoriesRepository) {
    $input = new CategoryInput(
        description: "Roteadores"
    );

    $manager = new CategoryManager($categoriesRepository);
    $manager->handleCreate($input);
    $category = $categoriesRepository->findFirst();
    $this->assertEquals("Roteadores", $category->description);
});

test('should update category', function () use ($categoriesRepository) {
    $input = new CategoryInput(
        description: "Roteadores"
    );

    $manager = new CategoryManager($categoriesRepository);
    $manager->handleCreate($input);
    $category = $categoriesRepository->findFirst();
    $input = new CategoryInput(
        description: "Placa Mãe"
    );
    $manager->handleUpdate($input, $category->id);
    $categoty = $categoriesRepository->findFirst();
    $this->assertEquals("Placa Mãe", $categoty->description);
});

test('should delete category', function () use ($categoriesRepository) {
    $input = new CategoryInput(
        description: "Roteadores"
    );

    $manager = new CategoryManager($categoriesRepository);
    $manager->handleCreate($input);
    $category = $categoriesRepository->findFirst();
    $manager->handleDelete($category->id);
    $category = $categoriesRepository->findFirst();
    $this->assertNull($category);
});
