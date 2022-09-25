<?php

namespace App\Services\Application;

use App\Contracts\AbstractGenres;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\Domain\AssignFilmGenreDomainService;
use App\Components\CustomStatusCodes;
use App\Services\General\GeneralResponseService;

class AssignGenreApplicationService  implements ApplicationServiceInterface
{
    protected $store_genre_service_service;

    const GENRE_SUCCESS_MESSAGE = 'Inserted Successfully';
    const GENRE_ERROR_MESSAGE = 'Something Went Wrong';


    public function __construct(AssignFilmGenreDomainService $store_genre_service_service)
    {
        $this->store_genre_service_service = $store_genre_service_service;
    }


    public function execute($request)
    {


        try {
            $data = array(
                'genre_id' =>  $request['genre_id'],
                'film_id' => $request['film_id'],
            );
            $content = $this->store_genre_service_service->execute($data);
            if ($content !== false) {
                $result['code'] = CustomStatusCodes::SUCCESS;
                $result['message'] = self::GENRE_SUCCESS_MESSAGE;
                $result['body'] = $content;
                $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
                $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
            } else {
                $result['code'] = CustomStatusCodes::FAILURE;
                $result['message'] = self::GENRE_ERROR_MESSAGE;
                $result['body'] = [];
                $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
                $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_FALSE;
            }
            return $result;
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
