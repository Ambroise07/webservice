<?php
namespace App\Components;

use App\Database;
use App\Helpers\ApiKey;
use App\Models\Entreprises;
use App\Models\Factures;
use App\Models\MoyenPayements;
use App\Models\ServeurMcf;
use App\Models\Taxes;
use App\Models\TypeFactures;
use DateTime;
Use PDO;
class Component{
    private  $db;
    public function __construct(Database $db)
    {
        $this->db = $db;
        
    }
    public function getTaxes(){
        $query = 'SELECT * FROM taxes';
        return $this->db->select($query,true,null,PDO::FETCH_CLASS,Taxes::class);
    }
    public function getMoyenPayements(){
        $query = 'SELECT * FROM moyenPayements';
        return $this->db->select($query,true,null,PDO::FETCH_CLASS,MoyenPayements::class);
    }
    public function getFactureByToken($token){
        if(!is_int($this->checkFactureIdByToken($token))){
            return false;
        }
        $query = 'SELECT factures.id,numOpe,nomOpe,ifu_client,nom_client,code FROM factures JOIN typeFacture ON typeFacture.id=factures.id WHERE token=:token';
        return $this->db->select($query,false,[':token'=>$token]);
    }
    public function getTypeFacture(){
        $query = 'SELECT * FROM typeFacture';
        return $this->db->select($query,true,null,PDO::FETCH_CLASS,TypeFactures::class);
    }
    public function getTypeFactureByCode($code){
        $query = 'SELECT id FROM typeFacture WHERE code = :code';
        return $this->db->select($query,false,[':code'=>$code],PDO::FETCH_CLASS,TypeFactures::class);
    }
    public function getProduitFactureById(int $factures_id){
        $query = 'SELECT moyenPayements.libelle,taxes.code,produitFacture.nom,prix,quantite,produitFacture.montant_ht,produitFacture.montant_taxe,valeur AS tva FROM produitFacture JOIN factures ON factures.id=produitFacture.factures_id JOIN taxes ON taxes.id=produitFacture.taxes_id JOIN reglementFacture ON reglementFacture.factures_id=factures.id JOIN moyenPayements ON moyenPayements.id=reglementFacture.moyenPayements_id WHERE produitFacture.factures_id=:factures_id';
        return $this->db->select($query,true,[':factures_id'=>$factures_id]);
    }
    public function EtatMcf(string $apiKey):array{
        $query = 'SELECT nim,ifu,tc,fvc,frc FROM entreprises WHERE entreprises.api_key= :api_key';
        /** @var Entreprises */
        $entreprise = $this->db->select($query,false,[':api_key'=>$apiKey],PDO::FETCH_CLASS,Entreprises::class);
        /** @var Taxes */
        $taxes = $this->getTaxes();
        return ['entreprise'=>$entreprise, 'taxes'=>$taxes];
    }
    public function statusServeurMcf(int $entreprise_id):ServeurMcf{
        $query = 'SELECT * FROM serveurMcf WHERE entreprise_id = :entreprise_id';
        return $this->db->select($query,false,[':entreprise_id'=>$entreprise_id],PDO::FETCH_CLASS,ServeurMcf::class);
    }
    public function contribuableInfoById(int $id){
        $query = 'SELECT tc,nim,ifu,raison_social,adresse,telephone,email FROM entreprises WHERE id=:id';
        return $this->db->select($query,false,[':id'=>$id],PDO::FETCH_CLASS,Entreprises::class);
    }
    public function checkIfu(int $id,int $ifu):bool{
        $query = "SELECT id FROM entreprises WHERE id=:id AND ifu=:ifu";
        $ifuValide = $this->db->select($query,false,[':id'=>$id,':ifu'=>$ifu],PDO::FETCH_CLASS,Entreprises::class);
        if($ifuValide === false){
            return false;
        }
        return true;
    }
    public function newFacture(string $token,string $date,int $numOpe,string $nomOpe,int $ifu_client,string $nom_client,string  $cex, float $montant_vente,float $montant_ht, float $montant_taxe,float $taxe_spec,string $sig,int $statut,int $entreprise_id, int $typeFacture_id){

        $query = "INSERT INTO `factures` (`token`, `date`, `numOpe`, `nomOpe`, `ifu_client`, `nom_client`, `cex`, `montant_vente`, `montant_ht`, `montant_taxe`, `taxe_spec`, `sig`, `statut`, `entreprises_id`, `typeFacture_id`) VALUES (:token,:date,:numOpe,:nomOpe,:ifu_client,:nom_client,:cex,:montant_vente,:montant_ht,:montant_taxe,:taxe_spec,:sig,:statut,:entreprises_id,:typeFacture_id)";
        $result = $this->db->insert($query,
        [
            ':token'=>$token,
            ':date'=>$date,
            ':numOpe'=>$numOpe,
            ':nomOpe'=>$nomOpe,
            ':ifu_client'=>$ifu_client,
            ':nom_client'=>$nom_client,
            ':cex'=>$cex,
            ':montant_vente'=>$montant_vente,
            ':montant_ht'=>$montant_ht,
            ':montant_taxe'=>$montant_taxe,
            ':taxe_spec'=>$taxe_spec,
            ':sig'=>$sig,
            ':statut'=>$statut,
            ':entreprises_id'=>$entreprise_id,
            ':typeFacture_id'=>$typeFacture_id
        ]);
        if($result){
            return $token;
        }else{
            return 'une erreur inatendue';
        }
    }

    public function nouvelArticle($nom,$description,$prix,$quantite,$taxe_spec,$desc_taxe_spec,$prix_orig,$desc_prix,$montant_ht,$montant_taxe,$factures_id,$taxes_id){

        $query = "INSERT INTO `produitFacture` (`nom`, `description`, `prix`, `quantite`, `taxe_spec`, `desc_taxe_spec`, `prix_orig`, `desc_prix`, `montant_ht`, `montant_taxe`, `factures_id`, `taxes_id`) VALUES (:nom, :description, :prix, :quantite, :taxe_spec, :desc_taxe_spec, :prix_orig, :desc_prix, :montant_ht, :montant_taxe, :factures_id, :taxes_id)";

        return $this->db->insert($query,[
            ':nom' => $nom,
            ':description' => $description,
            ':prix' => $prix,
            ':quantite' => $quantite,
            ':taxe_spec' => $taxe_spec,
            ':desc_taxe_spec' => $desc_taxe_spec,
            ':prix_orig' => $prix_orig,
            ':desc_prix' => $desc_prix,
            ':montant_ht' => $montant_ht,
            ':montant_taxe' => $montant_taxe,
            ':factures_id' => $factures_id,
            ':taxes_id' => $taxes_id
        ],true);
    }

    public function updateEntrepriseByNewFacture(int $entreprise_id){
        $query1 = "SELECT tc FROM entreprises WHERE id=:id";
        $tc = $this->db->select($query1,false,[':id'=>$entreprise_id])->tc += 1;
        //UPDATE `entreprises` SET `tc` = '10' WHERE `entreprises`.`id` = 1;
        $query = "UPDATE `entreprises` SET `tc` = :tc WHERE `entreprises`.`id` = :id";
        $this->db->update($query,[':tc'=>$tc,':id'=>$entreprise_id]);
    }

    public function responseNewFactureByEntrepriseId(int $entreprise_id,int $idFactureType):array{
        $query = 'SELECT tc FROM entreprises WHERE id = :id';
        $tc = $this->db->select($query,false,[':id'=>$entreprise_id])->tc;
        $query2 = "SELECT COUNT(id) As total FROM factures WHERE typeFacture_id = :typeFacture_id";
        $fc = $this->db->select($query2,false,[':typeFacture_id'=>$idFactureType])->total;
        //idFactureType;
        return ['FC'=>$fc,'TC'=>$tc];
    }

    public function checkFactureIdByToken(string $token){

        $query =  'SELECT id FROM factures WHERE token = :token';
        /** @var Factures */
        $facT = $this->db->select($query,false,[':token'=>$token],PDO::FETCH_CLASS,Factures::class);
        if($facT === false){
            return 'token invalide';
        }
        return $facT->getId();
    }

    public function getTaxeByCode(string $code){
        $query = 'SELECT id,valeur FROM taxes WHERE code = :code';
        $id = $this->db->select($query,false,[':code'=>$code],PDO::FETCH_CLASS,Taxes::class);
        if($id=== false){
            return "Le code taxe est invalide";
        }
        return ['id'=>$id->getId(),'valeur'=>$id->getValeur()];
    }

    public function getSousTotal($factures_id){
        $data = [];
        $query = "SELECT SUM(montant_ht) AS MV FROM produitFacture WHERE factures_id = :factures_id";
        $data['MV'] = $this->db->select($query,false,[':factures_id'=>$factures_id])->MV;
        $MVTable = ['A','B','C','D','E','F'];
        $MTTable = ['A','B','C','D','E','F'];
        foreach($MVTable as $code){
            $query = "SELECT SUM(montant_taxe) AS MV{$code} FROM produitFacture JOIN taxes ON produitFacture.taxes_id = taxes.id WHERE taxes.code= :code AND factures_id= :factures_id";
            $temp = "MV".$code;
            $tempsR = $this->db->select($query,false,[':code'=>$code,':factures_id'=>$factures_id])->$temp ;
            if(!is_null($tempsR)){
                $data['MV'.$code] = $tempsR;
                continue;    
            }
            $data['MV'.$code] = 0;
        }
        foreach($MTTable as $code){
            $query = "SELECT valeur AS MT{$code} FROM taxes WHERE code = :code";
            $temp = "MT".$code;
            $data['MT'.$code] = $this->db->select($query,false,[':code'=>$code])->$temp;
        }
        $query = "SELECT SUM(cex) AS MAIB FROM factures WHERE id = :id";
        $MAIB = $this->db->select($query,false,[':id'=>$factures_id])->MAIB;
        if(is_null($MAIB)){
            $data['MAIB'] = 0;
        }else{$data['MAIB'] = $MAIB;}
        $query = "SELECT SUM(taxe_spec) AS MTS FROM produitFacture WHERE factures_id = :factures_id";
        $MTS = $this->db->select($query,false,[':factures_id'=>$factures_id])->MTS;
        if(is_null($MAIB)){
            $data['MTS']= 0;
        }else{$data['MTS'] = $MTS;}
        $date['FACTURE_ID'] = $factures_id;
        return $data;
    }

    public function reglementFacture(float $montant, int $moyenPayements_id,int $factures_id){
        $query = "INSERT INTO `reglementFacture` (`montant`, `moyenPayements_id`, `factures_id`) VALUES (:montant, :moyenPayements_id, :factures_id)";
        $this->db->insert($query,[
            ':montant'=>$montant,
            ':moyenPayements_id' => $moyenPayements_id,
            ':factures_id' => $factures_id
        ]);
    }
    public function getIdMoyenPayementsByCode(string $code):int {
        $query = "SELECT id FROM `moyenPayements` WHERE code = :code";
        return $this->db->select($query,false,[':code'=>$code])->id;
    }
    public function getTypeCountFactureById(int $factures_id){
        $query = 'SELECT code FROM `typeFacture` JOIN factures ON factures.typeFacture_id=typeFacture.id WHERE factures.id = :factures_id';
        $code = $this->db->select($query,false,[':factures_id'=>$factures_id])->code;
        $query = "SELECT COUNT(factures.id) AS FC FROM `factures` JOIN typeFacture ON typeFacture.id=factures.typeFacture_id WHERE code = :code";
        $FC = $this->db->select($query,false,[':code'=>$code])->FC;
        $query = "SELECT sig FROM factures WHERE factures.id= :factures_id";
        $SIG = $this->db->select($query,false,[':factures_id'=>$factures_id])->sig;
        return ['FT'=>$code,'FC'=>$FC,'SIG'=>$SIG];
    }

    public static function sig(int $length): string
    {
        $keys = '0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';

        return substr(str_shuffle(str_repeat($keys, $length)), 0, $length);
    }
    public function updateFactureStatutById(int $factures_id,int $entreprises_id){
        $query = "UPDATE `factures` SET `sig` = :sig, `statut` = :statut WHERE `factures`.`id` = :factures_id AND `factures`.`entreprises_id` = :entreprises_id";
        $this->db->update($query,
            [
                ':sig' => $this->sig(15),
                ':statut' => 1,
                ':factures_id' => $factures_id,
                ':entreprises_id' => $entreprises_id
            ]
        );
    }

    public function generateToken(){
        return ApiKey::generate(8).'T'.(new DateTime)->format('YmdHis');
    }
}