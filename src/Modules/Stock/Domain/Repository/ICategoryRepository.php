<?php

namespace CyberTech\Modules\Stock\Domain\Repository;

use CyberTech\Modules\Stock\Domain\Collections\CategoryCollection;
use CyberTech\Modules\Stock\Domain\Entity\Category;

interface ICategoryRepository
{
    public function create(Category $category): void;
    public function find(int $categoryId): ?Category;
    public function update(int $categoryId, Category $category): void;
    public function delete(int $categoryId): void;
    public function findAll(): CategoryCollection|null;
    public function findFirst(): Category|null;
    public function clear(): void;
}