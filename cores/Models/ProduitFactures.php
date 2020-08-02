<?php 
namespace App\Models;
class ProduitFactures{
    private int $id;
    private string $nom;
    private string $description;
    private float $prix;
    private float $quantite;
    private float $taxe_spec;
    private string $desc_taxe_spec;
    private float $prix_orig;
    private string $desc_prix;
    private float $montant_ht;
    private float $montant_taxe;
    private int $factures_id;
    private int $taxes_id;

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
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of quantite
     */ 
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set the value of quantite
     *
     * @return  self
     */ 
    public function setQuantite(float $quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix(float $prix)
    {
        $this->prix = $prix;

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
     * Get the value of desc_taxe_spec
     */ 
    public function getDesc_taxe_spec()
    {
        return $this->desc_taxe_spec;
    }

    /**
     * Set the value of desc_taxe_spec
     *
     * @return  self
     */ 
    public function setDesc_taxe_spec(string $desc_taxe_spec)
    {
        $this->desc_taxe_spec = $desc_taxe_spec;

        return $this;
    }

    /**
     * Get the value of prix_orig
     */ 
    public function getPrix_orig()
    {
        return $this->prix_orig;
    }

    /**
     * Set the value of prix_orig
     *
     * @return  self
     */ 
    public function setPrix_orig(float $prix_orig)
    {
        $this->prix_orig = $prix_orig;

        return $this;
    }

    /**
     * Get the value of desc_prix
     */ 
    public function getDesc_prix()
    {
        return $this->desc_prix;
    }

    /**
     * Set the value of desc_prix
     *
     * @return  self
     */ 
    public function setDesc_prix(string $desc_prix)
    {
        $this->desc_prix = $desc_prix;

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

    /**
     * Get the value of taxes_id
     */ 
    public function getTaxes_id()
    {
        return $this->taxes_id;
    }

    /**
     * Set the value of taxes_id
     *
     * @return  self
     */ 
    public function setTaxes_id(int $taxes_id)
    {
        $this->taxes_id = $taxes_id;

        return $this;
    }
}