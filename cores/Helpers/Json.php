<?php
namespace App\Helpers;
class Json{
    public static function message(bool $error = false,string $message=null, array $data = null){
        header('Content-Type: application/json');
        return json_encode(['error' =>$error,'message'=>$message,'data'=>$data]);
    }

}