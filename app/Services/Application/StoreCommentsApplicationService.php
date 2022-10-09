<?php

namespace App\Services\Application;

use App\Contracts\AbstractGenres;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\Domain\StoreCommentsDomainService;
use App\Components\CustomStatusCodes;
use App\Services\General\GeneralResponseService;

class StoreCommentsApplicationService  implements ApplicationServiceInterface
{
    protected $store_comments_service;

    const COMMENTS_SUCCESS_MESSAGE = 'Comments Added Successfully';
    const COMMENTS_ERROR_MESSAGE = 'Something Went Wrong';


    public function __construct(StoreCommentsDomainService $store_comments_service)
    {
        $this->store_comments_service = $store_comments_service;
    }


    public function execute($request) : array
    {
        try {
            $data = array(
                'user_id' => $request['user_id'],
                'film_id' => $request['film_id'],
                'comment' => $request['comment'],
            );
            $content = $this->store_comments_service->execute($data);
            if ($content !== false) {
                $result['code'] = CustomStatusCodes::SUCCESS;
                $result['message'] = self::COMMENTS_SUCCESS_MESSAGE;
                $result['body'] = $content;
                $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
                $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
            } else {
                $result['code'] = CustomStatusCodes::FAILURE;
                $result['message'] = self::COMMENTS_ERROR_MESSAGE;
                $result['body'] = [];
                $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
                $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_FALSE;
            }
            return $result;
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
