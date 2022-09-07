<?php

namespace App\Http\Controllers;

use App\Components\CustomStatusCodes;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Services\General\GeneralResponseService;
use Illuminate\Http\Request;
use App\Repositories\FilmRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public $user;





    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customLogin(Request $request)
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validate_request = StoreUserRequest::ApiValidation($request);
            if ($validate_request->fails()) {
                $response = GeneralResponseService::generateResponse([], CustomStatusCodes::getValidationCode(), $validate_request->errors()->first(), CustomStatusCodes::getBadRequest());
            } else {

                $response = $this->user->register($validate_request->validated());

                return GeneralResponseService::successResponseCreated($response);
            }
            return $response;
        } catch (\Exception $ex) {
            return GeneralResponseService::generateResponse([], CustomStatusCodes::getValidationCode(), $ex->getMessage(), CustomStatusCodes::getBadRequest());
        }
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $validate_request = LoginUserRequest::ApiValidation($request);
            if ($validate_request->fails()) {
                $response = GeneralResponseService::generateResponse([], CustomStatusCodes::getValidationCode(), $validate_request->errors()->first(), CustomStatusCodes::getBadRequest());
            } else {

                $response = $this->user->login($validate_request->validated());

                return GeneralResponseService::responseGenerator($response['body'],$response['code'],$response['message'],$response['http_code'],$response['status']);
            }
            return $response;
        } catch (\Exception $ex) {
            return GeneralResponseService::generateResponse([], CustomStatusCodes::getValidationCode(), $ex->getMessage(), CustomStatusCodes::getBadRequest());
        }
    }

   
}
