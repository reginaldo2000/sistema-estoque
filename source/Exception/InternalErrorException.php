<?php

namespace Source\Exception;

use Exception;

class InternalErrorException extends Exception
{

    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }

}
