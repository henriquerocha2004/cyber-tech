<?php

namespace CyberTech\Modules\Attendance\Domain\Collections;

use CyberTech\Modules\Attendance\Domain\Entity\Equipment;
use Iterator;

class EquipmentCollection implements Iterator
{

    private array $equipments = [];
    private int $pointer = 0;

    public function add(Equipment $equipment): void
    {
        $this->equipments[] = $equipment;
    }

    public function update(int $pointer, Equipment $equipment): void
    {
        $this->equipments[$pointer] = $equipment;
    }

    public function delete(int $equipmentId): void
    {
        foreach ($this->equipments as $key => $equipment) {
            if ($equipment->id == $equipmentId) {
                unset($this->equipments[$key]);
            }
        }
    }

    public function current(): mixed
    {
        return $this->equipments[$this->pointer];
    }

    public function next(): void
    {
        $this->equipments++;
    }

    public function key(): mixed
    {
        return $this->pointer;
    }

    public function valid(): bool
    {
        return $this->pointer < count($this->equipments);
    }

    public function rewind(): void
    {
        $this->pointer = 0;
    }
}