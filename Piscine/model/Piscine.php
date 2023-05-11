<?php
class Piscine
{
    #region Attributes
    private $id;
    private $nom;
    private $adresse;
    private $idEtatPiscine;
    private $srcImage;
    #endregion

    #region Getters/Setters
    public function getId()
    {
        return $this->id;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nomToSet)
    {
        $this->nom = $nomToSet;
    }
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function setAdresse($adresseToSet)
    {
        $this->adresse = $adresseToSet;
    }
    public function getIdEtatPiscine()
    {
        return $this->idEtatPiscine;
    }
    public function setIdEtatPiscine($idEtatPiscineToSet)
    {
        $this->idEtatPiscine = $idEtatPiscineToSet;
    }
    public function getSrcImage()
    {
        return $this->srcImage;
    }
    public function setSrcImage($srcImageToSet)
    {
        $this->srcImage = $srcImageToSet;
    }
    #endregion
    
    #region Constructor
    public function __construct($id, $nom, $adresse, $idEtatPiscine, $srcImage)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->idEtatPiscine = $idEtatPiscine;
        $this->srcImage = $srcImage;
    }
    #endregion
}