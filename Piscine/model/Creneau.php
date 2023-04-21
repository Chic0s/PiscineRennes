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
    public function getDateDebutCours()
    {
        return $this->dateDebutCours;
    }
    public function getDateFinCours()
    {
        return $this->dateFinCours;
    }
    public function getNbPlaces()
    {
        return $this->nbPlaces;
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