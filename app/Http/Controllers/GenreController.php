<?php

namespace App\Http\Controllers;

use App\Contracts\GenreServiceInterface;
use App\Http\Requests\StoreGenreRequest;
use App\Services\General\GeneralResponseService;
use Illuminate\Http\Request;
use App\Repositories\FilmRepository;

class GenreController extends Controller
{

    public $repository;
    public $service;


    public function __construct(FilmRepository $film, GenreServiceInterface $service)
    {
        $this->repository = $film;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() 
    {
        try {
            $response = $this->service->listGenres();
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return  GeneralResponseService::createExceptionResponse($ex);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        try {
            $validate_request = StoreGenreRequest::ApiValidation($request);
            if ($validate_request->fails()) {
                $response = GeneralResponseService::ValidationResponse($validate_request->errors()->first());
            } else {
                $response = $this->repository->assignGeneriesToFilm($request);
            }
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return  GeneralResponseService::createExceptionResponse($ex);
        }
    }


}
