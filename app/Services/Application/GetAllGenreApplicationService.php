<?php

namespace App\Services\Application;

use App\Contracts\AbstractGenres;
use App\Services\Application\Contracts\ApplicationServiceInterface;
use App\Services\Domain\AssignFilmGenreDomainService;
use App\Components\CustomStatusCodes;
use App\Models\Genre;
use App\Services\General\GeneralResponseService;

class GetAllGenreApplicationService  implements ApplicationServiceInterface
{
    protected $genre;

    const SUCCESSFULLY = "genre fetched";


    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }


    public function execute($request=[])
    {
        try {
            $result['code'] = CustomStatusCodes::COUNTRY_SUCCESS;
            $result['message'] = self::SUCCESSFULLY;
            $result['body'] = $this->genre::all();
            $result['http_code'] = CustomStatusCodes::HTTP_SUCCESS_CODE;
            $result['status'] = CustomStatusCodes::RESPONSE_SUCCESS_TRUE;
            return $result;
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
