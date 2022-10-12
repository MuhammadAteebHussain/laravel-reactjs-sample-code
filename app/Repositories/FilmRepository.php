<?php

namespace App\Repositories;

use App\Contracts\Repository\FilmRepositoryInterface;
use App\Models\Comment;
use App\Models\Film;


class FilmRepository implements FilmRepositoryInterface
{

    protected Film $film;


    /**
     * __construct function
     *
     * @param Film $film
     * @package FilmRepositoryInterface
     */
    public function __construct(Film $film)
    {
        $this->film = $film;
    }

    /**
     * getAll function
     *
     * @return object
     */
    public function getAll(): object
    {
        return $this->film::with(['Genre', 'FilmRatings', 'Comments', 'Countries'])->get();
    }

    /**
     * getBySlug function
     *
     * @param string $slug
     * @return array
     */
    public function getBySlug(string $slug)
    {
        return $this->film::whereFilmSlug($slug)->first();
    }

    /**
     * getCommentsByFilmId function
     *
     * @param integer $id
     * @return void
     */
    public function getCommentsByFilmId(int $id)
    {
        return Comment::whereFilmId($id)->get();
    }

    /**
     * getAllById function
     *
     * @param integer $id
     * @return object
     */
    public function getAllById(int $id): object
    {
        return $this->film::whereId($id)->first();
    }

    /**
     * storeFilms function
     *
     * @param array $data
     * @return object
     */
    public function storeFilms(array $data): object
    {
        return $this->film::Create($data);
    }
}
