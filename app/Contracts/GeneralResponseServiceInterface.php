<?php

namespace App\Contracts;


interface GeneralResponseServiceInterface
{

    public static function generateResponse($content,$code,$message,$http_code);
    public static function responseGenerator($body, $code, $message ,$http_code,$status=true);
    

}