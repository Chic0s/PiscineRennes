<?php
class Adminpage
{
    /**
     * Id des identifiants de connexion à la page admin
     */
    private $id;
    /**
     * Identifiant de connexion à la page admin
     */
    private $identifiant;
    /**
     * Mot de passe de connexion à la page admin
     */
    private $mdp;

    /**
     * Accesseur de $id d'Adminpage
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Accesseur de $identifiant d'Adminpage
     * @return string $identifiant
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }
    /**
     * Mutateur de $identifiant d'Adminpage
     * @return void
     */
    public function setIdentifiant($identifiantToSet)
    {
        $this->identifiant = $identifiantToSet;
    }


    /**
     * Accesseur de $mdp d'Adminpage
     * @return string $mdp
     */
    public function getMdp()
    {
        return $this->mdp;
    }
    /**
     * Mutateur de $mdp d'Adminpage
     * @return void
     */
    public function setMdp($mdpToSet)
    {
        $this->mdp = $mdpToSet;
    }
    
    /**
     * Constructreur de la classe Adminpage
     */
    public function __construct($id, $identifiant, $mdp)
    {
        $this->id = $id;
        $this->identifiant = $identifiant;
        $this->mdp = $mdp;
    }
}