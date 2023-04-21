<?php
class Code
{
    private $id;
    private $code;
    private $idVente;
    private $idReservation;

    public function getId()
    {
        return $this->id;
    }
    public function getCode()
    {
        return $this->code;
    }
    public function getIdVente()
    {
        return $this->idVente;
    }
    public function getIdReservation()
    {
        return $this->idReservation;
    }
    public function setIdReservation($idToSet)
    {
        $this->idReservation = $idToSet;
    }
    public function __construct($id, $code, $idVente, $idReservation)
    {
        $this->id = $id;
        $this->code = $code;
        $this->idVente = $idVente;
        $this->idReservation = $idReservation;
    }

}