<?php

namespace App\Http\Controllers;

use App\Components\CustomStatusCodes;
use App\Contracts\CommentInterface;
use App\Http\Requests\StoreCommentRequest;
use App\Services\General\GeneralResponseService;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public $service;
    /**
     * __construct function
     *
     * @param CommentInterface $service
     * @package CommentService
     */
    public function __construct(CommentInterface $service)
    {
        $this->service = $service;
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
            $validate_request = StoreCommentRequest::ApiValidation($request);
            if ($validate_request->fails()) {
                $response['code'] = CustomStatusCodes::GENERAL_VALIDATION_CODE;
                $response['message'] = $validate_request->errors()->first();
                $response['body'] = [];
                $response['http_code'] = CustomStatusCodes::HTTP_BAD_REQUEST;
                $response['status'] = CustomStatusCodes::RESPONSE_SUCCESS_FALSE;
            } else {
                $response = $this->service->addCommentsToFilm($request);
            }
            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {

            return  GeneralResponseService::responseGenerator([], CustomStatusCodes::GENERAL_VALIDATION_CODE, $ex->getFile() . '-' . $ex->getMessage() . '-' . $ex->getLine(),  CustomStatusCodes::HTTP_BAD_REQUEST, CustomStatusCodes::RESPONSE_SUCCESS_FALSE);
        }
    }

    /**
     * getCommentsByFilmId function
     *
     * @param Request $request
     * @return object
     */
    public function getCommentsByFilmId(Request $request): object
    {
        try {
            $response = $this->service->getCommentsByFilmId($request);

            return GeneralResponseService::responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {

            return  GeneralResponseService::responseGenerator([], CustomStatusCodes::GENERAL_VALIDATION_CODE, $ex->getFile() . '-' . $ex->getMessage() . '-' . $ex->getLine(),  CustomStatusCodes::HTTP_BAD_REQUEST, CustomStatusCodes::RESPONSE_SUCCESS_FALSE);
        }
    }
}
