<?php

namespace CyberTech\Modules\Stock\Domain\Collections;

use CyberTech\Modules\Stock\Domain\Entity\Supplier;
use Iterator;

class SupplierCollection implements Iterator
{
    private array $suppliers = [];
    private int $pointer = 0;

    public function add(Supplier $supplier): void
    {
        $this->suppliers[] = $supplier;
    }

    public function update(int $pointer, Supplier $supplier): void
    {
        $this->suppliers[$pointer] = $supplier;
    }

    public function delete(int $supplierId): void
    {
        foreach ($this->suppliers as $key => $supplier) {
            if ($supplier->id == $supplierId) {
                unset($this->suppliers[$key]);
            }
        }
    }

    public function current(): mixed
    {
        return $this->suppliers[$this->pointer];
    }

    public function next(): void
    {
        $this->suppliers++;
    }

    public function key(): mixed
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return $this->pointer < count($this->suppliers);
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }
}