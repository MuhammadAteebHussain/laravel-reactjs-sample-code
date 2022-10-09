<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class StoreGenreRequest
{

    public static function ApiValidation($request)
    {
        return  Validator::make($request->all(), [
            'genre_id'     => 'required|exists:genres,id|max:10',
            'film_id'     => 'required|exists:films,id|max:20',
        ]);
    }
}
