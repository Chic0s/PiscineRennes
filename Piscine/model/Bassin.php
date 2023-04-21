<?php
class Bassin
{
    private $id;
    private $idPiscine;
    private $description;

    public function getId()
    {
        return $this->id;
    }
    public function getIdPiscine()
    {
        return $this->idPiscine;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function __construct($id, $idPiscine, $description)
    {
        $this->id = $id;
        $this->idPiscine = $idPiscine;
        $this->description = $description;
    }
}