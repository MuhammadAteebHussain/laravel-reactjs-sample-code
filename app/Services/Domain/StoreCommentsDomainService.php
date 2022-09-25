<?php

namespace App\Services\Domain;

use App\Contracts\AbstractComments;
use App\Services\Domain\Contracts\DomainServiceInterface;
use App\Services\General\GeneralResponseService;

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
