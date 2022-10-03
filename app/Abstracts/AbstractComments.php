<?php

namespace App\Abstracts;

use App\Models\Comment;

abstract class AbstractComments
{

    public function getCommentsByFilmId(int $id)
    {
        $data = Comment::whereFilmId($id)->get();
        return $data;
    }

}
