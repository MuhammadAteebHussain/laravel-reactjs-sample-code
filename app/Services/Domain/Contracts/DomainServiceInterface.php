<?php

namespace App\Services\Domain\Contracts;


interface DomainServiceInterface
{
    public function execute(object|array $request);
}
