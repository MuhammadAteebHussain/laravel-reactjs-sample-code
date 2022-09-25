<?php

namespace App\Services\Application;

use App\Components\CustomStatusCodes;
use App\Contracts\AbstractUsers;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\General\GeneralResponseService;
use Exception;

class UserLoginApplicationService extends AbstractUsers implements ApplicationServiceInterface
{

    const USER_LOGIN_FAILED_MESSAGE = 'Invalid User Name or Password';
    const USER_LOGIN_SUCCESSFULLY = 'Login Successfully';

    public function execute($request = null)
    {
        try {
            $data['email'] = $request['email'];
            $data['password'] = $request['password'];
            $result = [];
            $user = $this->loginUser($data);
            if ($user) {
                $token = $this->userTokenGenerator($user);
                $result['code'] = CustomStatusCodes::LOGIN_SUCCESS;
                $result['message'] = self::USER_LOGIN_SUCCESSFULLY;
                $result['body'] = $token;
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
