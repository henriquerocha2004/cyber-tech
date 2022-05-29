<?php

namespace CyberTech\Modules\Attendance\Domain\Entity;

class Phone
{
    public function __construct(
      public readonly string $phone,
      public readonly string $type,
      public readonly int $clientId = 0,
    ) {
    }
}