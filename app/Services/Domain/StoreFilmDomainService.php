<?php

namespace App\Services\Domain;

use App\Contracts\Repository\FilmRepositoryInterface;
use App\Services\Domain\Contracts\DomainServiceInterface;

class StoreFilmDomainService  implements DomainServiceInterface
{


    protected FilmRepositoryInterface $repository;

    public function __construct(FilmRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * execute function
     *
     * @param object|array $request
     * @return object|boolean
     */
    public function execute(object|array $request) : object|bool
    {   
        $photo_move=$request['photo_object'];
        $destination_path=$request['destination_path'];
        $image_name=$request['photo'];
        $photo_move->move(public_path() . $destination_path, $image_name);
        if($photo_move==true){
            unset($request['photo_object']);
            unset($request['destination_path']);
            return $this->repository->storeFilms($request);
        }else{
            return false;
        }
        
    }
}
