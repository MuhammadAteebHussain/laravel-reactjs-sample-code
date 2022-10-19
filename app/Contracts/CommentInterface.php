<?php

namespace App\Contracts;


interface CommentInterface
{

    public function addCommentsToFilm(object|array $object);
    public function getCommentsByFilmId(object|array $object);
}
