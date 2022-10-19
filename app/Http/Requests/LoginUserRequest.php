<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LoginUserRequest
{


    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apiValidation()
    {
        return Validator::make($this->request->all(), [
            'email'     => 'required|email|max:50',
            'password'     => 'required|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|min:8',
        ]);
    }
}
