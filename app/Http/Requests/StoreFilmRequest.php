<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class StoreFilmRequest
{

    public static function ApiValidation($request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|max:50',
            'film_slug'     => 'required|unique:films,film_slug|max:100',
            'description'     => 'required',
            'release_date'     => 'required||max:50',
            'ticket_price'     => 'required||max:50',
            'country'     => 'required||max:100',
            'photo'     => 'required|file',
            'genre_id'     => 'required|exists:genres,id|max:50',
        ]);

        return $validator;
    }
}
