<?php

namespace App\Exceptions;

class OrgDeleteException extends \Exception
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
