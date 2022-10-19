<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GetFilmRequestBySlug
{

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function apiValidation()
    {
        $data['film_slug']=$this->request->slug;
        $validator = Validator::make($data, [
            'film_slug'     => 'required|exists:films,film_slug|max:100',
        ]);
        return $validator;
    }
}
