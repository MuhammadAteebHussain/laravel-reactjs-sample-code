<?php

namespace App\Http\Requests;

use App\Abstracts\AbstractRequest;
use Illuminate\Support\Facades\Validator;


class LoginUserRequest extends AbstractRequest
{
    /**
     * apiValidation function
     *
     * @return object
     */
    public function apiValidation(): object
    {
        return Validator::make($this->request->all(), [
            'email'     => 'required|email|max:50',
            'password'     => 'required|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|min:8',
        ]);
    }
}
