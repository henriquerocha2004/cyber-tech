<?php

namespace CyberTech\Modules\Attendance\Domain\Entity;

class Service
{
    public function __construct(
      public readonly string $description,
      public readonly float $price,
      public readonly int $id = 0
    ) {
    }
}