<?php

namespace App\Services\General;

use App\Contracts\GenreServiceInterface;
use App\Services\Application\AssignGenreApplicationService;
use App\Services\Application\GetAllGenreApplicationService;

class GenreService implements GenreServiceInterface
{

    protected AssignGenreApplicationService $assign_genre_film_application_service;
    protected GetAllGenreApplicationService $get_all_genre_service;

    /**
     * __construct function
     *
     * @param GeneralResponseService $general_response_service
     * @param AssignGenreApplicationService $assign_genre_film_application_service
     * @param GetAllGenreApplicationService $get_all_genre_service
     */
    public function __construct(
        GeneralResponseService $general_response_service,
        AssignGenreApplicationService $assign_genre_film_application_service,
        GetAllGenreApplicationService $get_all_genre_service
    ) {
        $this->general_response_service = $general_response_service;
        $this->assign_genre_film_application_service = $assign_genre_film_application_service;
        $this->get_all_genre_service = $get_all_genre_service;
    }

    /**
     * listGenres function
     *
     * @return array
     */
    public  function listGenres(): array
    {
        return $this->get_all_genre_service->execute();
    }

    /**
     * assignGeneriesToFilm function
     *
     * @param object $validated_requet
     * @return array
     */
    public function assignGeneriesToFilm(object|array $validated_requet): array
    {
        return $this->assign_genre_film_application_service->execute($validated_requet);
    }
}
