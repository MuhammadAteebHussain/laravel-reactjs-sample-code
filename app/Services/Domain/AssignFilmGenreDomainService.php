<?php

namespace App\Services\Domain;

use App\Contracts\AbstractGenres;
use App\Services\Domain\Contracts\DomainServiceInterface;

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
