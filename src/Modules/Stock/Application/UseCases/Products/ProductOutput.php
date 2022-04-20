<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Products;

class ProductOutput
{
    public function __construct(
        public bool $result,
        public string $message = '',
        public mixed $error = null
    ){
    }
}