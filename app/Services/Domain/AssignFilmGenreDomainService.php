<?php

namespace App\Http\Services\Domain;

use App\Contracts\AbstractGenres;
use App\Http\Services\Domain\Contracts\DomainServiceInterface;

class AssignFilmGenreDomainService extends AbstractGenres implements DomainServiceInterface
{



    public function execute($request)
    {


        $data = $this->assignGenreToFilm($request);

        if ($data == true) {
            return $data;
        } else {
            return false;
        }
    }
}
