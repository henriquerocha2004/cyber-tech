<?php

namespace CyberTech\Modules\Attendance\Domain\Entity;

use CyberTech\Modules\Attendance\Domain\Enums\OrderItemType;

class OrderItem
{
    public function __construct(
      public int $itemId,
      public OrderItemType $type,
      public int $quantity,
      public float $value
    ) {
    }
}