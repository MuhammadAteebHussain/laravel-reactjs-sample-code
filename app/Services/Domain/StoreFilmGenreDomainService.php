<?php

namespace App\Services\Domain;

use App\Models\FilmGenre;
use App\Services\Domain\Contracts\DomainServiceInterface;

class StoreFilmGenreDomainService implements DomainServiceInterface
{

    public function execute($request)
    {   

        FilmGenre::insert($request);

    }
}
