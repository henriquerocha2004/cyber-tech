<?php

namespace CyberTech\Modules\Stock\Domain\Entity;

use CyberTech\Modules\Stock\Domain\ValueObjects\DocumentCPFCNPJ;

class Supplier
{
    public function __construct(
        public readonly string $name,
        public readonly DocumentCPFCNPJ $document,
        public readonly string $address,
        public readonly string $neighborhood,
        public readonly string $city,
        public readonly string $state,
        public int $id = 0
    ) {
    }
}
