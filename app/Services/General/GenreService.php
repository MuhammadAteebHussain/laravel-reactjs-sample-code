<?php

namespace App\Services\General;

use App\Contracts\GenreServiceInterface;
use App\Services\Application\AssignGenreApplicationService;
use App\Services\Application\GetAllGenreApplicationService;

class GenreService implements GenreServiceInterface
{

    protected $assign_genre_film_application_service;
    protected $get_all_genre_service;


    public function __construct(
        GeneralResponseService $general_response_service,
        AssignGenreApplicationService $assign_genre_film_application_service,
        GetAllGenreApplicationService $get_all_genre_service
    ) {
        $this->general_response_service = $general_response_service;
        $this->assign_genre_film_application_service = $assign_genre_film_application_service;
        $this->get_all_genre_service = $get_all_genre_service;
    }

    public  function listGenres()
    {
        try {
           return $this->get_all_genre_service->execute();
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }

    public function assignGeneriesToFilm(object $validated_requet)
    {
        try {
            return $this->assign_genre_film_application_service->execute($validated_requet);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
