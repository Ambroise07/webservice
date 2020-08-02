<?php
use App\Components\Component;
use App\Database;
use App\Helpers\ApiKey;
use App\Helpers\Json;
#use Datetime;
$db = new Database();
$token = $params['token'];
$apikey = $params['apikey'];
$response = ApiKey::validity($db,$apikey);
if(is_int($response)){
    $data = [];
    $component = new Component($db);
    $factureId = $component->checkFactureIdByToken($token);
    if(is_int($factureId)){
        $component->updateFactureStatutById($factureId,$response);
        $mcfInfo = $component->EtatMcf($apikey);
        $entreprise = $mcfInfo['entreprise'];
        $facture = $component->getTypeCountFactureById($factureId);
        $data['FC'] = $facture['FC'];
        $data['TC'] = $entreprise->getTc();
        $data['FT'] = $facture['FT'];
        $data['DT'] =  (new DateTime)->format('YmdHis');
        $data['NIM'] = $entreprise->getNim();
        $data['IFU']= $entreprise->getIfu();
        if(!is_null($facture['SIG'])){
            $data['SIG'] =$facture['SIG'] ;
        }
        echo Json::message(false,null,$data);
        exit; 
    }else{
        echo Json::message(true,$factureId);
        exit;
    }
}else{
    echo Json::message(true,$response);
}
