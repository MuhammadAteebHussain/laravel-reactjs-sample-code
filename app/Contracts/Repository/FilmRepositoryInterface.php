<?php

namespace App\Contracts\Repository;


interface FilmRepositoryInterface
{

    public function getAll();
    public function getBySlug(string $slug);
    public function getCommentsByFilmId(int $id);
    public function getAllById(int $id);
    public function storeFilms(array $data);

}
