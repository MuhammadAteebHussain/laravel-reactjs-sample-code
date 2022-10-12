<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    protected User $user;
    protected Auth $auth;

    /**
     * __construct function
     *
     * @param User $user
     * @param Auth $auth
     * @package UserRepositoryInterface
     */
    public function __construct(User $user, Auth $auth)
    {
        $this->user = $user;
        $this->auth = $auth;
    }

    /**
     * registerUser function
     *
     * @param array $user
     * @return object
     */
    public function registerUser(array $user): object
    {
        return $this->user::Create($user);
    }

    /**
     * loginUser function
     *
     * @param array $user
     * @return object
     */
    public function loginUser(array $user): object|null
    {
        $this->auth::attempt($user);
        return $this->auth::user();
    }


    /**
     * userTokenGenerator function
     *
     * @param object $data
     * @return array
     */
    public function userTokenGenerator(object  $data): array
    {
        $result['token'] = $data->createToken('film')->accessToken;
        $result['name'] = $data->name;
        return $result;
    }
}
