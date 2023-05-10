<?php
require_once("DAO.php");
require_once("model/Creneau.php");
require_once("VenteDAO.php");
require_once("CodeDAO.php");

class CreneauDAO
{
    public static function readFromId($id)
    {
        $toReturn = null;
        $creneau = DAO::Select('Créneaux', array('id' => $id));
        if (isset($creneau[0])) {
            $creneau = $creneau[0];
            $toReturn = new Creneau(
                $id,
                $creneau['id_bassin'],
                strtotime($creneau['date_debut_cours']),
                strtotime($creneau['date_fin_cours']),
                $creneau['nb_places']
            );
        }
        return $toReturn;
    }
    public static function listByBassinId($idBassin)
    {
        $creneauBD = DAO::Select('Créneaux', array('id_bassin' => $idBassin));
        $listCreneaux =  [];
        foreach ($creneauBD as $key => $creneau) {
            if (isset($creneau)) {
                $listCreneaux[] = new Creneau(
                    $creneau['id'],
                    $creneau['id_bassin'],
                    strtotime($creneau['date_debut_cours']),
                    strtotime($creneau['date_fin_cours']),
                    $creneau['nb_places']
                );
            }
        }
        return $listCreneaux;
    }
    public static function create(Creneau $creneau)
    {
        return DAO::Insert(
            'Créneaux',
            array(
                'id_bassin' => $creneau->getIdBassin(),
                'date_debut_cours' => date("Y-m-d H:i:s", $creneau->getDateDebutCours()),
                'date_fin_cours' => date("Y-m-d H:i:s", $creneau->getDateFinCours()),
                'nb_places' => $creneau->getNbPlaces()
            )
        );
    }
    public static function modify(Creneau $creneau)
    {
        return DAO::Update(
            'Créneaux',
            array(
                'id_bassin' => $creneau->getIdBassin(),
                'date_debut_cours' => date("Y-m-d H:i:s", $creneau->getDateDebutCours()),
                'date_fin_cours' => date("Y-m-d H:i:s", $creneau->getDateFinCours()),
                'nb_places' => $creneau->getNbPlaces()
            ),
            array('id' => $creneau->getId())
        );
    }
    public static function supress(Creneau $creneau)
    {
        return DAO::Delete('Créneaux', array('id' => $creneau->getId()));
    }

    public static function verifyCount(Creneau $creneau)
    {
        $idCreneau = $creneau->getId();
        $statement = ConnexionBD::getInstance()->query(
            "SELECT COUNT(Reservation.id) AS nombre_reservations
        FROM Reservation
        WHERE id = $idCreneau"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC)[0]['nombre_reservations'];
    }
    public static function verificationNombreReservations(Code $code, Creneau $creneau)
    {
        $vente = VenteDAO::readFromId($code->getIdVente());
        $statement = ConnexionBD::getInstance()->prepare(
            "SELECT COUNT(Reservation.id) AS nombre_reservations
        FROM Créneaux
        JOIN Reservation ON Créneaux.id = Reservation.id_creneau
        WHERE Créneaux.id = :idCreneau"
        );
        $statement->execute(array('idCreneau' => $creneau->getId()));
        $post = $statement->fetchAll(PDO::FETCH_ASSOC)[0];
        if ($creneau->getNbPlaces() < ($post['nombre_reservations'] + $vente->getNbCommandes())) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    public static function reserver(Code $code, Creneau $creneau)
    {
        $reservation = new Reservation(1, $creneau->getId(), time(), $code->getCode());
        $code->setIdReservation(ReservationDAO::create($reservation));
        CodeDAO::modify($code);
    }
}
