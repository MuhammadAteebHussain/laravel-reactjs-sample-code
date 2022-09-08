<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

abstract class AbstractUsers
{


    public function registerUser(array $user)
    {
        $data = User::Create($user);
        return $data;
    }

    public function loginUser(array $user)
    {
        Auth::attempt($user);
        return $data=Auth::user();
    }

    public function userTokenGenerator(object  $data)
    {
        $result['token'] = $data->createToken('film')->accessToken;
        $result['name'] = $data->name;
        return $result;
    }
}
