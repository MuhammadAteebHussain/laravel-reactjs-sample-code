<?php

namespace App\Services\Domain;

use App\Contracts\Repository\FilmGenreRepositoryInterface;
use App\Contracts\Repository\FilmRepositoryInterface;
use App\Services\Domain\Contracts\DomainServiceInterface;

class AssignFilmGenreDomainService implements DomainServiceInterface
{
    protected FilmGenreRepositoryInterface $repository;

    public function __construct(FilmGenreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function execute($request)
    {
        $data = $this->repository->assignGenreToFilm($request);

        if ($data) {
            return $data;
        } else {
            return false;
        }
    }
}
