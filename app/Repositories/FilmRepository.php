<?php

namespace App\Repositories;

use App\Components\CustomStatusCodes;
use App\Contracts\FilmRepositoryInterface;
use App\Models\Film;
use App\Http\Services\Application\GetAllFilmsApplicationService;
use App\Http\Services\Application\GetSlugFilmsApplicationService;
use App\Http\Services\Application\StoreFilmsApplicationService;
use App\Http\Services\Application\AssignGenreApplicationService;
use App\Http\Services\Application\StoreCommentsApplicationService;
use App\Http\Services\General\GeneralResponseService;


class FilmRepository implements FilmRepositoryInterface
{
    protected $all_films_application_service;
    protected $store_film_service;
    protected $slug_film_application_service;
    protected $assign_genre_film_application_service;
    protected $general_response_service;
    protected $store_comment_service;


    public function __construct(
        GetAllFilmsApplicationService $all_films_application_service,
        GetSlugFilmsApplicationService $slug_film_application_service,
        GeneralResponseService $general_response_service,
        StoreFilmsApplicationService $store_film_service,
        AssignGenreApplicationService $assign_genre_film_application_service,
        StoreCommentsApplicationService $store_comment_service
        
    ) {
        $this->all_films_application_service = $all_films_application_service;
        $this->slug_film_application_service = $slug_film_application_service;
        $this->general_response_service = $general_response_service;
        $this->store_film_service = $store_film_service;
        $this->assign_genre_film_application_service = $assign_genre_film_application_service;
        $this->store_comment_service = $store_comment_service;
    }



    public function getAllFilms()
    {
        try {

            $content = $this->all_films_application_service->execute();


            return  $this->general_response_service->generateResponse(
                $content,
                CustomStatusCodes::getSuccessCode(),
                CustomStatusCodes::getGenralSuccessMessage(),
                CustomStatusCodes::getHttpSuccessCode(),

            );
        } catch (\Exception $ex) {

            return  $this->general_response_service->generateResponse(
                "",
                CustomStatusCodes::getFailureCode(),
                $ex->getMessage() . '-' . $ex->getLine(),
                CustomStatusCodes::getHttpInernalServerCode()

            );
        }
    }


    public function getFilmsBySlugName(string $slug)
    {

        try {
            $content = $this->slug_film_application_service->execute($slug);


            return  $this->general_response_service->generateResponse(
                $content,
                CustomStatusCodes::getSuccessCode(),
                CustomStatusCodes::getGenralSuccessMessage(),
                CustomStatusCodes::getHttpSuccessCode(),

            );
        } catch (\Exception $ex) {
            return  $this->general_response_service->generateResponse(
                "",
                CustomStatusCodes::getFailureCode(),
                $ex->getMessage() . '-' . $ex->getLine(),
                CustomStatusCodes::getHttpInernalServerCode()

            );
        }
    }

    public function storeFilm(object $validated_requet)
    {
        return $this->store_film_service->execute($validated_requet);
    }


    public function assignGeneriesToFilm(object $validated_requet)
    {
        return $this->assign_genre_film_application_service->execute($validated_requet);
    }

    public function addCommentsToFilm(object $validated_requet)
    {
        return $this->store_comment_service->execute($validated_requet);
    }
}
