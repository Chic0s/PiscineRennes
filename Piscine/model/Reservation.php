<?php
class Reservation
{
    private $id;
    private $idCreneau;
    private $heureRes;
    private $code;

    public function getId()
    {
        return $this->id;
    }
    public function getIdCreneau()
    {
        return $this->idCreneau;
    }
    public function getHeureRes()
    {
        return $this->heureRes;
    }
    public function getCode()
    {
        return $this->code;
    }

    public function __construct($id, $idCreneau, $heureRes, $code)
    {
        $this->id = $id;
        $this->idCreneau = $idCreneau;
        $this->heureRes = $heureRes;
        $this->code = $code;
    }
}
