<?php
class Piscine
{
    private $id;
    private $nom;
    private $adresse;
    private $idEtatPiscine;
    private $srcImage;
    
    public function getId()
    {
        return $this->id;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function getIdEtatPiscine()
    {
        return $this->idEtatPiscine;
    }
    public function getSrcImage()
    {
        return $this->srcImage;
    }

    public function __construct($id, $nom, $adresse, $idEtatPiscine, $srcImage)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->idEtatPiscine = $idEtatPiscine;
        $this->srcImage = $srcImage;
    }
}