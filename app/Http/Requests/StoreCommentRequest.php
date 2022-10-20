<?php

namespace App\Http\Requests;

use App\Abstracts\AbstractRequest;
use Illuminate\Support\Facades\Validator;


class StoreCommentRequest extends AbstractRequest
{

    /**
     * apiValidation function
     *
     * @return object
     */
    public function apiValidation(): object
    {
        return  Validator::make($this->request->all(), [
            'user_id'     => 'integer|required|exists:users,id',
            'film_id'     => 'integer|required|exists:films,id',
            'comment'     => 'required',
        ]);
    }
}
