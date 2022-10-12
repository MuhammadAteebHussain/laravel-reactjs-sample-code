<?php

namespace App\Contracts;


interface GenreServiceInterface
{
    public function listGenres();
    public function assignGeneriesToFilm(object $requet);
    
}
