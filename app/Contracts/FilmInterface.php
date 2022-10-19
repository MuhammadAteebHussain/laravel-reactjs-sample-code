<?php

namespace App\Contracts;


interface FilmInterface
{

    public function getAllFilms();
    public function getFilmsBySlugName(object|array $slug);
    public function storeFilm(object|array $object);
    public function assignGeneriesToFilm(object $object);
    public function addCommentsToFilm(object|array $object);
    public function getFilmCountries();
    
}
