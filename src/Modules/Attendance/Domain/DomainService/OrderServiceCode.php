<?php

namespace CyberTech\Modules\Attendance\Domain\DomainService;

class OrderServiceCode
{
    public static function generate(): string
    {
        return date('Ymd') . rand(1, 8000);
    }
}