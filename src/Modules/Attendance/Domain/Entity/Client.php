<?php

namespace CyberTech\Modules\Attendance\Domain\Entity;

use CyberTech\Modules\Attendance\Domain\Collections\PhoneCollection;
use CyberTech\Modules\Attendance\Domain\ValueObjects\DocumentCPFCNPJ;

class Client
{
    public readonly PhoneCollection $phones;

    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly DocumentCPFCNPJ $documentCPFCNPJ,
        public readonly string $address,
        public readonly string $number,
        public readonly string $district,
        public readonly string $city,
        public readonly string $state,
        public readonly string $country
    ) {
    }

    public function addPhone(string $phone, string $type): void
    {
        $this->phones->add(new Phone($phone, $type));
    }
}