<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class GetFilmRequestBySlug extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function ApiValidation($request)
    {
        $validator = Validator::make($request, [
            'film_slug'     => 'required|exists:films,film_slug|max:100',
        ]);

        return $validator;
    }
}
