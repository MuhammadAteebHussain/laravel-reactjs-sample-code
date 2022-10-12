<?php

namespace App\Services\Application;

use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Components\CustomStatusCodes;
use App\Exceptions\GeneralException;
use App\Models\Genre;
use Exception;

class GetAllGenreApplicationService implements ApplicationServiceInterface
{
    protected $genre;

    const SUCCESSFULLY = "genre fetched";


    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function execute($request = []): array|bool
    {
        $result['code'] = CustomStatusCodes::COUNTRY_SUCCESS;
        $result['message'] = self::SUCCESSFULLY;
        $result['body'] = $this->genre::all();
        $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
        $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
        return $result;
    }
}
