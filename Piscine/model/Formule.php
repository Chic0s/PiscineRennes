<?php
class Formule
{
    private $id;
    private $nom;
    private $type;
    private $prix;
    private $periodeValidite;
    private $description;
    
    public function getId()
    {
        return $this->id;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getPrix()
    {
        return $this->prix;
    }
    public function getPeriodeValidite()
    {
        return $this->periodeValidite;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function __construct($id, $nom, $type, $prix, $periodeValidite, $description)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->type = $type;
        $this->prix = $prix;
        $this->periodeValidite = $periodeValidite;
        $this->description = $description;
    }
}