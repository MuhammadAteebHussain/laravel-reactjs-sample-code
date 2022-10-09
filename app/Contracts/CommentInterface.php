<?php

namespace App\Contracts;


interface CommentInterface
{

    public function addCommentsToFilm(object $object);
    public function getCommentsByFilmId(object $object);
}
