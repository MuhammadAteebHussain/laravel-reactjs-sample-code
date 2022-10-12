<?php

namespace App\Contracts\Repository;


interface CommentRepositoryInterface
{

    public function getCommentsByFilmId(int $id);
    public function storeComment(array $data);

}
