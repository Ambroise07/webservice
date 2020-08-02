<?php 
namespace App\Models;
class Entreprises{
    private $id;
    private $nim;
    private $ifu;
    private $raison_social;
    private $adresse;
    private $telephone;
    private $email;
    private $api_key;
    private $api_active;
    private $tc;
    private $fvc;
    private $frc;

    /**
     * Get the value of id
     */ 
    public function getId():int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     * @param int $id
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nim
     */ 
    public function getNim():string
    {
        return $this->nim;
    }

    /**
     * Set the value of nim
     * @param string $nim
     * @return  self
     */ 
    public function setNim(string $nim)
    {
        $this->nim = $nim;

        return $this;
    }

    /**
     * Get the value of ifu
     */ 
    public function getIfu():int
    {
        return $this->ifu;
    }

    /**
     * Set the value of ifu
     * @param int $ifu
     * @return  self
     */ 
    public function setIfu(int $ifu)
    {
        $this->ifu = $ifu;

        return $this;
    }

    /**
     * Get the value of raison_social
     */ 
    public function getRaison_social():string
    {
        return $this->raison_social;
    }

    /**
     * Set the value of raison_social
     * @param string $raison_social
     * @return  self
     */ 
    public function setRaison_social(string $raison_social)
    {
        $this->raison_social = $raison_social;

        return $this;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse():string
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     * @param string $adresse
     * @return  self
     */ 
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of telephone
     */ 
    public function getTelephone():string
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     * @param string $telephone
     * @return  self
     */ 
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail():string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     * @param string $email
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of api_key
     */ 
    public function getApi_key():string
    {
        return $this->api_key;
    }

    /**
     * Set the value of api_key
     * @param string $api_key
     * @return  self
     */ 
    public function setApi_key(string $api_key)
    {
        $this->api_key = $api_key;

        return $this;
    }

    /**
     * Get the value of api_active
     */ 
    public function getApi_active():int
    {
        return $this->api_active;
    }

    /**
     * Set the value of api_active
     * @param int $api_active
     * @return  self
     */ 
    public function setApi_active(int $api_active)
    {
        $this->api_active = $api_active;

        return $this;
    }

    /**
     * Get the value of tc
     */ 
    public function getTc():int
    {
        return $this->tc;
    }

    /**
     * Set the value of tc
     * @param int $tc
     * @return  self
     */ 
    public function setTc(int $tc)
    {
        $this->tc = $tc;

        return $this;
    }

    /**
     * Get the value of fvc
     */ 
    public function getFvc():int
    {
        return $this->fvc;
    }

    /**
     * Set the value of fvc
     * @param int $int
     * @return  self
     */ 
    public function setFvc(int $fvc)
    {
        $this->fvc = $fvc;

        return $this;
    }

    /**
     * Get the value of frc
     */ 
    public function getFrc():int
    {
        return $this->frc;
    }

    /**
     * Set the value of frc
     * @param int $frc
     * @return  self
     */ 
    public function setFrc(int $frc)
    {
        $this->frc = $frc;

        return $this;
    }
}