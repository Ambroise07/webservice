<?php 
namespace App\Models;
class Factures{
    private int $id;
    private string $token;
    private string $date;
    private int $numOpe;
    private string $nomOpe;
    private int $ifu_client;
    private $nom_client;
    private string $cex;
    private float $montant_vente;
    private float $montant_ht;
    private float $montant_taxe;
    private float $taxe_spec;
    private string $sig;
    private string $statut;
    private int $entreprises_id;
    private int $typeFacture_id;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate(string $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of numOpe
     */ 
    public function getNumOpe()
    {
        return $this->numOpe;
    }

    /**
     * Set the value of numOpe
     *
     * @return  self
     */ 
    public function setNumOpe(int $numOpe)
    {
        $this->numOpe = $numOpe;

        return $this;
    }

    /**
     * Get the value of nomOpe
     */ 
    public function getNomOpe()
    {
        return $this->nomOpe;
    }

    /**
     * Set the value of nomOpe
     *
     * @return  self
     */ 
    public function setNomOpe(string $nomOpe)
    {
        $this->nomOpe = $nomOpe;

        return $this;
    }

    /**
     * Get the value of ifu_client
     */ 
    public function getIfu_client()
    {
        return $this->ifu_client;
    }

    /**
     * Set the value of ifu_client
     *
     * @return  self
     */ 
    public function setIfu_client(int $ifu_client)
    {
        $this->ifu_client = $ifu_client;

        return $this;
    }

    /**
     * Get the value of nom_client
     */ 
    public function getNom_client()
    {
        return $this->nom_client;
    }

    /**
     * Set the value of nom_client
     *
     * @return  self
     */ 
    public function setNom_client(string $nom_client)
    {
        $this->nom_client = $nom_client;

        return $this;
    }

    /**
     * Get the value of cex
     */ 
    public function getCex()
    {
        return $this->cex;
    }

    /**
     * Set the value of cex
     *
     * @return  self
     */ 
    public function setCex(string $cex)
    {
        $this->cex = $cex;

        return $this;
    }

    /**
     * Get the value of montant_vente
     */ 
    public function getMontant_vente()
    {
        return $this->montant_vente;
    }

    /**
     * Set the value of montant_vente
     *
     * @return  self
     */ 
    public function setMontant_vente(float $montant_vente)
    {
        $this->montant_vente = $montant_vente;

        return $this;
    }

    /**
     * Get the value of montant_ht
     */ 
    public function getMontant_ht()
    {
        return $this->montant_ht;
    }

    /**
     * Set the value of montant_ht
     *
     * @return  self
     */ 
    public function setMontant_ht(float $montant_ht)
    {
        $this->montant_ht = $montant_ht;

        return $this;
    }

    /**
     * Get the value of montant_taxe
     */ 
    public function getMontant_taxe()
    {
        return $this->montant_taxe;
    }

    /**
     * Set the value of montant_taxe
     *
     * @return  self
     */ 
    public function setMontant_taxe(float $montant_taxe)
    {
        $this->montant_taxe = $montant_taxe;

        return $this;
    }

    /**
     * Get the value of sig
     */ 
    public function getSig()
    {
        return $this->sig;
    }

    /**
     * Set the value of sig
     *
     * @return  self
     */ 
    public function setSig(string $sig)
    {
        $this->sig = $sig;

        return $this;
    }

    /**
     * Get the value of taxe_spec
     */ 
    public function getTaxe_spec()
    {
        return $this->taxe_spec;
    }

    /**
     * Set the value of taxe_spec
     *
     * @return  self
     */ 
    public function setTaxe_spec(float $taxe_spec)
    {
        $this->taxe_spec = $taxe_spec;

        return $this;
    }

    /**
     * Get the value of entreprises_id
     */ 
    public function getEntreprises_id()
    {
        return $this->entreprises_id;
    }

    /**
     * Set the value of entreprises_id
     *
     * @return  self
     */ 
    public function setEntreprises_id(int $entreprises_id)
    {
        $this->entreprises_id = $entreprises_id;

        return $this;
    }

    /**
     * Get the value of typeFacture_id
     */ 
    public function getTypeFacture_id()
    {
        return $this->typeFacture_id;
    }

    /**
     * Set the value of typeFacture_id
     *
     * @return  self
     */ 
    public function setTypeFacture_id(int $typeFacture_id)
    {
        $this->typeFacture_id = $typeFacture_id;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut(string $statut)
    {
        $this->statut = $statut;

        return $this;
    }
}