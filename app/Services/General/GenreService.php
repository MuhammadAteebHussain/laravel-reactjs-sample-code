<?php

namespace App\Services\General;

use App\Components\CustomStatusCodes;
use App\Contracts\GenreServiceInterface;
use App\Models\Genre;

class GenreService implements GenreServiceInterface
{

    const SUCCESSFULLY = "genre fetched";

    public  function listGenres()
    {
        try {
            $result['code'] = CustomStatusCodes::COUNTRY_SUCCESS;
            $result['message'] = self::SUCCESSFULLY;
            $result['body'] = Genre::get();
            $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
            $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
            return $result;
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
