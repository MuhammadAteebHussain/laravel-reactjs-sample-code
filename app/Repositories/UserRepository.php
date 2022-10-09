<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    protected User $user;
    protected Auth $auth;

    public function __construct(User $user,Auth $auth) {
        $this->user = $user;
        $this->auth = $auth;
        
    }
    
    public function registerUser(array $user)
    {
        return $this->user::Create($user);
    }

    public function loginUser(array $user)
    {
        $this->auth::attempt($user);
        return $this->auth::user();
    }

    public function userTokenGenerator(object  $data)
    {
        $result['token'] = $data->createToken('film')->accessToken;
        $result['name'] = $data->name;
        return $result;
    }

}
