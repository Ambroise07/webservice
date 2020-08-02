<?php

use App\Htmls\Form;

$form = new Form([],[]);
;?>

<div class="container pt-4 ">
    <div class="row ">
        <div class="col-4 ">
        <h6 class="text-center">ENREGISTRER UNE ENTREPRISE</h6>
            <form method="post" action="">
                <?=$form->input('nim','Entrer le numéro de série de la machine');?>
                <?=$form->input('ifu','Entrer l\'identifiant Fiscal Unique');?>
                <?=$form->input('rs','raison social');?>
                <?=$form->input('adresse','Entrer l\'adresse');?>
                <?=$form->input('numero','Entrer le numero de télephone','number');?>
                <?=$form->input('email','Enter  l\'adresse mail','email');?>
                <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
            </form>
        </div>
    </div>
</div>