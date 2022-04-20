<?php

namespace CyberTech\Infra\Storage\Database;

use CyberTech\Modules\Stock\Domain\Collections\ProductCollection;
use CyberTech\Modules\Stock\Domain\Entity\Product;
use CyberTech\Modules\Stock\Domain\Repository\IProductRepository;

class ProductRepository implements IProductRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function create(Product $product): void
    {
        $this->connection->query(
            "INSERT INTO products (description, brand, model, min_quantity, category_id, cost_price, available)
                  VALUES (?,?,?,?,?,?,?)",
            [
                $product->description,
                $product->brand,
                $product->model,
                $product->minQuantity,
                $product->categoryId,
                $product->costPrice,
                $product->available,
            ]);
    }

    public function findById(int $productId): ?Product
    {
      $result = $this->connection->query("SELECT * FROM products WHERE id = ?", [$productId]);

      if (empty($result)) {
          return null;
      }

      return new Product(
          description: $result[0]['description'],
          brand: $result[0]['brand'],
          model: $result[0]['model'],
          minQuantity: $result[0]['min_quantity'],
          categoryId: $result[0]['category_id'],
          costPrice: $result[0]['cost_price'],
          available: $result[0]['available'],
          salePrice: $result[0]['sale_price'] ?? 0,
          id: $result[0]['id'],
      );
    }

    public function update(int $productId, Product $product): void
    {
        $this->connection->query(
            "UPDATE products SET description = ?, brand = ?, model = ?, min_quantity = ?, category_id = ?, cost_price = ?, available = ?, sale_price = ? WHERE id = ?",
            [
                $product->description,
                $product->brand,
                $product->model,
                $product->minQuantity,
                $product->categoryId,
                $product->costPrice,
                $product->available,
                $product->salePrice,
                $productId,
            ]
        );
    }

    public function delete(int $productId): void
    {
        $this->connection->query("DELETE FROM products WHERE id = ?", [$productId]);
    }

    public function clearTable(): void
    {
        $this->connection->query("TRUNCATE TABLE products", []);
    }

    public function findAll(): ProductCollection|null
    {
        $results = $this->connection->query("SELECT * FROM products", []);
        if (empty($results)) {
            return null;
        }

        $products = new ProductCollection();
        foreach ($results as $result) {
            $product = new Product(
                description: $result['description'],
                brand: $result['brand'],
                model: $result['model'],
                minQuantity: $result['min_quantity'],
                categoryId: $result['category_id'],
                costPrice: $result['cost_price'],
                available: $result['available'],
                salePrice: $result['sale_price'],
                id: $result['id']
            );
            $products->add($product);
        }

        return $products;
    }

    public function findFirst(): Product|null
    {
        $result = $this->connection->query("SELECT * FROM products LIMIT 1", []);
        if (empty($result)) {
            return null;
        }
        return new Product(
            description: $result[0]['description'],
            brand: $result[0]['brand'],
            model: $result[0]['model'],
            minQuantity: $result[0]['min_quantity'],
            categoryId: $result[0]['category_id'],
            costPrice: $result[0]['cost_price'],
            available: $result[0]['available'],
            salePrice: $result[0]['sale_price'] ?? 0,
            id: $result[0]['id'],
        );
    }
}