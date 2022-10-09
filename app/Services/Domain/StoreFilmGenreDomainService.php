<?php

namespace App\Services\Domain;

use App\Contracts\Repository\FilmGenreRepositoryInterface;
use App\Services\Domain\Contracts\DomainServiceInterface;

class StoreFilmGenreDomainService implements DomainServiceInterface
{

    protected FilmGenreRepositoryInterface $repository;

    public function __construct(FilmGenreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute($request)
    {
        $this->repository->insertGenre($request);
    }
}
