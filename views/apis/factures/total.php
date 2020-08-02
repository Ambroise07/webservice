<?php
use App\Components\Component;
use App\Database;
use App\Helpers\ApiKey;
use App\Helpers\Json;

$token = $params['token'];
$apikey = $params['apikey'];
$montantTotal = $params['montantTotale'];

$db = new Database();
$response = ApiKey::validity($db,$apikey);

if(is_int($response)){
    $component = new Component($db);
    $factureId = $component->checkFactureIdByToken($token);
    if(is_int($factureId)){ 
        $data = [];
        if(!empty($_POST)){
            $moyenPayementsCode = $_POST['PA'] ?? "E";
            $moyenPayements_id = $component->getIdMoyenPayementsByCode($moyenPayementsCode);
            $montant = $_POST['MT'];
            if($montant < $montantTotal){
                $data['RC'] = "E";
                echo Json::message(false,null,$data);
                exit;
            }
            $component->reglementFacture($montant,$moyenPayements_id,$factureId);
            $data['RC'] = "R";
            $data['MP'] = $montant - floatval($montantTotal);
            echo Json::message(false,null,$data);
            exit;
        }else{
            $montant = floatval($montantTotal);
            $moyenPayementsCode  = "E";
            $moyenPayements_id = $component->getIdMoyenPayementsByCode($moyenPayementsCode);
            $component->reglementFacture($montant,$moyenPayements_id,$factureId);
            $data['RC'] = "R";
            $data['MP'] = 0;
            echo Json::message(false,null,$data);
            exit;
        }
    }else{
        echo Json::message(true,$factureId);
        exit;
    }
}else{
    echo Json::message(true,$response);
    exit;
}