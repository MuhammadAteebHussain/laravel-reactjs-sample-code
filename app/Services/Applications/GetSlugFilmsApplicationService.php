<?php

namespace App\Http\Services\Application;

use App\Contracts\AbstractFilms;
use App\Http\Services\Application\Contracts\ApplicationServiceInterface;

class GetSlugFilmsApplicationService extends AbstractFilms implements ApplicationServiceInterface
{


    public function execute($request)
    {


        try {
            $slug = $request;
            $film = $this->getBySlug($slug);
            $data = $this->singlefilmResponseGenerator($film);
            return $data;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
