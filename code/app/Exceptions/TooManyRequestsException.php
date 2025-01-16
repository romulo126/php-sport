<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class TooManyRequestsException extends Exception
{
    protected $code = Response::HTTP_TOO_MANY_REQUESTS;
    protected $message = 'Too many requests have been made. Please try again later.';

    public function __construct(?string $message = null)
    {
        parent::__construct($message ?? $this->message, $this->code);
    }
}
