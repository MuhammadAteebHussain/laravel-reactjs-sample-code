<?php

namespace App\Http\Services\Domain;

use App\Contracts\AbstractComments;
use App\Http\Services\Domain\Contracts\DomainServiceInterface;
use App\Http\Services\General\GeneralResponseService;

class StoreCommentsDomainService extends AbstractComments implements DomainServiceInterface
{



    public function execute($request)
    {

        try {
            $data = $this->storeComment($request);
            if ($data) {
                return $data;
            } else {
                return false;
            }
        } catch (\Exception $ex) {
            return GeneralResponseService::GenerateMessageByException($ex);
        }
    }
}
