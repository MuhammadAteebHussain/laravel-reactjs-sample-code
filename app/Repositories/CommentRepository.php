<?php

namespace App\Repositories;

use App\Contracts\Repository\CommentRepositoryInterface;
use App\Models\Comment;


class CommentRepository implements CommentRepositoryInterface
{

    protected Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getCommentsByFilmId(int $id): object
    {
        return $this->comment::whereFilmId($id)->get();
    }

    public function storeComment(array $data)
    {
        return $this->comment::Create($data);
    }
}
