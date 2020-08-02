<?php
use App\Components\Component;
use App\Database;
use App\Helpers\ApiKey;
use App\Helpers\Json;

$token = $params['token'];
$apikey = $params['apikey'];


$db = new Database();
$response = ApiKey::validity($db,$apikey);

if(is_int($response)){
    $component = new Component($db);
    $factureId = $component->checkFactureIdByToken($token);
    if(is_int($factureId)){
        if(!empty($_POST)){
            $taxeCode = $_POST['TAX'];
            $taxes = $component->getTaxeByCode($taxeCode);
            if(is_array($taxes)){
               $taxeId = $taxes['id']; 
            }else{
                echo Json::message(true,$taxes);
                exit;
           }
            $nom = $_POST['NOM'];
            $description = $_POST['DESC'] ?? '';
            $tab = $_POST['TAB'] ?? 'null';
            $prix = $_POST['PR'];
            $taxes_id = $taxeId;//TAX
            if(empty($_POST['QT'])){
              $quantite = 1;  
            }else{
                $quantite = $_POST['QT'];
            }
            if(empty($_POST['TS'])){
                $taxe_spec = 1;
            }else{
              $taxe_spec = $_POST['TS'];
            }
            $montant_ht = $prix * $quantite;
            $montant_taxe = (($prix*$quantite) * $taxes['valeur']) / 100;
            $desc_taxe_spec = $_POST['TSDESC'] ?? '';
            if(empty($_POST['PRORIG'])){
                $prix_orig  = 0;
            }else{
                $prix_orig = $_POST['PRORIG'];
            }
            $desc_prix = $_POST['PRDESC'] ?? '';
            $component->nouvelArticle($nom,$description,$prix,$quantite,$taxe_spec,$desc_taxe_spec,$prix_orig,$desc_prix,$montant_ht,$montant_taxe,$factureId,$taxes_id);
            $data = [];
            $data['MV'] = $montant_taxe;
            $data['MH'] = $montant_ht;
            $data['MT'] = $taxes['valeur'];
            $data['TS'] = $taxe_spec ;
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
