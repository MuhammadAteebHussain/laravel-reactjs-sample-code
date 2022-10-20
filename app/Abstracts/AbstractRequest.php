<?php

namespace App\Abstracts;

use Illuminate\Http\Request;

abstract class AbstractRequest
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    abstract function apiValidation();
}
