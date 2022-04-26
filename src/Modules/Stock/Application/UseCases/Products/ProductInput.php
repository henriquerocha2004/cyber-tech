<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Products;

class ProductInput
{
    public function __construct(
        public readonly string $description,
        public readonly string $brand,
        public readonly string $model,
        public readonly int $minQuantity,
        public readonly int $categoryId,
        public readonly float $costPrice,
        public readonly bool $available,
        public readonly float $salePrice = 0.00,
    ){
        $this->validate();
    }

    private function validate()
    {

    }

}