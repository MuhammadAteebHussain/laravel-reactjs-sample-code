<?php

namespace App\Services\Domain;

use App\Contracts\Repository\FilmGenreRepositoryInterface;
use App\Contracts\Repository\FilmRepositoryInterface;
use App\Services\Domain\Contracts\DomainServiceInterface;

class AssignFilmGenreDomainService implements DomainServiceInterface
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
        $data = $this->repository->assignGenreToFilm($request);
        return $data ? $data :  false;
    }
}
