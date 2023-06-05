<?php
class Formule
{
    /**
     *  Identifiant de la formule
     */
    private $id;
    /**
     * Nom de la formule
     */
    private $nom;
    /**
     * Type de la formule (parmis une liste prédéfinie)
     */
    private $type;
    /**
     * Prix de la formule
     */
    private $prix;
    /**
     * Période de validité de la formule
     */
    private $periodeValidite;
    /**
     * Description de la formule
     */
    private $description;
    
    /**
     * Accesseur de $id de Formule
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Accesseur de $nom de Formule
     * @return string $nom
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * Mutateur de $nom de Formule
     * @return void
     */
    public function setNom($nomToSet)
    {
        $this->nom = $nomToSet;
    }
    /**
     * Accesseur de $type de Formule
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Mutateur de $type de Formule
     * @return void
     */
    public function setType($typeToSet)
    {
        $this->type = $typeToSet;
    }
    /**
     * Accesseur de $prix de Formule
     * @return float $prix
     */
    public function getPrix()
    {
        return $this->prix;
    }
    /**
     * Mutateur de $prix de Formule
     * @return void
     */
    public function setPrix($prixToSet)
    {
        $this->prix = $prixToSet;
    }
    /**
     * Accesseur de $periodeValidite de Formule
     * @return string $periodeValidite
     */
    public function getPeriodeValidite()
    {
        return $this->periodeValidite;
    }
    /**
     * Accesseur de $description de Formule
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Mutateur de $description de Formule
     * @return void
     */
    public function setDescription($descriptionToSet)
    {
        $this->description = $descriptionToSet;
    }
    /**
     * Constructeur de la classe Formule
     */
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