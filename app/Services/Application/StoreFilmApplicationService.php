<?php

namespace App\Services\Application;

use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\Domain\StoreFilmDomainService;
use App\Components\CustomStatusCodes;
use App\Services\General\GeneralResponseService;

class StoreFilmApplicationService implements ApplicationServiceInterface
{
    protected $store_film_service_service;
    protected $store_film_genre_service;

    const FILM_SUCCESS_MESSAGE = 'Inserted Successfully';
    const FILM_ERROR_MESSAGE = 'Something Went Wrong';


    public function __construct(
        StoreFilmDomainService $store_film_service_service,
        StoreFilmGenreApplicationService $store_film_genre_service
    ) {
        $this->store_film_service_service = $store_film_service_service;
        $this->store_film_genre_service = $store_film_genre_service;
    }


    public function execute($request): array
    {

        try {
            $data = $request;
            $destination_path = env('DESTINATION_PATH_FOR_IMAGES');
            $photo = $data['photo'];
            $image_name = rand() . $photo->getClientOriginalName();
            $data = array(
                'name' =>  $data['name'],
                'film_slug' => $data['film_slug'],
                'description' => $data['description'],
                'release_date' => $data['release_date'],
                'ticket_price' => $data['ticket_price'],
                'country_id' => $data['country_id'],
                'photo_object' => $data['photo'],
                'photo' => $image_name,
                'destination_path' => $destination_path,
            );
            $content = $this->store_film_service_service->execute($data);
            $film_genre_data['film_id'] = $content['id'];
            $film_genre_data['genre_ids'] = $request['genre_ids'];
            $this->store_film_genre_service->execute($film_genre_data);

            if ($content !== false) {
                $result['code'] = CustomStatusCodes::SUCCESS;
                $result['message'] = self::FILM_SUCCESS_MESSAGE;
                $result['body'] = $content;
                $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
                $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
            } else {
                $result['code'] = CustomStatusCodes::FAILURE;
                $result['message'] = self::FILM_ERROR_MESSAGE;
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
