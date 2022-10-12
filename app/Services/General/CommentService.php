<?php

namespace App\Services\General;

use App\Contracts\CommentInterface;
use App\Services\Application\GetCommentsByFilmIdApplicationService;
use App\Services\Application\StoreCommentsApplicationService;
use App\Services\General\GeneralResponseService;

/**
 * CommentService class
 * @package  App\Contracts\CommentInterface
 */
class CommentService implements CommentInterface
{

    protected $store_comment_service;
    protected  $get_comment_service;


    /**
     * CommentService __construct
     *
     * @param StoreCommentsApplicationService $store_comment_service
     * @param GetCommentsByFilmIdApplicationService $get_comment_service
     */
    public function __construct(
        StoreCommentsApplicationService $store_comment_service,
        GetCommentsByFilmIdApplicationService $get_comment_service

    ) {
        $this->store_comment_service = $store_comment_service;
        $this->get_comment_service = $get_comment_service;
    }

    /**
     * addCommentsToFilm function
     *
     * @param object $validated_requet
     * @return array
     */
    public function addCommentsToFilm(object $validated_requet): array
    {
        try {
            return $this->store_comment_service->execute($validated_requet);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }

    /**
     * getCommentsByFilmId function
     *
     * @param object $validated_requet
     * @return array
     */
    public function getCommentsByFilmId(object $validated_requet): array
    {
        try {
            return $this->get_comment_service->execute($validated_requet);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }

}
