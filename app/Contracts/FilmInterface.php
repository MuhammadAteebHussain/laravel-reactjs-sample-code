<?php

namespace App\Contracts;


interface FilmInterface
{

    public function getAllFilms();
    public function getFilmsBySlugName(string $slug);
    public function storeFilm(object $object);
    public function assignGeneriesToFilm(object $object);
    public function addCommentsToFilm(object|array $object);
    public function getFilmCountries();
    
}
