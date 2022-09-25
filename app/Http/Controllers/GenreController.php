<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use App\Services\General\GeneralResponseService;
use Illuminate\Http\Request;
use App\Repositories\FilmRepository;

class GenreController extends Controller
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
     * Note:- Due to shortage of time i am not going to create new repository for genre
     * 
     * 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validate_request = StoreGenreRequest::ApiValidation($request);
            if ($validate_request->fails()) {
                $response=GeneralResponseService::ValidationResponse($validate_request->errors()->first());
            } else {
                $response = $this->repository->assignGeneriesToFilm($request);
            }
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {
            return  GeneralResponseService::createExceptionResponse($ex);
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
