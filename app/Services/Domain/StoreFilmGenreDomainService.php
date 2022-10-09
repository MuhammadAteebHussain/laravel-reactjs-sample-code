<?php

namespace App\Services\Domain;

use App\Contracts\Repository\FilmGenreRepositoryInterface;
use App\Services\Domain\Contracts\DomainServiceInterface;

class StoreFilmGenreDomainService implements DomainServiceInterface
{

    protected FilmGenreRepositoryInterface $repository;

    /**
     * __construct function
     *
     * @param FilmGenreRepositoryInterface $repository
     */
    public function __construct(FilmGenreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

   
    /**
     * execute function
     *
     * @param object|array $request
     * @return object|boolean
     */
    public function execute(object|array $request) : object|bool
    {
         return $this->repository->insertGenre($request);
    }
}
