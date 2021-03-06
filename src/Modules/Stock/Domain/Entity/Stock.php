<?php

namespace CyberTech\Modules\Stock\Domain\Entity;

class Stock
{
    public const MOVEMENT_TYPE_IN = 'IN';
    public const MOVEMENT_TYPE_OUT = 'OUT';

    public function __construct(
        public readonly string $typeMovement,
        public readonly int $quantity,
        public readonly string $invoice,
        public readonly string $date,
        public readonly int $supplierId,
        public readonly int $productId,
        public readonly int $id = 0,
    ){
    }
}