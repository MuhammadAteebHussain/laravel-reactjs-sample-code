<?php

namespace App\Http\Services\Domain;

use App\Contracts\AbstractComments;
use App\Http\Services\Domain\Contracts\DomainServiceInterface;

class StoreCommentsDomainService extends AbstractComments implements DomainServiceInterface
{



    public function execute($request)
    {


        $data = $this->storeComment($request);

        if ($data == true) {
            return $data;
        } else {
            return false;
        }
    }
}
