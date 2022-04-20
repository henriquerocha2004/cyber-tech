<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Stock;

class StockOutput
{
    public function __construct(
        public bool $result,
        public string $message = '',
        public mixed $error = null
    ){
    }
}