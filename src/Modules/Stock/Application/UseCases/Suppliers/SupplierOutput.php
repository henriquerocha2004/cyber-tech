<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Suppliers;

class SupplierOutput
{
    public function __construct(
        public bool $result,
        public string $message = '',
        public mixed $error = null
    ) {
    }
}
