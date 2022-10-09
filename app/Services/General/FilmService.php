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
    protected $all_films_application_service;
    protected $store_film_service;
    protected $slug_film_application_service;
    protected $assign_genre_film_application_service;
    protected $general_response_service;
    protected $store_comment_service;
    protected  $get_comment_service;
    protected  $countries;


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



    public function getAllFilms()
    {
        try {
            return  $this->all_films_application_service->execute();
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }


    public function getFilmsBySlugName(string $slug)
    {

        try {
            return  $this->slug_film_application_service->execute($slug);
        } catch (\Exception $ex) {
           throw $ex;
        }
    }

    public function storeFilm(object $validated_requet)
    {
        try {
            return $this->store_film_service->execute($validated_requet);
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

    public function addCommentsToFilm(object $validated_requet)
    {
        try {
            return $this->store_comment_service->execute($validated_requet);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }


    public function getCommentsByFilmId(object $validated_requet)
    {
        try {
            return $this->get_comment_service->execute($validated_requet);
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }

    public function getFilmCountries()
    {
        try {
            return $this->countries->listCountries();
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
