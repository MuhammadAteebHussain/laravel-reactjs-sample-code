<?php

namespace App\Repositories;

use App\Contracts\Repository\CommentRepositoryInterface;
use App\Models\Comment;


class CommentRepository implements CommentRepositoryInterface
{

    protected Comment $comment;

    /**
     * __construct function
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * getCommentsByFilmId function
     *
     * @param integer $id
     * @return object
     */
    public function getCommentsByFilmId(int $id): object
    {
        return $this->comment::whereFilmId($id)->get();
    }

    /**
     * storeComment function
     *
     * @param array $data
     * @return object
     */
    public function storeComment(array $data): object
    {
        return $this->comment::Create($data);
    }
}
