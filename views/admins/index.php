<?php

use App\Components\Component;
use App\Database;
use App\Htmls\Form;

$form = new Form([],[]);
$components = new Component((new Database));
;?>

<div class="container pt-4 ">
    <div class="row ">
        <div class="col-4 ">
        <h6 class="text-center">Enrégistrer une Taxe</h6>
            <form method="post" action="">
                <?=$form->input('code','Entrer le code de la Taxe');?>
                <?=$form->input('libelle','Entrer une description');?>
                <?=$form->input('valeur','Entrer la valeur associée','number');?>
                <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
            </form>
        </div>

        <div class="col-4 ">
            <h6 class="text-center">Enrégistrer un Type de Facture</h6>
            <form method="post" action="">
                <?=$form->input('code','Entrer le code lié au type');?>
                <?=$form->input('libelle','Entrer une description');?>
                <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
            </form>
        </div>
        

        <div class="col-4 ">
            <h6 class="text-center">Enrégistrer un Moyen de Payements</h6>
            <form method="post" action="">
                <?=$form->input('code','Entrer le code lié au moyens de payement');?>
                <?=$form->input('libelle','Entrer une description');?>
                <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
            </form>
        </div>
    </div>
</div>
<hr class="mt-3 d-block" style="border: #28a745 1px solid;">
<div class="container pt-4 ">
    <div class="row ">
        <div class="col-4 ">
        <h6 class="text-center">La liste des Taxes</h6>
            <table class="table table-hover   table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Libelle</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i= 0;foreach(($components->getTaxes()) as $taxes) :$i++?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$taxes->getCode();?></td>
                        <td><?=$taxes->getLibelle();?></td>
                        <td><?=$taxes->getValeur();?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>


        <div class="col-4 ">
            <h6 class="text-center">La liste des Types de Facture</h6>
            <table class="table table-hover   table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Libelle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; foreach(($components->getTypeFacture()) as $typefacture) : $i++?>
                    <tr>
                    <td><?=$i;?></td>
                        <td><?=$typefacture->getCode();?></td>
                        <td><?=$typefacture->getLibelle();?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        

        <div class="col-4 ">
            <h6 class="text-center">La liste des Moyens de Payements</h6>
            <table class="table table-hover   table-bordered table-striped">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Libelle</th>
                    </tr>
                </thead>
                <tbody class="text-center">

                    <?php $i = 0 ;foreach(($components->getMoyenPayements()) as $moyentpayement) : $i++?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$moyentpayement->getCode();?></td>
                        <td><?=$moyentpayement->getLibelle();?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>