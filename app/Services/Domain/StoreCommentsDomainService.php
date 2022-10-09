<?php

namespace App\Services\Domain;

use App\Contracts\Repository\CommentRepositoryInterface;
use App\Services\Domain\Contracts\DomainServiceInterface;

class StoreCommentsDomainService implements DomainServiceInterface
{

    protected CommentRepositoryInterface $repository;

    public function __construct(CommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute($request)
    {
        $data = $this->repository->storeComment($request);
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
}
