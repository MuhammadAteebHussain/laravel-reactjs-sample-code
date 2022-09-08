<?php

namespace App\Http\Services\Application;

use App\Http\Services\Domain\UserRegisterDomainService;
use App\Http\Services\Application\Contracts\ApplicationServiceInterface;




class UserRegisterApplicationService implements ApplicationServiceInterface
{
    protected $user_register_service;


    public function __construct(UserRegisterDomainService $user_register_service)
    {
        $this->user_register_service = $user_register_service;
    }

    public function execute($request)
    {
        try {
            $data['name'] = $request['name'];
            $data['email'] = $request['email'];
            $data['password'] = bcrypt($request['password']);
            $result = $this->user_register_service->execute($data);
            return $result;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
