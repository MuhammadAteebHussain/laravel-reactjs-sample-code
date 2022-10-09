<?php

namespace App\Services\Application;

use App\Abstracts\AbstractComments;
use App\Components\CustomStatusCodes;
use App\Abstracts\AbstractFilms;
use App\Contracts\Repository\CommentRepositoryInterface;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\General\GeneralResponseService;

class GetCommentsByFilmIdApplicationService implements ApplicationServiceInterface
{

    const COMMENT_FAILED = 'Invalid User Name or Password';
    const COMMENT_FETCH_SUCCESSFULLY = 'Comments Fetched';

    protected CommentRepositoryInterface $repository;

    public function __construct(CommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function execute($request = null)
    {
        try {
            $id = 1;
            $comment = $this->repository->getCommentsByFilmId($id);
            $data = [];
            foreach ($comment as $i => $film) {
                $data[$i]['id'] = $film->id;
                $data[$i]['comment'] = $film->comment;
                $data[$i]['user_name'] = $film->User->name;
                $data[$i]['user_id'] = $film->User->id;
            }
            $result['code'] = CustomStatusCodes::COMMENT_SUCCESS;
            $result['message'] = self::COMMENT_FETCH_SUCCESSFULLY;
            $result['body'] = $data;
            $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
            $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
            return $result;
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
