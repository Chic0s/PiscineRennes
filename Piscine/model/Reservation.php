<?php
class Reservation
{
    /**
     * Identifiant de la réservation
     */
    private $id;
    /**
     * Identifiant du créneau de la réservation
     */
    private $idCreneau;
    /**
     * Heure de réservation du créneau
     */
    private $heureRes;
    /**
     * Code utilisé pour la réservation du créneau
     */
    private $code;

    /**
     * Accesseur de $id de Reservation
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Accesseur de $idCreneau de Reservation
     * @return int $idCreneau
     */
    public function getIdCreneau()
    {
        return $this->idCreneau;
    }
    /**
     * Accesseur de $heureRes de Reservation
     * @return string $heureRes
     */
    public function getHeureRes()
    {
        return $this->heureRes;
    }
    /**
     * Accesseur de $code de Reservation
     * @return string $code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Constructeur de la classe Reservation
     */
    public function __construct($id, $idCreneau, $heureRes, $code)
    {
        $this->id = $id;
        $this->idCreneau = $idCreneau;
        $this->heureRes = $heureRes;
        $this->code = $code;
    }
}
