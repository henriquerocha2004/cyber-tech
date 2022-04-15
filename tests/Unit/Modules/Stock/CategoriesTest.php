<?php

use CyberTech\Infra\Storage\Database\CategoriesRepository;
use CyberTech\Infra\Storage\Database\Mysql\PdoAdapterMysql;
use CyberTech\Modules\Stock\Domain\Entity\Category;

$pdoAdapterMysql = new PdoAdapterMysql();
$categoryRepository = new CategoriesRepository($pdoAdapterMysql);

beforeEach(function () use ($pdoAdapterMysql){
    $pdoAdapterMysql->beginTransaction();
});

afterEach(function () use ($pdoAdapterMysql) {
    $pdoAdapterMysql->rollback();
});

test("should create category", function () use ($categoryRepository) {
     $category = new Category(
         description: "Roteadores"
     );
     $categoryRepository->create($category);
     $categoryDB = $categoryRepository->findFirst();
     $this->assertEquals("Roteadores", $categoryDB->description);
});