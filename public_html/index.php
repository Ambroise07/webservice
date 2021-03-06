<?php

use App\Router;

$viewPath = '../views/';
require_once '../vendor/autoload.php';
//Erreur handler
$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
$whoops->register(); 
//End erreur handler
$router = new Router($viewPath);
$router->get('/', 'admins/homes/index')
    ->get('/administrer', 'admins/index' ,'administrateur')
    ->get('/administrer/enregistrer', 'admins/new','nouvelle-entreprise')

    //API

    /* GET METHOD */

    ->get('/api/mcf-status/[a:apikey]', 'apis/mcfs/mcfinfo')
    ->get('/api/serveur-status/[a:apikey]', 'apis/mcfs/serveur')
    ->get('/api/entreprise-info/[a:apikey]', 'apis/entreprises/info')
    
    ->get('/api/sous-total/[a:token]/[a:apikey]', 'apis/factures/sous-total')
    ->get('/api/fin-facture/[a:token]/[a:apikey]', 'apis/factures/fin')
    ->get('/api/affiche-facture/[a:token]/[a:apikey]', 'apis/factures/affiche')

///api/affiche-facture/BqYVaa1oT20200823162903/AZERTYUIOP12345678
    /* POST METHOD */ 

    ->post('/api/nouvelle-facture/[a:apikey]', 'apis/factures/index')//POST METHODE ONLY
    ->post('/api/nouveau-produit/[a:token]/[a:apikey]', 'apis/produits/index')//POST METHDE ONLY

    /* GET | POST METHOD */ 

    ->getpost('/api/total/[a:token]/[*:montantTotale]/[a:apikey]', 'apis/factures/total')
    ->run();
