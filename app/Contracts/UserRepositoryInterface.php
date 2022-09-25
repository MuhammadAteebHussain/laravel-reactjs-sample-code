<?php

namespace App\Contracts;


interface UserRepositoryInterface
{

    public function login(array $request);
    public function register(array $request);

}
