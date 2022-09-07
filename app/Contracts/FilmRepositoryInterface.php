<?php

namespace App\Contracts;


interface FilmRepositoryInterface
{

    public function getAllFilms();
    public function getFilmsBySlugName(string $slug);
    public function storeFilm(object $object);
    public function assignGeneriesToFilm(object $object);
    public function addCommentsToFilm(object $object);
    
    
    

}
