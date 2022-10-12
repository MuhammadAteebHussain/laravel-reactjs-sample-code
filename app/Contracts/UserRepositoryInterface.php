<?php

namespace App\Contracts;


interface UserRepositoryInterface
{

    public function registerUser(array $user);
    public function loginUser(array $request);

}
