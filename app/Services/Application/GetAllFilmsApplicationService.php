<?php

namespace App\Services\Application;

use App\Components\CustomStatusCodes;
use App\Contracts\Repository\FilmRepositoryInterface;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class GetAllFilmsApplicationService implements ApplicationServiceInterface
{

    const FILM_FAILED = 'Invalid User Name or Password';
    const FILM_FETCH_SUCCESSFULLY = 'Login Successfully';

    protected FilmRepositoryInterface $repository;

    public function __construct(FilmRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute($request = null): array
    {
        $films = $this->repository->getAll();
        $data = [];
        foreach ($films as $i => $film) {
            $data[$i]['film_name'] = $film->name;
            $data[$i]['film_slug'] = $film->film_slug;
            $data[$i]['description'] = $film->description;
            $data[$i]['rating'] = $film->FilmRatings->avg('rating');
            $data[$i]['ticket_price'] = $film->ticket_price;
            $data[$i]['country'] = $film->Countries->country;
            $data[$i]['film_genre'] = (object) $film->FilmGenre;
            $data[$i]['photo'] = $this->getPhotoLink($film);
            $data[$i]['comments'] = (object) $film->Comments;
        }

        $result['code'] = CustomStatusCodes::FILM_SUCCESS;
        $result['message'] = self::FILM_FETCH_SUCCESSFULLY;
        $result['body'] = $data;
        $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
        $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
        return $result;
    }

    public function getPhotoLink($film)
    {
        if (Str::contains($film->photo, 'http')) {
            $link = $film->photo;
        } else {
            $link = App::make('url')->to('/') . env('DESTINATION_PATH_FOR_IMAGES') . $film->photo;
        }
        return $link;
    }
}
