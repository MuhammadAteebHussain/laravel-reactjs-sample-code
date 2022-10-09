<?php

namespace App\Services\Application;

use App\Components\CustomStatusCodes;
use App\Abstracts\AbstractUsers;
use App\Contracts\UserRepositoryInterface;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\General\GeneralResponseService;
use Exception;

class UserLoginApplicationService extends AbstractUsers implements ApplicationServiceInterface
{

    const USER_LOGIN_FAILED_MESSAGE = 'Invalid User Name or Password';
    const USER_LOGIN_SUCCESSFULLY = 'Login Successfully';

    protected UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function execute($request = null)
    {
        try {
            $data['email'] = $request['email'];
            $data['password'] = $request['password'];
            $result = [];
            $user = $this->repository->loginUser($data);
            if ($user) {
                $token = $this->userTokenGenerator($user);
                $result['code'] = CustomStatusCodes::LOGIN_SUCCESS;
                $result['message'] = self::USER_LOGIN_SUCCESSFULLY;
                $result['body'] = $token;
                $result['body']['id'] = $user->id;
                $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
                $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
            } else {
                $result['code'] = CustomStatusCodes::LOGIN_FAILED;
                $result['message'] = self::USER_LOGIN_FAILED_MESSAGE;
                $result['body'] = [];
                $result['http_code'] = CustomStatusCodes::HTTP_FAILED_LOGIN_CODE;
                $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_FALSE;
            }
            return $result;
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
