<?php

namespace App\Http\Controllers;

use App\Components\CustomStatusCodes;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Services\General\GeneralResponseService;
use Illuminate\Http\Request;
use App\Repositories\FilmRepository;
use Illuminate\Support\Facades\Validator;

class FilmController extends Controller
{

    public $repository;





    public function __construct(FilmRepository $film)
    {
        $this->repository = $film;
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
     * Display a all listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllFilms()
    {
        return $this->repository->getAllFilms();
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
                
                return  GeneralResponseService::responseGenerator([], CustomStatusCodes::GENERAL_VALIDATION_CODE, $validate_request->errors()->first(),  CustomStatusCodes::HTTP_BAD_REQUEST,CustomStatusCodes::RESPONSE_SUCCESS_FALSE);
            } else {
                $response = $this->repository->storeFilm($request);
                $response = GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
            }
            return $response;
        } catch (\Exception $ex) {

            return  GeneralResponseService::responseGenerator([], CustomStatusCodes::GENERAL_VALIDATION_CODE, $ex->getMessage(),  CustomStatusCodes::HTTP_BAD_REQUEST,CustomStatusCodes::RESPONSE_SUCCESS_FALSE);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function showBySlug($slug)
    {
        return $this->repository->getFilmsBySlugName($slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
