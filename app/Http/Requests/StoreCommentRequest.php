<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class StoreCommentRequest
{

    public static function ApiValidation($request)
    {
        return  Validator::make($request->all(), [
            'user_id'     => 'integer|required|exists:users,id',
            'film_id'     => 'integer|required|exists:films,id',
            'comment'     => 'required',
        ]);
    }
}
