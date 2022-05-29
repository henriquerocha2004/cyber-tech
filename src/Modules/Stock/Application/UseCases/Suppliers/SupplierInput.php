<?php

namespace CyberTech\Modules\Stock\Application\UseCases\Suppliers;

use CyberTech\Modules\Stock\Domain\ValueObjects\DocumentCPFCNPJ;

class SupplierInput
{
    public function __construct(
        public readonly string $name,
        public readonly DocumentCPFCNPJ $document,
        public readonly string $address,
        public readonly string $neighborhood,
        public readonly string $city,
        public readonly string $state,
    ) {
    }
}
