<?php 
namespace App\Models;
class ReglementFactures{
    private int $id;
    private float $montant;
    private int $moyenPayements_id;
    private int $factures_id;

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
     * Get the value of montant
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     *
     * @return  self
     */ 
    public function setMontant(float $montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get the value of moyenPayements_id
     */ 
    public function getMoyenPayements_id()
    {
        return $this->moyenPayements_id;
    }

    /**
     * Set the value of moyenPayements_id
     *
     * @return  self
     */ 
    public function setMoyenPayements_id(int $moyenPayements_id)
    {
        $this->moyenPayements_id = $moyenPayements_id;

        return $this;
    }

    /**
     * Get the value of factures_id
     */ 
    public function getFactures_id()
    {
        return $this->factures_id;
    }

    /**
     * Set the value of factures_id
     *
     * @return  self
     */ 
    public function setFactures_id(int $factures_id)
    {
        $this->factures_id = $factures_id;

        return $this;
    }
}