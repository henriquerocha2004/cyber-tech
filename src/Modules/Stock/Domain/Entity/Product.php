<?php

namespace CyberTech\Modules\Stock\Domain\Entity;

class Product
{
    public function __construct(
        public string $description,
        public string $brand,
        public string $model,
        public int $minQuantity,
        public int $categoryId,
        public float $costPrice,
        public bool $available,
        public float $salePrice = 0.00,
        public int $id = 0,
    ){

    }
}