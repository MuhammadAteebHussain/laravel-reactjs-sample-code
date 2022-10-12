<?php

namespace App\Exceptions;

use Exception;

class GeneralException extends Exception
{
    public function report()
    {
        # code...

    }

    public function render($request)
    {
        dd('asdsad');
        
        return 'some thing went wrong';
    }
}
