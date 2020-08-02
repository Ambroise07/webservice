<?php
namespace App\Models;
class TypeFactures{
    private $id;
    private $code;
    private $libelle;

    /**
     * Get the value of libelle
     */ 
    public function getLibelle():string
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     * @param string $libelle
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
    public function getCode():string
    {
        return $this->code;
    }

    /**
     * Set the value of code
     * @param string $code
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
    public function getId():int
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
}