<?php

namespace CyberTech\Modules\Stock\Domain\Collections;

use CyberTech\Modules\Stock\Domain\Entity\Category;

class CategoryCollection implements \Iterator
{
    private array $categories = [];
    private int $pointer = 0;

    public function add(Category $category): void
    {
        $this->categories[] = $category;
    }

    public function update(int $pointer, Category $category): void
    {
        $this->categories[$pointer] = $category;
    }

    public function delete(int $categoryId): void
    {
        foreach ($this->categories as $key => $category) {
            if ($category->id == $categoryId) {
                unset($this->categories[$key]);
            }
        }
    }

    public function current(): mixed
    {
        return $this->categories[$this->pointer];
    }

    public function next(): void
    {
        $this->categories++;
    }

    public function key(): mixed
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return $this->pointer < count($this->categories);
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }
}
