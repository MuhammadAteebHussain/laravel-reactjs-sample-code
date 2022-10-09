<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;


class GetCommentRequest
{

    public static function ApiValidation($request)
    {
        return  Validator::make($request->all(), [
            'film_id'     => 'integer|required|exists:films,id|max:20',
        ]);
    }
}
