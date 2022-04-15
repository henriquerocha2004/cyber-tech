<?php

namespace CyberTech\Modules\Stock\Domain\Exceptions;

use Exception;

class ProductException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}