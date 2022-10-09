<?php

namespace App\Repositories;

use App\Contracts\Repository\FilmRepositoryInterface;
use App\Models\Comment;
use App\Models\Film;


class FilmRepository implements FilmRepositoryInterface
{

    protected Film $film;

    public function __construct(Film $film) {
        $this->film = $film;
    }
    

    public function getAll() : object
    {
        return $this->film::with(['Genre', 'FilmRatings', 'Comments', 'Countries'])->get();
    }

    public function getBySlug(string $slug) : array
    {
        return $this->film::whereFilmSlug($slug)->first();
    }

    public function getCommentsByFilmId(int $id) 
    {
        return Comment::whereFilmId($id)->get();
    }

    public function getAllById(int $id) : object
    {
        return $this->film::whereId($id)->first();
    }

    public function storeFilms(array $data) : object
    {
        return $this->film::Create($data);
    }

}
