<?php

namespace App\Http\Requests;

use App\Abstracts\AbstractRequest;
use Illuminate\Support\Facades\Validator;

class GetFilmRequestBySlug extends AbstractRequest
{

    /**
     * apiValidation function
     *
     * @return object
     */
    public function apiValidation(): object
    {
        $data['film_slug'] = $this->request->slug;
        $validator = Validator::make($data, [
            'film_slug'     => 'required|exists:films,film_slug|max:100',
        ]);
        return $validator;
    }
}
