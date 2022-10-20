<?php

namespace App\Http\Controllers;

use App\Contracts\FilmInterface;
use App\Contracts\GeneralResponseServiceInterface;
use App\Http\Requests\GetFilmRequestBySlug;
use App\Http\Requests\StoreFilmRequest;
use Illuminate\Http\Request;

class FilmController extends Controller
{

    public FilmInterface $service;
    public GeneralResponseServiceInterface $response;

    
    /**
     * FilmController function
     *
     * @param FilmInterface $service
     * @param GeneralResponseServiceInterface $response
     */
    public function __construct(FilmInterface $service, GeneralResponseServiceInterface $response)
    {
        $this->service = $service;
        $this->response = $response;
    }

    /**
     * getAllFilms function
     *
     * @return object
     */
    public function getAllFilms(): object
    {
        try {
            $response = $this->service->getAllFilms();
            return $this->response->responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            $this->response->createExceptionResponse($ex);
        }
    }


    /**
     * store function
     *
     * @param Request $request
     * @return object
     */
    public function store(StoreFilmRequest $request): object
    {
        try {
            $validate_request = $request->apiValidation();
            if ($validate_request->fails()) {
                $response = $this->response->validationResponse($validate_request->errors()->first());
            } else {
                $response = $this->service->storeFilm($validate_request->validated());
            }
            return $response = $this->response->responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            $this->response->createExceptionResponse($ex);
        }
    }



    /**
     * showBySlug function
     *
     * @param GetFilmRequestBySlug $request
     * @return object
     */
    public function showBySlug(GetFilmRequestBySlug $request): object
    {
        try {
            $validate_request = $request->apiValidation();
            if ($validate_request->fails()) {
                $response = $this->response->validationResponse($validate_request->errors()->first());
            } else {
                $response = $this->service->getFilmsBySlugName($validate_request->validated());
            }
            return $this->response->responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return $this->response->createExceptionResponse($ex);
        }
    }


    /**
     * getFilmCountries function
     *
     * @return object
     */
    public function getFilmCountries(): object
    {
        try {
            $response = $this->service->getFilmCountries();
            return $this->response->responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            $this->response->createExceptionResponse($ex);
        }
    }
}
