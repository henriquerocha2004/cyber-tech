<?php

namespace CyberTech\Modules\Attendance\Domain\Collections;

use CyberTech\Modules\Attendance\Domain\Entity\OrderItem;
use Iterator;

class OrderItemsCollection implements Iterator
{
    private array $orderItems = [];
    private int $pointer = 0;

    public function add(OrderItem $orderItem): void
    {
        $this->orderItems[] = $orderItem;
    }

    public function update(int $pointer, OrderItem $orderItem): void
    {
        $this->orderItems[$pointer] = $orderItem;
    }

    public function delete(int $orderItemId): void
    {
        foreach ($this->orderItems as $key => $orderItem) {
            if ($orderItem->id == $orderItemId) {
                unset($this->orderItems[$key]);
            }
        }
    }

    public function getTotal(): float
    {
        return array_reduce($this->orderItems, function ($carry, $item) {
            $carry += $item->value * $item->quantity;
            return $carry;
        });
    }

    public function count(): int
    {
        return count($this->orderItems);
    }

    public function current(): mixed
    {
        return $this->orderItems[$this->pointer];
    }

    public function next(): void
    {
        $this->pointer++;
    }

    public function key(): mixed
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return $this->pointer < count($this->orderItems);
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }
}