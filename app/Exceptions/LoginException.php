<?php

namespace App\Exceptions;

use Exception;
use Log;

class LoginException extends Exception
{
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        Log::debug($this->getMessage());
    }
}
