<?php

namespace CyberTech\Modules\Attendance\Domain\Exceptions;

use Exception;

class OrderStatusException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}