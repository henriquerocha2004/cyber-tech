<?php

namespace CyberTech\Modules\Attendance\Domain\Enums;

enum OrderStatus: string
{
    case OPEN = 'open';
    case ATTENDANCE = 'attendance';
    case BUDGET_DONE = 'budget_done';
    case EXECUTE_SERVICE = 'execute_service';
    case WAIT_PAYMENT = 'wait_payment';
    case FINISHED = 'finished';
    case CANCELLED = 'cancelled';
}