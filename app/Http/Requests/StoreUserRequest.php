<?php

namespace App\Http\Requests;

use App\Abstracts\AbstractRequest;
use Illuminate\Support\Facades\Validator;

class StoreUserRequest extends AbstractRequest
{
    /**
     * apiValidation function
     *
     * @return object
     */
    public function apiValidation(): object
    {
        return Validator::make($this->request->all(), [
            'name'     => 'required|max:50|regex:/^[a-zA-Z]+$/u',
            'email'     => 'required|email|unique:users,email|max:50',
            'password'     => 'required|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|min:8',
            'confirm_password'     => 'required|same:password'
        ]);
    }
}
