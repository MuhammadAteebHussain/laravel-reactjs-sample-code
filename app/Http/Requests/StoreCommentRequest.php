<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StoreCommentRequest
{
    protected Request $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function apiValidation()
    {
        return  Validator::make($this->request->all(), [
            'user_id'     => 'integer|required|exists:users,id',
            'film_id'     => 'integer|required|exists:films,id',
            'comment'     => 'required',
        ]);
    }
}
