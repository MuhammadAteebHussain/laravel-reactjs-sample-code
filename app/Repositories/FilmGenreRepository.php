<?php

namespace App\Repositories;

use App\Contracts\Repository\FilmGenreRepositoryInterface;
use App\Models\Comment;
use App\Models\FilmGenre;

class FilmGenreRepository implements FilmGenreRepositoryInterface
{

    protected FilmGenre $film_genre;

    /**
     * __construct function
     *
     * @param FilmGenre $film_genre
     */
    public function __construct(FilmGenre $film_genre)
    {
        $this->film_genre = $film_genre;
    }

    /**
     * assignGenreToFilm function
     *
     * @param array $data
     * @return object|boolean
     */
    public function assignGenreToFilm(array $data): object|bool
    {
        return $this->film_genre::Create($data);
    }


    /**
     * insertGenre function
     *
     * @param array $data
     * @return object|boolean
     */
    public function insertGenre(array $data): object|bool
    {
        return $this->film_genre::insert($data);
    }
}
