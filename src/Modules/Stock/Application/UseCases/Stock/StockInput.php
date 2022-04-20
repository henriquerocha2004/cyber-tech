<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Stock;

class StockInput
{
    public function __construct(
        public readonly string $typeMovement,
        public readonly int $quantity,
        public readonly string $invoice,
        public readonly string $date,
        public readonly int $supplierId,
        public readonly int $productId,
    ){
    }
}