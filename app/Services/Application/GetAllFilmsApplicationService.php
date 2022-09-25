<?php

namespace App\Services\Application;

use App\Components\CustomStatusCodes;
use App\Contracts\AbstractFilms;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\General\GeneralResponseService;

class GetAllFilmsApplicationService extends AbstractFilms implements ApplicationServiceInterface
{

    const FILM_FAILED = 'Invalid User Name or Password';
    const FILM_FETCH_SUCCESSFULLY = 'Login Successfully';


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

            $result['code'] = CustomStatusCodes::FILM_SUCCESS;
            $result['message'] = self::FILM_FETCH_SUCCESSFULLY;
            $result['body'] = $data;
            $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
            $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
            return $result;
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
