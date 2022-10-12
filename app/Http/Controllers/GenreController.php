<?php

namespace App\Http\Controllers;

use App\Contracts\GenreServiceInterface;
use App\Exceptions\GeneralException;
use App\Http\Requests\StoreGenreRequest;
use App\Services\General\GeneralResponseService;
use Exception;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    public $service;

    /**
     * __construct function
     *
     * @param GenreServiceInterface $service
     */
    public function __construct(GenreServiceInterface $service)
    {
        $this->service = $service;
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(): object
    {
        try {
            $response = $this->service->listGenres();
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return GeneralResponseService::createExceptionResponse($ex);
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request): object
    {
        try {
            $validate_request = StoreGenreRequest::ApiValidation($request);
            if ($validate_request->fails()) {
                $response = GeneralResponseService::ValidationResponse($validate_request->errors()->first());
            } else {
                $response = $this->service->assignGeneriesToFilm($request);
            }
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return  GeneralResponseService::createExceptionResponse($ex);
        }
    }
}
