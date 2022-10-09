<?php

namespace App\Contracts\Repository;


interface FilmGenreRepositoryInterface
{
    public function assignGenreToFilm(array $data);
    public function insertGenre(array $data);
}
