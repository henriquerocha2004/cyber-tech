<?php

use CyberTech\Infra\Storage\Database\Mysql\PdoAdapterMysql;
use CyberTech\Infra\Storage\Database\SupplierRepository;
use CyberTech\Modules\Stock\Application\UseCases\Suppliers\SupplierInput;
use CyberTech\Modules\Stock\Application\UseCases\Suppliers\SupplierManager;
use CyberTech\Modules\Stock\Domain\ValueObject\DocumentCPFCNPJ;

$adapterPdoMysql = new PdoAdapterMysql();
$supplierRepository = new SupplierRepository($adapterPdoMysql);

beforeEach(function () use ($adapterPdoMysql) {
    $adapterPdoMysql->beginTransaction();
});

afterEach(function () use ($adapterPdoMysql) {
    $adapterPdoMysql->rollback();
});

test("should create supplier", function () use ($supplierRepository) {
    $supplierInput = new SupplierInput(
        name: "Henrique Rocha",
        document: new DocumentCPFCNPJ("287.497.580-04"),
        address: "Rua Bela vista do aeroporto",
        neighborhood: "São Cristóvão",
        city: "Salvador",
        state: "BA"
    );

    $supplierManager = new SupplierManager($supplierRepository);
    $result = $supplierManager->handleCreate($supplierInput);
    $this->assertTrue($result->result);
    $supplier = $supplierRepository->findFirst();
    $this->assertEquals("Henrique Rocha", $supplier->name);
    $this->assertEquals("28749758004", $supplier->document->getValue());
});

test("should update supplier", function () use ($supplierRepository) {
    $supplierInput = new SupplierInput(
        name: "Henrique Rocha",
        document: new DocumentCPFCNPJ("287.497.580-04"),
        address: "Rua Bela vista do aeroporto",
        neighborhood: "São Cristóvão",
        city: "Salvador",
        state: "BA"
    );

    $supplierManager = new SupplierManager($supplierRepository);
    $supplierManager->handleCreate($supplierInput);
    $supplier = $supplierRepository->findFirst();
    $supplierInput = new SupplierInput(
        name: "Henrique Rocha de Souza",
        document: new DocumentCPFCNPJ("287.497.580-04"),
        address: "Rua Bela vista do aeroporto",
        neighborhood: "São Cristóvão",
        city: "Simões Filho",
        state: "BA"
    );

    $supplierManager->handleUpdate($supplierInput, $supplier->id);
    $supplier = $supplierRepository->findFirst();
    $this->assertEquals("Henrique Rocha de Souza", $supplier->name);
    $this->assertEquals("Simões Filho", $supplier->city);
    
});

test('should delete supplier', function () use ($supplierRepository) {
    $supplierInput = new SupplierInput(
        name: "Henrique Rocha",
        document: new DocumentCPFCNPJ("287.497.580-04"),
        address: "Rua Bela vista do aeroporto",
        neighborhood: "São Cristóvão",
        city: "Salvador",
        state: "BA"
    );

    $supplierManager = new SupplierManager($supplierRepository);
    $supplierManager->handleCreate($supplierInput);
    $supplier = $supplierRepository->findFirst();

    $supplierManager->handleDelete($supplier->id);
    $supplier = $supplierRepository->findFirst();
    $this->assertNull($supplier);
});
