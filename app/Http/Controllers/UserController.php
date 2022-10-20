<?php

namespace App\Http\Controllers;

use App\Components\CustomStatusCodes;
use App\Contracts\GeneralResponseServiceInterface;
use App\Contracts\UserInterface;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected UserInterface $user;
    protected GeneralResponseServiceInterface $response;


    /**
     * __construct function
     *
     * @param UserInterface $user
     * @param GeneralResponseServiceInterface $response
     */
    public function __construct(UserInterface $user, GeneralResponseServiceInterface $response)
    {
        $this->user = $user;
        $this->response = $response;
    }

    /**
     * store function
     *
     * @param StoreUserRequest $request
     * @return object
     */
    public function store(StoreUserRequest $request): object
    {
        try {

            $validate_request = $request->apiValidation();
            if ($validate_request->fails()) {
                $response = $this->response->validationResponse($validate_request->errors()->first());
            } else {

                $response = $this->user->register($validate_request->validated());
            }
            return $this->response->responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return $this->response->generateResponse([], CustomStatusCodes::getValidationCode(), $ex->getMessage(), CustomStatusCodes::getBadRequest());
        }
    }


    /**
     * login function
     *
     * @param LoginUserRequest $request
     * @return object
     */
    public function login(LoginUserRequest $request): object
    {
        try {
            $validate_request = $request->apiValidation();
            if ($validate_request->fails()) {
                $response = $this->response->validationResponse($validate_request->errors()->first());
            } else {
                $response = $this->user->login($validate_request->validated());
            }
            return $this->response->responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return $this->response->generateResponse([], CustomStatusCodes::getValidationCode(), $ex->getMessage(), CustomStatusCodes::getBadRequest());
        }
    }
}
