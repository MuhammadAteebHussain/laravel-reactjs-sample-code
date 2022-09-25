<?php

namespace App\Http\Services\Domain;

use App\Contracts\AbstractUsers;
use App\Http\Services\Domain\Contracts\DomainServiceInterface;

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
        $result=$this->userTokenGenerator($user);
        return $result;
    }
}
