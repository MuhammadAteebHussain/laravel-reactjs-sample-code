<?php

namespace App\Http\Controllers;

use App\Contracts\FilmRepositoryInterface;
use App\Http\Requests\StoreFilmRequest;
use App\Services\General\GeneralResponseService;
use Illuminate\Http\Request;

class FilmController extends Controller
{

    public $repository;





    public function __construct(FilmRepositoryInterface $film)
    {
        $this->repository = $film;
    }


    /**
     * Display a all listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllFilms()
    {
        try {
            $response = $this->repository->getAllFilms();
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return  GeneralResponseService::createExceptionResponse($ex);
        }
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
            $validate_request = StoreFilmRequest::ApiValidation($request);
            if ($validate_request->fails()) {
                $response = GeneralResponseService::ValidationResponse($validate_request->errors()->first());
            } else {
                $response = $this->repository->storeFilm($request);
            }
            return $response = GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return  GeneralResponseService::createExceptionResponse($ex);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function showBySlug($slug)
    {
        try {
            $response = $this->repository->getFilmsBySlugName($slug);
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return  GeneralResponseService::createExceptionResponse($ex);
        }
    }

        /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function getFilmCountries()
    {
        try {
            $response = $this->repository->getFilmCountries();
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return  GeneralResponseService::createExceptionResponse($ex);
        }
    }

}
