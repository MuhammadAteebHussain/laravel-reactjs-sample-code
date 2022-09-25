<?php

namespace App\Contracts;

use App\Models\Comment;

abstract class AbstractComments
{

    public function storeGenre()
    {
    }

    public function getById()
    {
    }


    public function getFilmGenresById()
    {
    }


    public function storeComment(array $data)
    {   
        print_r($data);
        $result = Comment::Create($data);
        return $result;
    }
}
