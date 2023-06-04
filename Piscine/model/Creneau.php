<?php
class Creneau
{
    /**
     * Identifiant du créneau
     */
    private $id;
    /**
     * Identifiant du bassin lié au créneau
     */
    private $idBassin;
    /**
     * Date du début du créneau
     */
    private $dateDebutCours;
    /**
     * Date de fin du créneau
     */
    private $dateFinCours;
    /**
     * Nombre de places disponibles pour le créneau
     */
    private $nbPlaces;

    /**
     * Accesseur de $id de Créneau
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Accesseur de $idBassin de Créneau
     * @return int $idBassin
     */
    public function getIdBassin()
    {
        return $this->idBassin;
    }
    /**
     * Mutateur de $idBassin de Créneau
     * @param int $idBassin
     * @return void
     */
    public function setIdBassin($idBassinToSet)
    {
        $this->idBassin = $idBassinToSet;
    }
    /**
     * Accesseur de $dateDebutCours de Créneau
     * @return string $dateDebutCours
     */
    public function getDateDebutCours()
    {
        return $this->dateDebutCours;
    }
    /**
     * Mutateur de $dateDebutCours de Créneau
     * @param string $dateDebutCours
     * @return void
     */
    public function setDateDebutCours($dateDebutCoursToSet)
    {
        $this->dateDebutCours = $dateDebutCoursToSet;
    }
    /**
     * Accesseur de $dateFinCours de Créneau
     * @return string $dateFinCours
     */
    public function getDateFinCours()
    {
        return $this->dateFinCours;
    }
    /**
     * Mutateur de $dateFinCours de Créneau
     * @param string $dateFinCours
     * @return void
     */
    public function setDateFinCours($dateFinCoursToSet)
    {
        $this->dateFinCours = $dateFinCoursToSet;
    }
    /**
     * Accesseur de $nbPlaces de Créneau
     * @return int $nbPlaces
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }
    /**
     * Mutateur de $nbPlaces de Créneau
     * @param int $nbPlaces
     * @return void
     */
    public function setNbPlaces($nbPlacesToSet)
    {
        $this->nbPlaces = $nbPlacesToSet;
    }

        /**
     * Constructeur de la classe Créneau
     * @param int $id
     * @param int $idBassin
     * @param string $dateDebutCours
     * @param string $dateFinCours
     * @param int $nbPlaces
     */
    public function __construct($id, $idBassin, $dateDebutCours, $dateFinCours, $nbPlaces)
    {
        $this->id = $id;
        $this->idBassin = $idBassin;
        $this->dateDebutCours = $dateDebutCours;
        $this->dateFinCours = $dateFinCours;
        $this->nbPlaces = $nbPlaces;
    }
}