<?php
class Bassin
{
    /**
     * Identifiant du bassin
     */
    private $id;
    /**
     * Identifiant de la piscine dont dépends le bassin
     */
    private $idPiscine;
    /**
     * Description du bassin
     */
    private $description;

    /**
     * Accesseur de $id de Bassin
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Accesseur de $idPiscine de Bassin
     * @return int $idPiscine
     */
    public function getIdPiscine()
    {
        return $this->idPiscine;
    }
    /**
     * Mutateur de $idPiscine de Bassin
     * @param string $idPiscine
     * @return void
     */
    public function setIdPiscine($idPiscineToSet)
    {
        $this->idPiscine = $idPiscineToSet;
    }
    /**
     * Accesseur de $description de Bassin
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Mutateur de $description de Bassin
     * @param string $description
     * @return void
     */
    public function setDescription($descriptionToSet)
    {
        $this->description = $descriptionToSet;
    }

    /**
     * Constructeur de la classe Bassin
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