<?php

namespace App\Http\Requests;

use App\Abstracts\AbstractRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StoreGenreRequest extends AbstractRequest
{

    /**
     * apiValidation function
     *
     * @return object
     */
    public function apiValidation(): object
    {
        return  Validator::make($this->request->all(), [
            'genre_id'     => 'required|exists:genres,id',
            'film_id'     => 'required|exists:films,id|max:20',
        ]);
    }
}
