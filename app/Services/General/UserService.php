<?php

namespace App\Services\General;

use App\Contracts\UserInterface;
use App\Services\Application\UserLoginApplicationService;
use App\Services\Application\UserRegisterApplicationService;
use App\Services\General\GeneralResponseService;


class UserService implements UserInterface
{
    protected UserRegisterApplicationService $user_register_application_service;
    protected UserLoginApplicationService $user_login_application_service;
    protected GeneralResponseService $general_response_service;

    /**
     * __construct function
     *
     * @param UserRegisterApplicationService $user_register_application_service
     * @param UserLoginApplicationService $user_login_application_service
     * @param GeneralResponseService $general_response_service
     */
    public function __construct(UserRegisterApplicationService $user_register_application_service, UserLoginApplicationService $user_login_application_service, GeneralResponseService $general_response_service)
    {
        $this->user_register_application_service = $user_register_application_service;
        $this->user_login_application_service = $user_login_application_service;
        $this->general_response_service = $general_response_service;
    }


    /**
     * login function
     *
     * @param array $validated_request
     * @return array
     */
    public function login(array $validated_request): array
    {
        try {
            return $this->user_login_application_service->execute($validated_request);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }

    /**
     * register function
     *
     * @param array $validated_request
     * @return array
     */
    public function register(array $validated_request): array
    {
        try {
            return $this->user_register_application_service->execute($validated_request);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
