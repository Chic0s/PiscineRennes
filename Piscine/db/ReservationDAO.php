<?php
require_once("DAO.php");
require_once("model/Reservation.php");

class ReservationDAO
{
    public static function readFromId($id)
    {
        $result = DAO::Select('Reservation', array('id' => $id));
        if (is_array($result) && count($result) > 0) {
            $reservation = $result[0];
            return new Reservation(
                $id,
                isset($reservation['id_creneau']) ? $reservation['id_creneau'] : null,
                isset($reservation['heure_res']) ? strtotime($reservation['heure_res']) : null,
                isset($reservation['code']) ? $reservation['code'] : null
            );
        }
        return null;
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
        if (is_array($reservationBD)) {
            foreach ($reservationBD as $key => $reservation) {
                if (is_array($reservation)) {
                    $listReservation[] = new Reservation(
                        isset($reservation['id']) ? $reservation['id'] : null,
                        isset($reservation['id_creneau']) ? $reservation['id_creneau'] : null,
                        isset($reservation['heure_res']) ? strtotime($reservation['heure_res']) : null,
                        isset($reservation['code']) ? $reservation['code'] : null
                    );
                }
            }
        }
        return $listReservation;
    }
}
