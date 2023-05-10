<?php
class Creneau
{
    private $id;
    private $idBassin;
    private $dateDebutCours;
    private $dateFinCours;
    private $nbPlaces;

    public function getId()
    {
        return $this->id;
    }
    public function getIdBassin()
    {
        return $this->idBassin;
    }
    public function setIdBassin($idBassinToSet)
    {
        $this->idBassin = $idBassinToSet;
    }
    public function getDateDebutCours()
    {
        return $this->dateDebutCours;
    }
    public function setDateDebutCours($dateDebutCoursToSet)
    {
        $this->dateDebutCours = $dateDebutCoursToSet;
    }
    public function getDateFinCours()
    {
        return $this->dateFinCours;
    }
    public function setDateFinCours($dateFinCoursToSet)
    {
        $this->dateFinCours = $dateFinCoursToSet;
    }
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }
    public function setNbPlaces($nbPlacesToSet)
    {
        $this->nbPlaces = $nbPlacesToSet;
    }

    public function __construct($id, $idBassin, $dateDebutCours, $dateFinCours, $nbPlaces)
    {
        $this->id = $id;
        $this->idBassin = $idBassin;
        $this->dateDebutCours = $dateDebutCours;
        $this->dateFinCours = $dateFinCours;
        $this->nbPlaces = $nbPlaces;
    }
}