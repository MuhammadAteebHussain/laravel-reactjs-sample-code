<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class StoreUserRequest
{

    public static function ApiValidation($request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|max:50|regex:/^[a-zA-Z]+$/u',
            'email'     => 'required|email|unique:users,email|max:50',
            'password'     => 'required|string|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|min:8',
            'confirm_password'     => 'required|same:password'
        ]);

        return $validator;
    }
}
