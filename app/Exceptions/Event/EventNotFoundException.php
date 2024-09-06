<?php

namespace App\Exceptions\Event;

use Exception;

class EventNotFoundException extends Exception
{
    public function __construct(string $message = null, int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message ?? "Event not found", $code, $previous);
    }
}
