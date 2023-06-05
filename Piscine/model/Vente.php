<?php
class Vente
{
    /**
     * Identifiant de la vente
     */
    private $id;
    /**
     * Date de la vente
     */
    private $dateCommande;
    /**
     * Date de péremption des codes vendus
     */
    private $datePeremption;
    /**
     * Nombre de places attribuées aux codes vendus
     */
    private $nbCommandes;
    /**
     * Identifiant de la formule correspondant aux codes vendus
     */
    private $idFormule;

    /**
     * Accesseur de $id de Vente
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Accesseur de $dateCommande de Vente
     * @return string $dateCommande
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }
    /**
     * Accesseur de $datePeremption de Vente
     * @return string $datePeremption
     */
    public function getDatePeremption()
    {
        return $this->datePeremption;
    }
    /**
     * Mutateur de $datePeremption de Vente
     * @return void
     */
    public function setDatePeremption($datePeremptionToSet)
    {
        $this->datePeremption = $datePeremptionToSet;
    }
    /**
     * Accesseur de $nbCommandes de Vente
     * @return int $nbCommandes
     */
    public function getNbCommandes()
    {
        return $this->nbCommandes;
    }
    /**
     * Accesseur de $idFormule de Vente
     * @return int $idFormule
     */
    public function getIdFormule()
    {
        return $this->idFormule;
    }
    /**
     * Mutateur de $idFormule de Vente
     * @return void
     */
    public function setIdFormule($idFormuleToSet)
    {
        $this->idFormule = $idFormuleToSet;
    }

    /**
     * Constructeur de la classe Vente
     */
    public function __construct($id, $dateCommande, $datePeremption, $nbCommandes, $idFormule)
    {
        $this->id = $id;
        $this->dateCommande = $dateCommande;
        $this->datePeremption = $datePeremption;
        $this->nbCommandes = $nbCommandes;
        $this->idFormule = $idFormule;
    }
}