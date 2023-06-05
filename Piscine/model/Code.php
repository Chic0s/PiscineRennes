<?php

class Code
{
    /**
     * Identifiant du code
     */
    private $id;
    /**
     * Code sur 9 caractères
     */
    private $code;
    /**
     * Identifiant de la vente liée au code
     */
    private $idVente;
    /**
     * Identifiant de la réservation liée au code
     */
    private $idReservation;
    
    /**
     * Accesseur de $id de Code
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Accesseur de $code de Code
     * @return string $code
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * Accesseur de $idVente de Code
     * @return int $idVente
     */
    public function getIdVente()
    {
        return $this->idVente;
    }
    /**
     * Accesseur de $idReservation de Code
     * @return int $idReservation
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }
    /**
     * Mutateur de $idReservation de Code
     * @return void
     */
    public function setIdReservation($idToSet)
    {
        if ($idToSet == "unset") {
            $this->idReservation = null;
        } else {
            $this->idReservation = $idToSet;
        }
    }

    /**
     * Constructeur de la classe Code
     */
    public function __construct($id, $code, $idVente, $idReservation)
    {
        $this->id = $id;
        $this->code = $code;
        $this->idVente = $idVente;
        $this->idReservation = $idReservation;
    }

}