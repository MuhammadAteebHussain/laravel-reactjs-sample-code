<?php

namespace App\Http\Controllers;

use App\Contracts\FilmInterface;
use App\Http\Requests\GetFilmRequestBySlug;
use App\Http\Requests\StoreFilmRequest;
use App\Services\General\GeneralResponseService;
use Illuminate\Http\Request;

class FilmController extends Controller
{

    public $service;

    /**
     * FilmController __construct
     *
     * @param FilmInterface $film
     * @package FilmService
     */
    public function __construct(FilmInterface $film)
    {
        $this->service = $film;
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
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
              GeneralResponseService::createExceptionResponse($ex);
        }
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
            $validate_request = StoreFilmRequest::ApiValidation($request);
            if ($validate_request->fails()) {
                $response = GeneralResponseService::ValidationResponse($validate_request->errors()->first());
            } else {
                $response = $this->service->storeFilm($request);
            }
            return $response = GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
              GeneralResponseService::createExceptionResponse($ex);
        }
    }



    /**
     * showBySlug function
     *
     * @param [type] $slug
     * @return object
     */
    public function showBySlug($slug): object
    {
        try {
            $request['film_slug']=$slug;
            $validate_request = GetFilmRequestBySlug::ApiValidation($request);
            if ($validate_request->fails()) {
                $response = GeneralResponseService::ValidationResponse($validate_request->errors()->first());
            } else {
                $response = $this->service->getFilmsBySlugName($slug);
            }
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
              GeneralResponseService::createExceptionResponse($ex);
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
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
              GeneralResponseService::createExceptionResponse($ex);
        }
    }
}
