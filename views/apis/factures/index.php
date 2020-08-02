<?php
use App\Components\Component;
use App\Database;
use App\Helpers\ApiKey;
use App\Helpers\Json;
$db = new Database();
$apikey = $params['apikey'];
$response = ApiKey::validity($db,$apikey);
$component = new Component($db);
if(is_int($response)){
    if(!empty($_POST)){
        $typeFactureCode = '';
        if(!empty($_POST['VT'])){
            $typeFactureCode = $_POST['VT'];
        }elseif(!empty($_POST['RT'])){
            $typeFactureCode = $_POST['RT'];
        }elseif(!empty($_POST['RN'])){
            $typeFactureCode = $_POST['RN'];
        }else{
            $typeFactureCode = 'FV';
        }
        $idFactureType = $component->getTypeFactureByCode($typeFactureCode);
        if($idFactureType === false){
            echo Json::message(true,'Le type de facture n\'est pas valide');
            exit();
        }
        $idFactureType = $idFactureType->getID();
        $ifu = $_POST['IFU'] ?? 07;
        if(!$component->checkIfu($response,$ifu)){
            echo Json::message(true,'Numero ifu invalide');
            exit;
        }
        $token = ApiKey::generate(8).'T'.(new DateTime)->format('YmdHis');
        $date = (new DateTime)->format('Y-m-d H:i:s');
        $numOpe = $_POST['OPID'];
        $nomOpe = $_POST['OPNOM'];
        if(empty($_POST['CIFU'])){
            $ifu_client = 0;
        }else{
            $ifu_client = $_POST['CIFU'];
        }
        $nom_client = $_POST['CNOM'] ?? '';
        $cex = $_POST['CEX'] ?? '';
        $montant_vente = $_POST['montant_vente'] ?? 0;
        $montant_ht = $_POST['montant_ht'] ?? 0 ;
        $montant_taxe = $_POST['montant_taxe'] ?? 0;
        $taxe_spec = $_POST['taxe_spec'] ?? 0;
        $sig = $_POST['sig'] ?? ' ';
        $statut = 0;
        $entreprises_id = $response;
        $typeFacture_id = $idFactureType;
        $newFacture = $component->newFacture($token,$date,$numOpe,$nomOpe,$ifu_client,$nom_client,$cex,$montant_vente,$montant_ht,$montant_taxe,$taxe_spec,$sig,$statut,$entreprises_id,$idFactureType);
        $component->updateEntrepriseByNewFacture($entreprises_id);
        $responseNewFacture = $component->responseNewFactureByEntrepriseId($entreprises_id,$idFactureType) ;
        $responseNewFacture['token'] = $newFacture ;
        $data = $responseNewFacture;
        echo Json::message(false,null,$data);
        exit;
    }
}else{
   echo Json::message(true,$response);
}
