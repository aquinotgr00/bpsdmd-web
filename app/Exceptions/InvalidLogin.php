<?php

namespace App\Exceptions;

class InvalidLogin extends LoginException
{
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        \Log::debug($this->getMessage());
    }
}
