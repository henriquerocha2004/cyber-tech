<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Categories;

class CategoryOutput
{
    public function __construct(
        public bool $result,
        public string $message = '',
        public mixed $error = null,
        public int $code = 200
    ) {
    }
}
