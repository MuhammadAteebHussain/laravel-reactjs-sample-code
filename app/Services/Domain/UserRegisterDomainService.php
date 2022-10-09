<?php

namespace App\Services\Domain;

use App\Abstracts\AbstractUsers;
use App\Contracts\UserRepositoryInterface;
use App\Services\Domain\Contracts\DomainServiceInterface;

class UserRegisterDomainService extends AbstractUsers implements DomainServiceInterface
{
    protected UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute($data)
    {
        $user = $this->repository->registerUser($data);
        $token = $this->userTokenGenerator($user);
        $result['user_id'] = $user->id;
        $result['token'] = $token;
        return $result;
    }
}
