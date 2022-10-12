<?php

namespace App\Services\General;

use App\Contracts\FilmInterface;
use App\Services\Application\GetAllFilmsApplicationService;
use App\Services\Application\GetSlugFilmsApplicationService;
use App\Services\Application\AssignGenreApplicationService;
use App\Services\Application\GetCommentsByFilmIdApplicationService;
use App\Services\Application\StoreCommentsApplicationService;
use App\Services\Application\StoreFilmApplicationService;
use App\Services\General\CountryService;
use App\Services\General\GeneralResponseService;


class FilmService implements FilmInterface
{
    protected GetAllFilmsApplicationService $all_films_application_service;
    protected StoreFilmApplicationService $store_film_service;
    protected GetSlugFilmsApplicationService $slug_film_application_service;
    protected AssignGenreApplicationService $assign_genre_film_application_service;
    protected GeneralResponseService $general_response_service;
    protected StoreCommentsApplicationService $store_comment_service;
    protected GetCommentsByFilmIdApplicationService $get_comment_service;
    protected CountryService $countries;


    /**
     * __construct function
     *
     * @param GetAllFilmsApplicationService $all_films_application_service
     * @param GetSlugFilmsApplicationService $slug_film_application_service
     * @param GeneralResponseService $general_response_service
     * @param StoreFilmApplicationService $store_film_service
     * @param AssignGenreApplicationService $assign_genre_film_application_service
     * @param StoreCommentsApplicationService $store_comment_service
     * @param GetCommentsByFilmIdApplicationService $get_comment_service
     * @param CountryService $countries
     */
    public function __construct(
        GetAllFilmsApplicationService $all_films_application_service,
        GetSlugFilmsApplicationService $slug_film_application_service,
        GeneralResponseService $general_response_service,
        StoreFilmApplicationService $store_film_service,
        AssignGenreApplicationService $assign_genre_film_application_service,
        StoreCommentsApplicationService $store_comment_service,
        GetCommentsByFilmIdApplicationService $get_comment_service,
        CountryService $countries

    ) {
        $this->all_films_application_service = $all_films_application_service;
        $this->slug_film_application_service = $slug_film_application_service;
        $this->general_response_service = $general_response_service;
        $this->store_film_service = $store_film_service;
        $this->assign_genre_film_application_service = $assign_genre_film_application_service;
        $this->store_comment_service = $store_comment_service;
        $this->get_comment_service = $get_comment_service;
        $this->countries = $countries;
    }


    /**
     * getAllFilms function
     *
     * @return array
     */
    public function getAllFilms(): array
    {
        try {
            return  $this->all_films_application_service->execute();
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }

    /**
     * getFilmsBySlugName function
     *
     * @param string $slug
     * @return array
     */
    public function getFilmsBySlugName(string $slug): array
    {

        try {
            return  $this->slug_film_application_service->execute($slug);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * storeFilm function
     *
     * @param object $validated_requet
     * @return array
     */
    public function storeFilm(object $validated_requet): array
    {
        try {
            return $this->store_film_service->execute($validated_requet);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }

    /**
     * assignGeneriesToFilm function
     *
     * @param object $validated_requet
     * @return array
     */
    public function assignGeneriesToFilm(object $validated_requet): array
    {
        try {
            return $this->assign_genre_film_application_service->execute($validated_requet);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }

    /**
     * addCommentsToFilm function
     *
     * @param object|array $validated_requet
     * @return array|object
     */
    public function addCommentsToFilm(object|array $validated_requet): array|object
    {
        try {
            return $this->store_comment_service->execute($validated_requet);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }

    /**
     * getCommentsByFilmId function
     *
     * @param object $validated_requet
     * @return array
     */
    public function getCommentsByFilmId(object $validated_requet): array
    {
        try {
            return $this->get_comment_service->execute($validated_requet);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }

    /**
     * getFilmCountries function
     *
     * @return array
     */
    public function getFilmCountries(): array
    {
        try {
            return $this->countries->listCountries();
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
