<?php

use CyberTech\Infra\Storage\Database\Mysql\PdoAdapterMysql;
use CyberTech\Infra\Storage\Database\SupplierRepository;
use CyberTech\Modules\Stock\Domain\Entity\Supplier;
use CyberTech\Modules\Stock\Domain\ValueObjects\DocumentCPFCNPJ;

$pdoAdapterMysql = new PdoAdapterMysql();
$supplierRepository = new SupplierRepository($pdoAdapterMysql);

beforeEach(function () use ($pdoAdapterMysql){
   $pdoAdapterMysql->beginTransaction();
});

afterEach(function () use ($pdoAdapterMysql) {
    $pdoAdapterMysql->rollback();
});

test("should create a supplier", function () use ($supplierRepository) {
    $supplier = new Supplier(
        name: "Henrique Rocha",
        document: new DocumentCPFCNPJ("287.497.580-04"),
        address: "Rua Bela vista do aeroporto",
        neighborhood: "São Cristóvão",
        city: "Salvador",
        state: "BA"
    );

    $supplierRepository->create($supplier);
    $supplierDB = $supplierRepository->findFirst();
    $this->assertEquals($supplier->name, $supplierDB->name);
});

test('should update supplier', function () use ($supplierRepository) {
    $supplier = new Supplier(
        name: "Henrique Rocha",
        document: new DocumentCPFCNPJ("287.497.580-04"),
        address: "Rua Bela vista do aeroporto",
        neighborhood: "São Cristóvão",
        city: "Salvador",
        state: "BA"
    );

    $supplierRepository->create($supplier);
    $supplierDB = $supplierRepository->findFirst();
    $supplierRepository->update($supplierDB->id, new Supplier(
        name: "Henrique Silva",
        document: new DocumentCPFCNPJ("287.497.580-04"),
        address: "Rua Bela vista do aeroporto, 41",
        neighborhood: "Itapuã",
        city: "Salvador",
        state: "BA"
    ));
    $supplierDB = $supplierRepository->findFirst();
    $this->assertEquals("Henrique Silva", $supplierDB->name);
    $this->assertEquals("Rua Bela vista do aeroporto, 41", $supplierDB->address);
    $this->assertEquals("Itapuã", $supplierDB->neighborhood);
});

test('should delete supplier', function () use ($supplierRepository) {
    $supplier = new Supplier(
        name: "Henrique Rocha",
        document: new DocumentCPFCNPJ("287.497.580-04"),
        address: "Rua Bela vista do aeroporto",
        neighborhood: "São Cristóvão",
        city: "Salvador",
        state: "BA"
    );

    $supplierRepository->create($supplier);
    $supplierDB = $supplierRepository->findFirst();
    $supplierRepository->delete($supplierDB->id);
    $supplierRemoved = $supplierRepository->findFirst();
    $this->assertNull($supplierRemoved);
});