<?php

namespace App\Services\Application;

use App\Components\CustomStatusCodes;
use App\Contracts\AbstractFilms;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\General\GeneralResponseService;

class GetSlugFilmsApplicationService extends AbstractFilms implements ApplicationServiceInterface
{
    const FILM_FAILED = 'Invalid User Name or Password';
    const FILM_FETCH_SUCCESSFULLY = 'Fetch Successfully';


    public function execute($request)
    {


        try {
            $slug = $request;
            $film = $this->getBySlug($slug);
            $data = $this->singlefilmResponseGenerator($film);

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
