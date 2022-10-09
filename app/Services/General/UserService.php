<?php

namespace App\Services\General;

use App\Contracts\UserInterface;
use App\Services\Application\UserLoginApplicationService;
use App\Services\Application\UserRegisterApplicationService;
use App\Services\General\GeneralResponseService;


class UserService implements UserInterface
{
    protected $user_register_application_service;
    protected $user_login_application_service;
    protected $general_response_service;


    public function __construct(UserRegisterApplicationService $user_register_application_service, UserLoginApplicationService $user_login_application_service, GeneralResponseService $general_response_service)
    {
        $this->user_register_application_service = $user_register_application_service;
        $this->user_login_application_service = $user_login_application_service;
        $this->general_response_service = $general_response_service;
    }



    public function login(array $validated_request)
    {
        try {
            return $this->user_login_application_service->execute($validated_request);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }


    public function register(array $validated_request)
    {
        try {
            return $this->user_register_application_service->execute($validated_request);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
