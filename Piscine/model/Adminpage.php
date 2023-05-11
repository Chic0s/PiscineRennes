<?php
class Adminpage
{
    /**
     * id of the 'Adminpage'
     */
    private $id;
    /**
     * id ot the 'piscine' related to this 'Adminpage'
     */
    private $identifiant;
    /**
     * 'description' of the 'Adminpage'
     */
    private $mdp;

    /**
     * Getter of the 'Adminpage' id attribute
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Getter of the 'Adminpage' idPiscine attribute
     * @return int $idPisicne
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }
    public function setIdentifiant($identifiantToSet)
    {
        $this->identifiant = $identifiantToSet;
    }


    /**
     * Getter of the 'Adminpage' description attribute
     * @return int $description
     */
    public function getMdp()
    {
        return $this->mdp;
    }
    public function setMdp($mdpToSet)
    {
        $this->mdp = $mdpToSet;
    }
    
    /**
     * Constructor of the Adminpage class
     * @param int $id
     * @param int $identifiant
     * @param string $mdp
     */
    public function __construct($id, $identifiant, $mdp)
    {
        $this->id = $id;
        $this->identifiant = $identifiant;
        $this->mdp = $mdp;
    }
}