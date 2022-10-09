<?php

namespace App\Services\Domain;

use App\Contracts\Repository\CommentRepositoryInterface;
use App\Services\Domain\Contracts\DomainServiceInterface;

class StoreCommentsDomainService implements DomainServiceInterface
{

    protected CommentRepositoryInterface $repository;

    /**
     * __construct function
     *
     * @param CommentRepositoryInterface $repository
     */
    public function __construct(CommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * execute function
     *
     * @param object|array $request
     * @return array|boolean
     */
    public function execute(object|array $request) : object|bool
    {
        $data = $this->repository->storeComment($request);
        return $data ? $data :  false;

    }
}
