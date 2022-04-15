<?php

namespace CyberTech\Modules\Stock\Domain\Entity;

class Stock
{
    public function __construct(
        public int $id,
        public string $typeMovement,
        public int $quantity,
        public string $invoice,
        public string $date,
        public int $supplierId,
        public int $productId
    ){
    }
}