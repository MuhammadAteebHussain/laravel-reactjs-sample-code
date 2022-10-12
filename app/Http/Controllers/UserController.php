<?php

namespace App\Http\Controllers;

use App\Components\CustomStatusCodes;
use App\Contracts\UserInterface;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\General\GeneralResponseService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public $user;


    /**
     * __construct function
     *
     * @param UserInterface $user
     * @package User
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * store function
     *
     * @param Request $request
     * @return object
     */
    public function store(Request $request): object
    {
        try {
            $validate_request = StoreUserRequest::ApiValidation($request);
            if ($validate_request->fails()) {
                $response = GeneralResponseService::ValidationResponse($validate_request->errors()->first());
            } else {

                $response = $this->user->register($validate_request->validated());
            }
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return GeneralResponseService::generateResponse([], CustomStatusCodes::getValidationCode(), $ex->getMessage(), CustomStatusCodes::getBadRequest());
        }
    }


    /**
     * login function
     *
     * @param Request $request
     * @return object
     */
    public function login(Request $request): object
    {
        try {
            $validate_request = LoginUserRequest::ApiValidation($request);
            if ($validate_request->fails()) {
                $response = GeneralResponseService::ValidationResponse($validate_request->errors()->first());
            } else {
                $response = $this->user->login($validate_request->validated());
            }
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return GeneralResponseService::generateResponse([], CustomStatusCodes::getValidationCode(), $ex->getMessage(), CustomStatusCodes::getBadRequest());
        }
    }
}
