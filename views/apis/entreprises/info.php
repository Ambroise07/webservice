<?php
use App\Components\Component;
use App\Database;
use App\Helpers\ApiKey;
use App\Helpers\Json;
use Datetime;
$db = new Database();
$apikey = $params['apikey'];
$response = ApiKey::validity($db,$apikey);
if(is_int($response)){
    $contribuable = (new Component($db))->contribuableInfoById($response);
    $data = [
        "OPT" => [
            "I0" => $contribuable->getRaison_social(),
            "I1" => $contribuable->getAdresse(),
            "I2" => $contribuable->getTelephone(),
            "I4" => $contribuable->getEmail()
        ]
    ];
    echo Json::message(false,null,$data);
}else{
    echo Json::message(true,$response);
}
