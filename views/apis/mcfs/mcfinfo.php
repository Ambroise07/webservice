<?php
use App\Components\Component;
use App\Database;
use App\Helpers\ApiKey;
use App\Helpers\Json;
#use Datetime;
$db = new Database();
$apikey = $params['apikey'];
$response = ApiKey::validity($db,$apikey);
if(is_int($response)){
    $mcfInfo = (new Component($db))->EtatMcf($apikey);
    $entreprise = $mcfInfo['entreprise'];
    $taxes = $mcfInfo['taxes'];
    $MCF = [];
    $MCF['NIM'] = $entreprise->getNim();
    $MCF['IFU']= $entreprise->getIfu();
    $MCF['DT'] =  (new DateTime)->format('YmdHis');
    $MCF['TC'] = $entreprise->getTc();
    $MCF['FVC'] = $entreprise->getFvc();
    $MCF['FRC'] = $entreprise->getFrc();
    foreach($taxes as $taxe){
        $MCF['TAX'.$taxe->getCode()] = number_format($taxe->getValeur(),2);
    }
    unset($MCF['TAXE'],$MCF['TAXF']);
    echo Json::message(false,null,$MCF);
}else{
    echo Json::message(true,$response);
}
