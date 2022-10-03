<?php

namespace App\Http\Controllers;

use App\Components\CustomStatusCodes;
use App\Http\Requests\GetCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Services\General\GeneralResponseService;
use Illuminate\Http\Request;
use App\Repositories\FilmRepository;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public $repository;





    public function __construct(FilmRepository $film)
    {
        $this->repository = $film;
    }


    public function store(Request $request)
    {
        try {
            $validate_request = StoreCommentRequest::ApiValidation($request);
            if ($validate_request->fails()) {
                    $response['code'] = CustomStatusCodes::GENERAL_VALIDATION_CODE;
                    $response['message'] = $validate_request->errors()->first();
                    $response['body'] = [];
                    $response['http_code'] = CustomStatusCodes::HTTP_BAD_REQUEST;
                    $response['status'] = CustomStatusCodes::RESPONSE_SUCCESS_FALSE;
            } else {
                $response = $this->repository->addCommentsToFilm($request);
            }
                return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {

            return  GeneralResponseService::responseGenerator([], CustomStatusCodes::GENERAL_VALIDATION_CODE,$ex->getFile().'-' .$ex->getMessage().'-'.$ex->getLine(),  CustomStatusCodes::HTTP_BAD_REQUEST,CustomStatusCodes::RESPONSE_SUCCESS_FALSE);
        }
    }


    public function getCommentsByFilmId(Request $request)
    {
        try {
            $response = $this->repository->getCommentsByFilmId($request);

                return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {

            return  GeneralResponseService::responseGenerator([], CustomStatusCodes::GENERAL_VALIDATION_CODE,$ex->getFile().'-' .$ex->getMessage().'-'.$ex->getLine(),  CustomStatusCodes::HTTP_BAD_REQUEST,CustomStatusCodes::RESPONSE_SUCCESS_FALSE);
        }
    }

}
