<?php

namespace CyberTech\Infra\Storage\Database;

use CyberTech\Modules\Stock\Domain\Collections\CategoryCollection;
use CyberTech\Modules\Stock\Domain\Entity\Category;
use CyberTech\Modules\Stock\Domain\Repository\ICategoryRepository;

class CategoriesRepository implements ICategoryRepository
{
    public function __construct(
        private readonly Connection $connection
    )
    {
    }

    public function create(Category $category): void
    {
        $this->connection->query("INSERT INTO categories (description) VALUE (?)", [
            $category->description
        ]);
    }

    public function find(int $categoryId): ?Category
    {
        $result = $this->connection->query("SELECT * FROM categories WHERE id = ?", [$categoryId]);
        if (empty($result)) {
            return null;
        }

        return new Category(
            description: $result[0]['id'],
            id: $result[0]['id']
        );
    }

    public function update(int $categoryId, Category $category): void
    {
        $this->connection->query("UPDATE categories SET description = ? WHERE id = ?", [
            $category->description,
            $categoryId
        ]);
    }

    public function delete(int $categoryId): void
    {
        $this->connection->query("DELETE FROM categories WHERE id = ?", [$categoryId]);
    }

    public function findAll(): CategoryCollection|null
    {
        $results = $this->connection->query("SELECT * FROM categories", []);
        if (empty($results)) {
            return null;
        }

        $categories = new CategoryCollection();
        foreach ($results as $result) {
            $categories->add(
                new Category(
                    id: $result['id'],
                    description: $result['description']
                )
            );
        }
        return $categories;
    }

    public function findFirst(): Category|null
    {
       $result = $this->connection->query("SELECT * from categories LIMIT 1", []);
       if (empty($result)) {
           return null;
       }

       return new Category(
           id: $result[0]['id'],
           description: $result[0]['description']
       );
    }

    public function clear(): void
    {
        // TODO: Implement clear() method.
    }
}