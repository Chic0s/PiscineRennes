<?php
class EtatPiscine
{
    /**
     * Identifiant de l'état de la piscine
     */
    private $id;
    /**
     * Label de l'état de la piscine
     */
    private $label;
    
    /**
     * Accesseur de $id de EtatPiscine
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Accesseur de $label de EtatPiscine
     * @return string $label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Constructeur de la classe EtatPiscine
     */
    public function __construct($id, $label)
    {
        $this->id = $id;
        $this->label = $label;
    }
}