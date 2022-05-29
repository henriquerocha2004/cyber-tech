<?php

namespace CyberTech\Modules\Attendance\Domain\Collections;

use CyberTech\Modules\Attendance\Domain\Entity\Phone;
use Iterator;

class PhoneCollection implements Iterator
{
    private array $phones = [];
    private int $pointer = 0;

    public function add(Phone $phone): void
    {
        $this->phones[] = $phone;
    }

    public function update(int $pointer, Phone $phone): void
    {
        $this->phones[$pointer] = $phone;
    }

    public function delete(int $phoneId): void
    {
        foreach ($this->phones as $key => $phone) {
            if ($phone->id == $phoneId) {
                unset($this->phones[$key]);
            }
        }
    }

    public function current(): mixed
    {
        return $this->phones[$this->pointer];
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
        return $this->pointer < count($this->phones);
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }
}