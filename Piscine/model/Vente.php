<?php
class Vente
{
    private $id;
    private $dateCommande;
    private $datePeremption;
    private $nbCommandes;
    private $idFormule;

    public function getId()
    {
        return $this->id;
    }
    public function getDateCommande()
    {
        return $this->dateCommande;
    }
    public function getDatePeremption()
    {
        return $this->datePeremption;
    }
    public function setDatePeremption($datePeremptionToSet)
    {
        $this->datePeremption = $datePeremptionToSet;
    }
    public function getNbCommandes()
    {
        return $this->nbCommandes;
    }
    public function getIdFormule()
    {
        return $this->idFormule;
    }
    public function setIdFormule($idFormuleToSet)
    {
        $this->idFormule = $idFormuleToSet;
    }

    public function __construct($id, $dateCommande, $datePeremption, $nbCommandes, $idFormule)
    {
        $this->id = $id;
        $this->dateCommande = $dateCommande;
        $this->datePeremption = $datePeremption;
        $this->nbCommandes = $nbCommandes;
        $this->idFormule = $idFormule;
    }
}