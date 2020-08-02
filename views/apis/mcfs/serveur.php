<?php
use App\Components\Component;
use App\Database;
use App\Helpers\ApiKey;
use App\Helpers\Json;
use Datetime;
(new DateTime)->format('YmdHis');
$db = new Database();
$apikey = $params['apikey'];
$response = ApiKey::validity($db,$apikey);
if(is_int($response)){
    $serveur = (new Component($db))->statusServeurMcf($response);
    $date = explode(" ",$serveur->getDate());
    $date1 = str_replace("-","",$date[0]);
    $date2 = str_replace(":","",$date[1]);
    $data = ['EC'=>$serveur->getDoc_telecharger(),'DC'=>$serveur->getDoc_disponible(),'DT'=>$date1.$date2];
    echo Json::message(false,null,$data);
}else{
    echo Json::message(true,$response);
}