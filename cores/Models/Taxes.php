<?php 
namespace App\Models;
class Taxes{
    private int $id;
    private string $code;
    private string $libelle;
    private float $valeur;

    /**
     * Get the value of libelle
     */ 
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */ 
    public function setLibelle(string $libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

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
     * Get the value of valeur
     */ 
    public function getValeur():float
    {
        return  $this->valeur;
    }

    /**
     * Set the value of valeur
     *
     * @return  self
     */ 
    public function setValeur(float $valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }
}