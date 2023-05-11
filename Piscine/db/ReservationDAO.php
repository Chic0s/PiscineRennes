<?php
require_once("DAO.php");
require_once("model/Reservation.php");

class ReservationDAO
{
    public static function readFromId($id)
    {
        $reservation = DAO::Select('Reservation', array('id' => $id))[0];
        return new Reservation(
            $id,
            $reservation['id_creneau'],
            strtotime($reservation['heure_res']),
            $reservation['code']
        );
    }
    public static function listByCreneauId($idCreneau)
    {
        $reservationBD = DAO::Select('Reservation', array('id_creneau' => $idCreneau));
        $listReservation =  [];
        foreach ($reservationBD as $key => $reservation) {
            $listReservation[] = new Reservation(
                $reservation['id'],
                $reservation['id_creneau'],
                strtotime($reservation['heure_res']),
                $reservation['code']
            );
        }
        return $listReservation;
    }
    public static function create(Reservation $reservation)
    {   
        return DAO::Insert(
            'Reservation',
            array(
                'id_creneau' => $reservation->getIdCreneau(),
                'heure_res' => date("Y-m-d H:i:s", $reservation->getHeureRes()),
                'code' => $reservation->getCode()
            )
        );
    }
    public static function supress(Reservation $reservation)
    {
        $code = CodeDAO::readFromCode($reservation->getCode());
        $code->setIdReservation(null);
        CodeDAO::modify($code);
        return DAO::Delete('Reservation', array('id' => $reservation->getId()));
    }
    public static function list()
    {
        $reservationBD = DAO::Select('Reservation');
        $listReservation =  [];
        foreach ($reservationBD as $key => $reservation) {
            $listReservation[] = new Reservation(
                $reservation['id'],
                $reservation['id_creneau'],
                strtotime($reservation['heure_res']),
                $reservation['code']
            );
        }
        return $listReservation;
    }
}
