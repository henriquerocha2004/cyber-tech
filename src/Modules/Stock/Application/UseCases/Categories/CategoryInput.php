<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Categories;

class CategoryInput
{
    public function __construct(
        public readonly string $description,
    ) {
    }
}