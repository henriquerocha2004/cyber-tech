<?php

namespace CyberTech\Infra\Storage\Memory;

use CyberTech\Modules\Stock\Domain\Collections\ProductCollection;
use CyberTech\Modules\Stock\Domain\Entity\Product;
use CyberTech\Modules\Stock\Domain\Repository\IProductRepository;

class ProductRepository implements IProductRepository
{
    private ProductCollection $products;

    public function __construct()
    {
        $this->products = new ProductCollection();
    }

    public function create(Product $product): void
    {
        $this->products->add($product);
    }

    public function findById(int $productId): ?Product
    {
        foreach ($this->products as $product) {
            if ($product->id == $productId) {
                return $product;
            }
        }
        return null;
    }

    public function update(int $productId, Product $productUpdate): void
    {
        foreach ($this->products as $product) {
            if ($product->id == $productId) {
                $this->products->update($this->products->key(), $product);
            }
        }
    }

    public function delete(int $productId): void
    {
        $this->products->delete($productId);
    }

    public function clearTable(): void
    {
        $this->products = new ProductCollection();
    }
}