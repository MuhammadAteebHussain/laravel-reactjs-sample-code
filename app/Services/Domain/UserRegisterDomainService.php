<?php

namespace App\Services\Domain;

use App\Contracts\AbstractUsers;
use App\Services\Domain\Contracts\DomainServiceInterface;

class UserRegisterDomainService extends AbstractUsers implements DomainServiceInterface
{

    public function __construct() {
        
    }
    
    
    /* 
        Domain Layers we are using for writing business logic
    
    */

    public function execute($data)
    {
        $user=$this->registerUser($data);
        $token=$this->userTokenGenerator($user);
        $result['user_id'] = $user->id;
        $result['token'] = $token;
        return $result;
    }
}
