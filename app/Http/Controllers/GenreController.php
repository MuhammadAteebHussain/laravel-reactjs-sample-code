<?php

namespace App\Http\Controllers;

use App\Contracts\GeneralResponseServiceInterface;
use App\Contracts\GenreServiceInterface;
use App\Exceptions\GeneralException;
use App\Http\Requests\StoreGenreRequest;
use App\Services\General\GeneralResponseService;
use Exception;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    protected GenreServiceInterface $service;
    protected GeneralResponseServiceInterface $response;


    /**
     * __construct function
     *
     * @param GenreServiceInterface $service
     * @param GeneralResponseServiceInterface $response
     */
    public function __construct(GenreServiceInterface $service, GeneralResponseServiceInterface $response)
    {
        $this->service = $service;
        $this->response = $response;
    }




    /**
     * list function
     *
     * @return object
     */
    public function list(): object
    {
        try {
            $response = $this->service->listGenres();
            return $this->response->responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return $this->response->createExceptionResponse($ex);
        }
    }

    /**
     * store function
     *
     * @param StoreGenreRequest $request
     * @return object
     */
    public function store(StoreGenreRequest $request): object
    {
        try {
            $validate_request = $request->apiValidation();
            if ($validate_request->fails()) {
                $response = $this->response->validationResponse($validate_request->errors()->first());
            } else {
                $response = $this->service->assignGeneriesToFilm($validate_request->validated());
            }
            return $this->response->responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return  $this->response->createExceptionResponse($ex);
        }
    }
}
