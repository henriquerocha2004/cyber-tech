<?php

namespace CyberTech\Modules\Stock\Domain\Collections;

use CyberTech\Modules\Stock\Domain\Entity\Product;
use Iterator;

class ProductCollection implements Iterator
{
    private array $products = [];
    private int $pointer = 0;

    public function add(Product $product): void
    {
        $this->products[] = $product;
    }

    public function update(int $pointer, Product $product): void
    {
        $this->products[$pointer] = $product;
    }

    public function delete(int $productId): void
    {
        foreach ($this->products as $key => $product) {
            if ($product->id == $productId) {
                unset($this->products[$key]);
            }
        }
    }

    public function current(): ?Product
    {
        return $this->products[$this->pointer];
    }

    public function next(): void
    {
        $this->pointer++;
    }

    public function key(): int
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return $this->pointer < count($this->products);
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }
}