<?php

namespace App\Repositories;

use App\Contracts\Repository\FilmGenreRepositoryInterface;
use App\Models\Comment;
use App\Models\FilmGenre;

class FilmGenreRepository implements FilmGenreRepositoryInterface
{

    protected FilmGenre $film_genre;

    public function __construct(FilmGenre $film_genre)
    {
        $this->film_genre = $film_genre;
    }

    public function assignGenreToFilm(array $data)
    {
        return $this->film_genre::Create($data);
    }

    public function insertGenre(array $data)
    {
        return $this->film_genre::insert($data);
    }


}
