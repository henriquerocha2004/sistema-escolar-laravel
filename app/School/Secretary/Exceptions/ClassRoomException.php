<?php

namespace App\School\Secretary\Exceptions;

use Exception;
use Throwable;

class ClassRoomException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
