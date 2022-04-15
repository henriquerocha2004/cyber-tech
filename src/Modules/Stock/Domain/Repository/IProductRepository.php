<?php

namespace CyberTech\Modules\Stock\Domain\Repository;

use CyberTech\Modules\Stock\Domain\Collections\ProductCollection;
use CyberTech\Modules\Stock\Domain\Entity\Product;

interface IProductRepository
{
    public function create(Product $product): void;
    public function findById(int $productId): ?Product;
    public function findAll(): ProductCollection|null;
    public function findFirst(): Product|null;
    public function update(int $productId, Product $product): void;
    public function delete(int $productId): void;
    public function clearTable(): void;
}