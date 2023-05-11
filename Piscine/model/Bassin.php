<?php
class Bassin
{
    /**
     * id of the 'bassin'
     */
    private $id;
    /**
     * id ot the 'piscine' related to this 'bassin'
     */
    private $idPiscine;
    /**
     * 'description' of the 'bassin'
     */
    private $description;

    /**
     * Getter of the 'bassin' id attribute
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Getter of the 'bassin' idPiscine attribute
     * @return int $idPisicne
     */
    public function getIdPiscine()
    {
        return $this->idPiscine;
    }
    public function setIdPiscine($idPiscineToSet)
    {
        $this->idPiscine = $idPiscineToSet;
    }
    /**
     * Getter of the 'bassin' description attribute
     * @return int $description
     */
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($descriptionToSet)
    {
        $this->description = $descriptionToSet;
    }

    /**
     * Constructor of the Bassin class
     * @param int $id
     * @param int $idPiscine
     * @param string $description
     */
    public function __construct($id, $idPiscine, $description)
    {
        $this->id = $id;
        $this->idPiscine = $idPiscine;
        $this->description = $description;
    }
}