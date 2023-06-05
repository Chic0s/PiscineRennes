<?php
class Piscine
{
    /**
     * Identifiant de la piscine
     */
    private $id;
    /**
     * Nom de la piscine
     */
    private $nom;
    /**
     * Adresse de la piscine
     */
    private $adresse;
    /**
     * Identifiant de l'état de la piscine
     */
    private $idEtatPiscine;
    /**
     * Emplacement reatif de l'image de la piscine
     */
    private $srcImage;

    /**
     * Accesseur de $id de Piscine
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Accesseur de $nom de Piscine
     * @return string $nom
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * Mutateur de $nom de Piscine
     * @return void
     */
    public function setNom($nomToSet)
    {
        $this->nom = $nomToSet;
    }
    /**
     * Accesseur de $adresse de Piscine
     * @return string $adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
    /**
     * Mutateur de $adresse de Piscine
     * @return void
     */
    public function setAdresse($adresseToSet)
    {
        $this->adresse = $adresseToSet;
    }
    /**
     * Accesseur de $idEtatPiscine de Piscine
     * @return int $idEtatPiscine
     */
    public function getIdEtatPiscine()
    {
        return $this->idEtatPiscine;
    }
    /**
     * Mutateur de $idEtatPiscine de Piscine
     * @return void
     */
    public function setIdEtatPiscine($idEtatPiscineToSet)
    {
        $this->idEtatPiscine = $idEtatPiscineToSet;
    }
    /**
     * Accesseur de $srcImage de Piscine
     * @return string $srcImage
     */
    public function getSrcImage()
    {
        return $this->srcImage;
    }
    /**
     * Mutateur de $srcImage de Piscine
     * @return void
     */
    public function setSrcImage($srcImageToSet)
    {
        $this->srcImage = $srcImageToSet;
    }
    
    /**
     * Constructeur de la classe Piscine
     */
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