<?php

namespace CyberTech\Modules\Attendance\Domain\Enums;

enum OrderItemType: string
{
    case Service = 'service';
    case Product = 'product';
}
