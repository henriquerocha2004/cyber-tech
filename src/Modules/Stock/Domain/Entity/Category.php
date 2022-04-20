<?php

namespace CyberTech\Modules\Stock\Domain\Entity;

class Category
{
    public function __construct(
        public readonly string $description,
        public readonly int $id = 0
    ) {
    }
}
