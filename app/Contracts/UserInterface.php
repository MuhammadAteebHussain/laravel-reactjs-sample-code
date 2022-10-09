<?php

namespace App\Contracts;


interface UserInterface
{

    public function login(array $request);
    public function register(array $request);

}
