<?php

namespace App\Abstracts;


abstract class AbstractUsers
{

    public function userTokenGenerator(object  $data)
    {
        $result['token'] = $data->createToken('film')->accessToken;
        $result['name'] = $data->name;
        return $result;
    }
}