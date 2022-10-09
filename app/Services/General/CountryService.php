<?php

namespace App\Services\General;

use App\Components\CustomStatusCodes;
use App\Models\Country;

class CountryService
{

    const SUCCESSFULLY ="country fetched";



    public static function listCountries()
    {

        $result['code'] = CustomStatusCodes::COUNTRY_SUCCESS;
        $result['message'] = self::SUCCESSFULLY;
        $result['body'] = Country::get();
        $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
        $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
        return $result;

    }



}
