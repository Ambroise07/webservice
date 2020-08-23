<?php
namespace App\Helpers;
class Json{
    public static function message(bool $error = false,string $message=null, array $data = null){
        header('Content-Type: application/json');
        if($error){
            http_response_code(400);
            return json_encode(['status' =>400,'message'=>$message,'data'=>$data]);
        }else{
            http_response_code(200);
            return json_encode(['status' => 200,'message'=>$message,'data'=>$data]);
        }
    }

}