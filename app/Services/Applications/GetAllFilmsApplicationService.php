<?php

namespace App\Http\Services\Application;

use App\Contracts\AbstractFilms;
use App\Http\Services\Application\Contracts\ApplicationServiceInterface;

class GetAllFilmsApplicationService extends AbstractFilms implements ApplicationServiceInterface
{


    public function execute($request = null)
    {

        try {
            $films = $this->getAll();
            $data = [];
            foreach ($films as $i => $film) {
                $data[$i]['film_name'] = $film->name;
                $data[$i]['film_slug'] = $film->film_slug;
                $data[$i]['description'] = $film->description;
                $data[$i]['rating'] = $film->FilmRatings->avg('rating');
                $data[$i]['ticket_price'] = $film->ticket_price;
                $data[$i]['country'] = $film->country;
                $data[$i]['film_genre'] = $film->FilmGenre;
                $data[$i]['photo'] = $film->photo;
            }
            return $data;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
