<?php

namespace App\Services\Application;

use App\Components\CustomStatusCodes;
use App\Abstracts\AbstractFilms;
use App\Contracts\Repository\FilmRepositoryInterface;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\General\GeneralResponseService;

class GetSlugFilmsApplicationService implements ApplicationServiceInterface
{
    const FILM_FAILED = 'Invalid User Name or Password';
    const FILM_FETCH_SUCCESSFULLY = 'Fetch Successfully';


    protected FilmRepositoryInterface $repository;

    public function __construct(FilmRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute($request)
    {
        $slug = $request;
        $film = $this->repository->getBySlug($slug);
        $data = $this->singlefilmResponseGenerator($film);
        $result['code'] = CustomStatusCodes::FILM_SUCCESS;
        $result['message'] = self::FILM_FETCH_SUCCESSFULLY;
        $result['body'] = $data;
        $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
        $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
        return $result;
    }


    public function singlefilmResponseGenerator(object $film)
    {
        $data = array();
        $comment_data = array();
        $data['film_id'] = $film->id;
        $data['film_name'] = $film->name;
        $data['film_slug'] = $film->film_slug;
        $data['description'] = $film->description;
        $data['rating'] = ceil($film->FilmRatings->avg('rating'));
        $data['ticket_price'] = $film->ticket_price;
        $data['country'] = $film->Countries->country;
        $data['film_genre'] = (object) $film->Genre;

        if ($film->Comments) {
            foreach ($film->Comments as $i => $comment) {
                $comment_data[$i]['comment'] = $comment->comment;
                $comment_data[$i]['user_name'] = $comment->User->name;
                $comment_data[$i]['user_id'] = $comment->User->id;
            }
        }

        $data['comments'] = $comment_data;
        $data['photo'] = $this->getPhotoLink($film);
        return $data;
    }
}
