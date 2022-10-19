<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class StoreGenreRequest
{

    protected Request $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function apiValidation()
    {
        return  Validator::make($this->request->all(), [
            'genre_id'     => 'required|exists:genres,id',
            'film_id'     => 'required|exists:films,id|max:20',
        ]);
    }
}
