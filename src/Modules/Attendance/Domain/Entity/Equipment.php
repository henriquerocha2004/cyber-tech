<?php

namespace CyberTech\Modules\Attendance\Domain\Entity;

class Equipment
{
    public function __construct(
      public string $description,
      public string $brand,
      public string $model,
      public string $defect,
      public string $serial = "",
      public string $observations= "",
      public int $id = 0
    ) {
    }
}