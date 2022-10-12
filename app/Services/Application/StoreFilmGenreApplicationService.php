<?php

namespace App\Services\Application;

use App\Models\FilmGenre;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\Domain\StoreFilmGenreDomainService;
use App\Services\General\GeneralResponseService;

class StoreFilmGenreApplicationService implements ApplicationServiceInterface
{
    protected $store_film_genre;

    const GENRE_SUCCESS_MESSAGE = 'Inserted Successfully';
    const GENRE_ERROR_MESSAGE = 'Something Went Wrong';


    public function __construct(StoreFilmGenreDomainService $store_film_genre)
    {
        $this->store_film_genre = $store_film_genre;
    }


    public function execute($request): void
    {
        $genre = explode(",", $request['genre_ids']);
        $genre_insert = array();
        foreach ($genre as $i => $genre) {
            $genre_insert[$i]['genre_id'] = $genre;
            $genre_insert[$i]['film_id'] = $request['film_id'];
        }
        $this->store_film_genre->execute($genre_insert);
    }
}
