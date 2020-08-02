<?php
use App\Components\Component;
use App\Database;
use App\Helpers\ApiKey;
use App\Helpers\Json;
#use App\Validators\validateF;

$token = $params['token'];
$apikey = $params['apikey'];


$db = new Database();
$response = ApiKey::validity($db,$apikey);

if(is_int($response)){
    $component = new Component($db);
    $factureId = $component->checkFactureIdByToken($token);
    if(is_int($factureId)){ 
        $data = $component->getSousTotal($factureId);
        echo Json::message(false,null,$data);
        exit;
    }else{
        echo Json::message(true,$factureId);
        exit;
    }
}else{
    echo Json::message(true,$response);
    exit;
}