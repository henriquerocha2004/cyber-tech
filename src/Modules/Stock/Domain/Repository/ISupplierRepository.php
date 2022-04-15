<?php

namespace CyberTech\Modules\Stock\Domain\Repository;

use CyberTech\Modules\Stock\Domain\Collections\SupplierCollection;
use CyberTech\Modules\Stock\Domain\Entity\Supplier;

interface ISupplierRepository
{
    public function create(Supplier $supplier): void;
    public function find(int $supplierId): ?Supplier;
    public function update(int $supplierId, Supplier $supplier): void;
    public function delete(int $supplierId): void;
    public function findAll(): SupplierCollection|null;
    public function findFirst(): Supplier|null;
    public function clear(): void;
}