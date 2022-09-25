<?php

namespace App\Http\Services\Domain\Contracts;


interface DomainServiceInterface
{

    public function execute($request);
}
