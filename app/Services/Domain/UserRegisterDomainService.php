<?php

namespace App\Services\Domain;

use App\Abstracts\AbstractUsers;
use App\Contracts\UserRepositoryInterface;
use App\Services\Domain\Contracts\DomainServiceInterface;

class UserRegisterDomainService extends AbstractUsers implements DomainServiceInterface
{
    protected UserRepositoryInterface $repository;

    /**
     * __construct function
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * execute function
     *
     * @param object|array $request
     * @return array
     */
    public function execute(object|array $request): array
    {
        $user = $this->repository->registerUser($request);
        $token = $this->userTokenGenerator($user);
        $result['user_id'] = $user->id;
        $result['token'] = $token;
        return $result;
    }
}
