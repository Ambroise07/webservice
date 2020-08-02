<?php

use App\Components\Component;
use App\Database;
use App\Helpers\ApiKey;
use App\Helpers\Json;
use Datetime;
$totalTCC = 0;
$db = new Database();
$token = $params['token'];
$apikey = $params['apikey'];
$response = ApiKey::validity($db,$apikey);
if(is_int($response)){
    $component = new Component($db);
    $entreprise = $component->contribuableInfoById($response);
    $facture = $component->getFactureByToken($token);
    if($facture === false){
        echo Json::message(true,"Token invalide"); 
        exit;
    }
    $produits = $component->getProduitFactureById($component->checkFactureIdByToken($token));
    $countFacture = $component->getTypeCountFactureById($component->checkFactureIdByToken($token));
}else{
    echo Json::message(true,$response);
    exit;
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>

<div class="container mb-3  w-50" style="margin-top:10px">
    <div class="card w-100">
        <div class="card-header text-center">
            <strong><?=$entreprise->getRaison_social();?></strong> 
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6 text-center">
                    <strong class="float-left"> IFU : </strong> <br>
                    <strong class="float-left"> RCCM : </strong>
                </div>
                <div class="col-sm-6 text-center">
                    <strong class="float-right"><?=$entreprise->getIfu();?></strong> <br>
                    <strong class="float-right">RC/12.345-E FG 12/13/14</strong>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-12 text-center mb-3">
                    <strong> <?=$entreprise->getRaison_social();?> </strong> <br>
                    <span> <?=$entreprise->getAdresse();?> </span>  <br>
                    <span>TEL: <?=$entreprise->getTelephone();?> </span>  <br>
                    <span>Email: <?=$entreprise->getEmail();?> </span>
                </div>

                <div class="col-sm-12 mb-3 text-center">
                    <strong class="">FACTURE <?=$facture->code;?></strong>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-6 text-center mb-3">
                    <span class="float-left"> Vendeur : </span> <br>
                    <span class="float-left"> Facture No : </span>
                </div>
                <div class="col-sm-6 text-center mb-3">
                    <span class="float-right"><?=$facture->nomOpe;?></span> <br>
                    <span class="float-right"><?=$facture->id;?></span>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-6 text-center">
                    <span class="float-left"> IFU de l'acheteur : </span> <br>
                    <span class="float-left"> Nom de l'acheteur :  </span>
                </div>
                <div class="col-sm-6 text-center">
                    <span class="float-right"><?=$facture->ifu_client;?></span> <br>
                    <span class="float-right"><?=$facture->nom_client;?></span>
                </div>
            </div>

            <hr style="border: 1px solid black;">

            <div class="row mb-4">
                <div class="col-sm-12 text-center mb-2">
                        <span class="float-left"> # Nom </span> 
                        <span class="text-center"> Qté x P.U. </span>
                        <span class="float-right"> T.T.C. </span>
                </div>
                <?php $i=0; foreach($produits as $produit):$i++ ?>
                <div class="col-sm-12 mb-1">
                        <span class="float-left"><?=$i;?> <?= $produit->nom ." (".$produit->code.")";?> </span> 
                        <span class="" style="margin-left: 170px;"> <?=(int)$produit->quantite." x ".$produit->prix;?> </span>
                        <?php $ttc = (((((int)$produit->quantite * $produit->prix)*$produit->tva)/100)+(int)$produit->quantite * $produit->prix); $totalTCC += $ttc;?>
                        <span class="float-right"> <?=$ttc;?> </span>
                </div>
                <?php endforeach;?>
            </div>
            <hr style="border: 0.75px dashed black; opacity:0.3">

            <div class="row mb-4">
                <div class="col-sm-6 text-center">
                    <span class="float-left"> Total H.T.[B] 18% </span> <br>
                    <span class="float-left"> Total TVA [B] 18%  </span> <br>
                    <span class="float-left"> Total EXONERES [A-EX]</span> <br>
                    <span class="float-left"> AIB 1%  </span> <br>
                </div>
                <div class="col-sm-6 text-center">
                    <span class="float-right"><?=((int)$produit->quantite * $produit->prix);?></span> <br>
                    <span class="float-right"><?=((((int)$produit->quantite * $produit->prix)*$produit->tva)/100);?></span> <br>
                    <span class="float-right">0</span> <br>
                    <span class="float-right">0</span> <br>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6 text-center">
                    <strong class="float-left" >TOTAL TTC</strong><br>
                    <span class="float-left"> Vente <?= $produit->libelle ;?> :  </span> <br>
                    <span class="float-left"> Nombre d'articles:  </span> <br>
                </div>
                <div class="col-sm-6 text-center">
                     <strong class="float-right"><?= $totalTCC ;?></strong> <br>
                     <span class="float-right"><?=$totalTCC;?></span> <br>
                     <span class="float-right"><?=$i;?></span> <br>
                </div>
            </div>

            <div class="row mb-43">
                <div class="col-sm-12 text-center">
                    <span class="text-center" >CODE MECeF/DGI</span><br>
                    <?php if(!is_null($countFacture['SIG'])) : ?>
                        <strong class="text-center"><?=$countFacture['SIG'];?></strong>
                    <?php else: ?>
                        <strong class="text-center">XIA3-ODK3-HQBA-X2F3-K22N-MDYR</strong>
                    <?php endif;?>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-6 text-center">
                    <span class="float-left" >MECeF NIM:</span><br>
                    <span class="float-left"> MECeF Compteurs:  </span> <br>
                    <span class="float-left"> MECeF Heure:  </span> <br>
                </div>
                <div class="col-sm-6 text-center">
                     <span class="float-right"><?=$entreprise->getNim();?></span> <br>
                     <span class="float-right"> <?=$countFacture['FC'];?>/<?= $entreprise->getTc();?> <?=$countFacture['FT'];?></span> <br>
                     <span class="float-right"><?=(new DateTime)->format('Y/m/d H:i:s');?></span> <br>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-sm-12 mb-3 text-center">
                    <img class="img-fluid" src="/qrx.png" alt="nbvc" width="200">
                </div>

                <div class="col-sm-12 text-center mb-3">
                    <span>ISF : 73878237878 </span>  <br>
                    <span>MERCI & A BIENTOT </span>
                
                </div>
            </div>
            
        </div>
    </div>
</div>