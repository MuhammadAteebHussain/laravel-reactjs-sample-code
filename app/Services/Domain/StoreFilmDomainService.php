<?php

namespace App\Services\Domain;

use App\Abstracts\AbstractFilms;
use App\Services\Domain\Contracts\DomainServiceInterface;

class StoreFilmDomainService extends AbstractFilms implements DomainServiceInterface
{



    public function execute($request)
    {   

        //becuaase it is our write layer so all write work will done here
        $photo_move=$request['photo_object'];
        $destination_path=$request['destination_path'];
        $image_name=$request['photo'];
        $photo_move->move(public_path() . $destination_path, $image_name);
        if($photo_move==true){
            unset($request['photo_object']);
            unset($request['destination_path']);
            return $this->storeFilms($request);
        }else{
            return false;
        }
        
    }
}
