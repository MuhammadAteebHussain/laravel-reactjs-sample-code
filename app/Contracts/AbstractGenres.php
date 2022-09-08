<?php

namespace App\Contracts;

use App\Models\Genre;
use App\Models\FilmGenre;

abstract class AbstractGenres
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


    public function assignGenreToFilm(array $data)
    {
        $data = FilmGenre::Create($data);
        return $data;
    }
}
