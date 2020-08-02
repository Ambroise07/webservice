<?php
namespace App\Models;
class ServeurMcf{
    private int $doc_telecharger;
    private int $doc_disponible;
    private string $date;
    private int $entreprise_id;

    /**
     * Get the value of entreprise_id
     */ 
    public function getEntreprise_id()
    {
        return $this->entreprise_id;
    }

    /**
     * Set the value of entreprise_id
     *
     * @return  self
     */ 
    public function setEntreprise_id($entreprise_id)
    {
        $this->entreprise_id = $entreprise_id;

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
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of doc_disponible
     */ 
    public function getDoc_disponible()
    {
        return $this->doc_disponible;
    }

    /**
     * Set the value of doc_disponible
     *
     * @return  self
     */ 
    public function setDoc_disponible($doc_disponible)
    {
        $this->doc_disponible = $doc_disponible;

        return $this;
    }

    /**
     * Get the value of doc_telecharger
     */ 
    public function getDoc_telecharger()
    {
        return $this->doc_telecharger;
    }

    /**
     * Set the value of doc_telecharger
     *
     * @return  self
     */ 
    public function setDoc_telecharger($doc_telecharger)
    {
        $this->doc_telecharger = $doc_telecharger;

        return $this;
    }
}