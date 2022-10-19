<?php

namespace App\Http\Controllers;

use App\Components\CustomStatusCodes;
use App\Contracts\CommentInterface;
use App\Contracts\GeneralResponseServiceInterface;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    protected CommentInterface $service;
    protected GeneralResponseServiceInterface $response;

    /**
     * __construct function
     *
     * @param CommentInterface $service
     * @package CommentService
     */
    public function __construct(CommentInterface $service, GeneralResponseServiceInterface $response)
    {
        $this->service = $service;
        $this->response = $response;
    }
    
    /**
     * store function
     *
     * @param StoreCommentRequest $request
     * @return object
     */
    public function store(StoreCommentRequest $request): object
    {
        try {
            $validate_request = $request->apiValidation();
            if ($validate_request->fails()) {
                $response = $this->response->validationResponse($validate_request->errors()->first());
            } else {
                $response = $this->service->addCommentsToFilm($validate_request->validated());
            }
            return $this->response->responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {

            return  $this->response->responseGenerator([], CustomStatusCodes::GENERAL_VALIDATION_CODE, $ex->getFile() . '-' . $ex->getMessage() . '-' . $ex->getLine(),  CustomStatusCodes::HTTP_BAD_REQUEST, CustomStatusCodes::RESPONSE_SUCCESS_FALSE);
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
            return $this->response->responseGenerator($response['body'], $response['code'], $response['message'], $response['http_code'], $response['status']);
        } catch (\Exception $ex) {

            return  $this->response->responseGenerator([], CustomStatusCodes::GENERAL_VALIDATION_CODE, $ex->getFile() . '-' . $ex->getMessage() . '-' . $ex->getLine(),  CustomStatusCodes::HTTP_BAD_REQUEST, CustomStatusCodes::RESPONSE_SUCCESS_FALSE);
        }
    }
}
