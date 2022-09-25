<?php

namespace App\Http\Services\Application;

use App\Contracts\AbstractFilms;
use App\Http\Services\Application\Contracts\ApplicationServiceInterface;
use App\Http\Services\Domain\StoreFilmDomainService;
use App\Components\CustomStatusCodes;
use App\Http\Services\Domain\Contracts\DomainServiceInterface;
use App\Http\Services\General\GeneralResponseService;

class StoreFilmsApplicationService  implements ApplicationServiceInterface
{
    protected $store_film_service_service;

    const FILM_SUCCESS_MESSAGE = 'Inserted Successfully';
    const FILM_ERROR_MESSAGE = 'Something Went Wrong';


    public function __construct(DomainServiceInterface $store_film_service_service)
    {
        $this->store_film_service_service = $store_film_service_service;
    }


    public function execute($request)
    {


        try {

            // print_r($request->file('photo'));
            $data = $request->all();

            $destination_path = '/images/';
            $photo = $request->file('photo');
            $image_name = rand() . $photo->getClientOriginalName();

            $data = array(
                'name' =>  $data['name'],
                'film_slug' => $data['film_slug'],
                'description' => $data['description'],
                'release_date' => $data['release_date'],
                'ticket_price' => $data['ticket_price'],
                'country' => $data['country'],
                'photo_object' => $request->file('photo'),
                'photo' => $image_name,
                'destination_path' => $destination_path,
            );
            $content = $this->store_film_service_service->execute($data);
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
