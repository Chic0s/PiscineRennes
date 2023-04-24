<?php
//Import des classes nécessaires
require_once("ConnexionBD.php");
require_once("Formule.php");
require_once("Piscine.php");
require_once("Bassin.php");
require_once("Code.php");
require_once("Creneau.php");
require_once("EtatPiscine.php");
require_once("Reservation.php");
require_once("Vente.php");

class DAO
{
    // INSERT
    public static function Insert($tableName, $data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        $fieldNames = implode(", ", $keys);
        $fieldValues = implode(", ", array_fill(0, count($values), "?"));

        $statement = ConnexionBD::getInstance()->prepare(
            "INSERT INTO $tableName ($fieldNames )
        VALUES ($fieldValues)"
        );
        $statement->execute($values);
        $statement2 = ConnexionBD::getInstance()->prepare("SELECT MAX(id) FROM $tableName");
        $statement2->execute();
        return $statement2->fetchAll(PDO::FETCH_ASSOC)[0]['MAX(id)'];
    }

    // SELECT
    public static function Select($tableName, $conditions = array())
    {
        $query = "SELECT * FROM " . $tableName;

        if (!empty($conditions)) {
            $where = array();
            foreach ($conditions as $key => $value) {
                $where[] = "$key = :$key";
            }
            $query .= " WHERE " . implode(" AND ", $where);
        }
        $statement = ConnexionBD::getInstance()->prepare($query);
        $statement->execute($conditions);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public static function Update($tableName, $data, $conditions)
    {
        $set = array();
        $values = array();
        foreach ($data as $key => $value) {
            $set[] = "$key = ?";
            $values[] = $value;
        }
        $where = array();
        foreach ($conditions as $key => $value) {
            $where[] = "$key = ?";
            $values[] = $value;
        }
        $statement = ConnexionBD::getInstance()->prepare("UPDATE " . $tableName .
            " SET " . implode(", ", $set) . " WHERE " . implode(" AND ", $where));
        $statement->execute($values);
        return $statement->rowCount();
    }

    // DELETE
    public static function Delete($tableName, $conditions)
    {
        $where = array();
        $values = array();
        foreach ($conditions as $key => $value) {
            $where[] = "$key = ?";
            $values[] = $value;
        }

        $query = "DELETE FROM " . $tableName . " WHERE " . implode(" AND ", $where);

        $stmt = ConnexionBD::getInstance()->prepare($query);
        $stmt->execute($values);

        return $stmt->rowCount();
    }
}

class PiscineDAO extends DAO
{
    public static function readFromId($id)
    {
        $toReturn = null;
        $piscine = parent::Select('Piscine', array('id' => $id));
        if (isset($piscine[0])) {
            $piscine = $piscine[0];
            $toReturn = new Piscine(
                $id,
                $piscine['nom'],
                $piscine['adresse'],
                $piscine['id_etat_piscine'],
                $piscine['src_image']
            );
        }
        return $toReturn;
    }
    public static function list()
    {
        $piscinesBD = parent::Select('Piscine');
        $listPiscines = [];
        foreach ($piscinesBD as $key => $piscine) {
            if (isset($piscine)) {
                $listPiscines[] = new Piscine(
                    $piscine['id'],
                    $piscine['nom'],
                    $piscine['adresse'],
                    $piscine['id_etat_piscine'],
                    $piscine['src_image']
                );
            }
        }
        return $listPiscines;
    }
    public static function create(Piscine $piscine)
    {
        return parent::Insert(
            'Piscine',
            array(
                'nom' => $piscine->getNom(),
                'adresse' => $piscine->getAdresse(),
                'id_etat_piscine' => $piscine->getIdEtatPiscine(),
                'src_image' => $piscine->getSrcImage()
            )
        );
    }
    public static function modify(Piscine $piscine)
    {
        return parent::Update(
            'Piscine',
            array(
                'nom' => $piscine->getNom(),
                'adresse' => $piscine->getAdresse(),
                'id_etat_piscine' => $piscine->getIdEtatPiscine(),
                'src_image' => $piscine->getSrcImage()
            ),
            array('id' => $piscine->getId())
        );
    }
    public static function supress(Piscine $piscine)
    {
        $listBassins = BassinDAO::listByPiscineId($piscine->getId());
        $suppressedBassins = [];
        foreach ($listBassins as $key => $bassin) {
            $suppressedBassins[] = BassinDAO::supress($bassin);
        }
        return array(
            parent::Delete('piscine', array('id' => $piscine->getId())),
            $suppressedBassins
        );
    }
}

class BassinDAO extends DAO
{
    public static function readFromId($id)
    {
        $toReturn = null;
        $bassinInfos = parent::Select('Bassin', array('id' => $id));
        if (isset($bassinInfos[0])) {
            $bassinInfos = $bassinInfos[0];
            $toReturn = new Bassin(
                $id,
                $bassinInfos['id_piscine'],
                $bassinInfos['description']
            );
        }
        return $toReturn;
    }
    public static function listByPiscineId($idPiscine)
    {
        $bassinsBD = parent::Select('Bassin', array('id_piscine' => $idPiscine));
        $listBassins =  [];
        foreach ($bassinsBD as $key => $bassin) {
            if (isset($bassin)) {
                $listBassins[] = new Bassin(
                    $bassin['id'],
                    $bassin['id_piscine'],
                    $bassin['description']
                );
            }
        }
        return $listBassins;
    }
    public static function create(Bassin $bassin)
    {
        return parent::Insert(
            'Bassin',
            array(
                'id_piscine' => $bassin->getIdPiscine(),
                'description' => $bassin->getDescription()
            )
        );
    }
    public static function modify(Bassin $bassin)
    {
        return parent::Update(
            'Bassin',
            array(
                'id_piscine' => $bassin->getIdPiscine(),
                'description' => $bassin->getDescription()
            ),
            array('id' => $bassin->getId())
        );
    }
    public static function supress(Bassin $bassin)
    {
        $listCreneaux = CreneauDAO::listByBassinId($bassin->getId());
        $suppressedCreneaux = [];
        foreach ($listCreneaux as $key => $creneau) {
            $suppressedCreneaux[] = CreneauDAO::supress($creneau);
        }
        return array(
            parent::Delete('Bassin', array('id' => $bassin->getId())),
            $suppressedCreneaux
        );
    }
}

class CreneauDAO extends DAO
{
    public static function readFromId($id)
    {
        $toReturn = null;
        $creneau = parent::Select('Créneaux', array('id' => $id));
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
        $creneauBD = parent::Select('Créneaux', array('id_bassin' => $idBassin));
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
        return parent::Insert(
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
        return parent::Update(
            'Créneaux',
            array(
                'id_bassin' => $creneau->getIdBassin(),
                'date_debut_cours' => date("Y-m-d H:i:s", $creneau->getDateDebutCours()),
                'date_fin_cours' => date("Y-m-d H:i:s", $creneau->getDateFinCours()),
                'nb_places' => $creneau->getNbPlaces()
            ),
            'id = ' . $creneau->getId()
        );
    }
    public static function supress(Creneau $creneau)
    {
        return parent::Delete('Creneau', array('id' => $creneau->getId()));
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
        return $statement->fetchAll(PDO::FETCH_ASSOC);
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

class CodeDAO extends DAO
{
    public static function readFromId($id)
    {
        $toReturn = null;
        $code = parent::Select('Code', array('id' => $id));
        if (isset($code[0])) {
            $code = $code[0];
            $toReturn = new Code(
                $id,
                $code['code'],
                $code['id_vente'],
                $code['id_reservation']
            );
        }
        return $toReturn;
    }
    public static function readFromCode($codeTXT)
    {
        $toReturn = null;
        $code = parent::Select('Code', array('code' => $codeTXT));
        if (isset($code[0])) {
            $code = $code[0];
            $toReturn = new Code(
                $code['id'],
                $codeTXT,
                $code['id_vente'],
                $code['id_reservation']
            );
        }
        return $toReturn;
    }
    public static function create(Code $code)
    {
        return parent::Insert(
            'Code',
            array(
                'code' => $code->getCode(),
                'id_vente' => $code->getIdVente(),
                'id_reservation' => $code->getIdReservation()
            )
        );
    }
    public static function modify(Code $code)
    {
        return parent::Update(
            'Code',
            array(
                'code' => $code->getCode(),
                'id_vente' => $code->getIdVente(),
                'id_reservation' => $code->getIdReservation()
            ),
            array('id' => $code->getId())
        );
    }
    public static function supress(Code $code)
    {
        return parent::Delete('Code', array('id' => $code->getId()));
    }
    public static function verify(Code $code)
    {
        $codeObj = CodeDAO::readFromCode($code->getCode());
        if (null !== $codeObj) {
            if ($codeObj->getIdReservation() != null) {
                $reservation = ReservationDAO::readFromId($codeObj->getIdReservation());
            }
            if ($codeObj->getIdVente() != null) {
                $vente = VenteDAO::readFromId($codeObj->getIdVente());
            }
        }
        if (null !== $codeObj && isset($vente)) {
            if (time() >= $vente->getDatePeremption() + 86400) {
                //Code expiré
                $result = 1;
            } elseif (isset($reservation)) {
                //Code déjà utilisé
                $result = 2;
            } else {
                //Code valide
                $result = 0;
            }
        } else {
            //Le code n'existe pas
            $result = 3;
        }
        return $result;
    }
    public static function checkDuplicate(Code $codeGenere) {
        return parent::Select('Code', array('code' => $codeGenere->getCode()));
    }
}

class VenteDAO extends DAO
{
    public static function readFromId($id)
    {
        $vente = parent::Select('Ventes', array('id' => $id))[0];
        return new Vente(
            $id,
            strtotime($vente['date_commande']),
            strtotime($vente['date_peremption']),
            $vente['nb_commandes'],
            $vente['id_formule']
        );
    }
    public static function create(Vente $vente)
    {
        return parent::Insert(
            'Ventes',
            array(
                'date_commande' => date("Y-m-d H:i:s", $vente->getDateCommande()),
                'date_peremption' => date("Y-m-d H:i:s", $vente->getDatePeremption()),
                'nb_commandes' => $vente->getNbCommandes(),
                'id_formule' => $vente->getIdFormule()
            )
        );
    }
    public static function supress(Vente $vente)
    {
        return parent::Delete('Vente', array('id' => $vente->getId()));
    }
}

class ReservationDAO extends DAO
{
    public static function readFromId($id)
    {
        $reservation = parent::Select('Reservation', array('id' => $id))[0];
        return new Reservation(
            $id,
            $reservation['id_creneau'],
            strtotime($reservation['heure_res']),
            $reservation['code']
        );
    }
    public static function listByCreneauId($idCreneau)
    {
        $reservationBD = parent::Select('Resevation', array('id_creneau' => $idCreneau));
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
        return parent::Insert(
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
        return parent::Delete('Reservation', array('id' => $reservation->getId()));
    }
}

class FormuleDAO extends DAO
{
    public static function readFromId($id)
    {
        $formule = parent::Select('Formule', array('id' => $id))[0];
        return new Formule(
            $id,
            $formule['nom'],
            $formule['type'],
            $formule['prix'],
            $formule['periode_validite'],
            $formule['description']
        );
    }
    public static function list()
    {
        $formulesBD = parent::Select('Formule');
        $listFromules = [];
        foreach ($formulesBD as $key => $formule) {
            $listFromules[] = new Formule(
                $formule['id'],
                $formule['nom'],
                $formule['type'],
                $formule['prix'],
                $formule['periode_validite'],
                $formule['description']
            );
        }
        return $listFromules;
    }
    public static function create(Formule $formule)
    {
        return parent::Insert(
            'Formule',
            array(
                'nom' => $formule->getNom(),
                'type' => $formule->getType(),
                'prix' => $formule->getPrix(),
                'periode_validite' => $formule->getPeriodeValidite(),
                'description' => $formule->getDescription()
            )
        );
    }
    public static function modify(Formule $formule)
    {
        return parent::Update(
            'Formule',
            array(
                'nom' => $formule->getNom(),
                'type' => $formule->getType(),
                'prix' => $formule->getPrix(),
                'periode_validite' => $formule->getPeriodeValidite(),
                'description' => $formule->getDescription()
            ),
            array('id' => $formule->getId())
        );
    }
    public static function supress(Formule $formule)
    {
        return parent::Delete('Formule', array('id' => $formule->getId()));
    }
}

class EtatPiscineDAO extends DAO
{
    public static function readFromId($id)
    {
        $etatPiscine = parent::Select('Etat_piscine', array('id' => $id))[0];
        return new EtatPiscine(
            $id,
            $etatPiscine['label']
        );
    }
    public static function list()
    {
        $etatPiscineBD = parent::Select('Etat_piscine');
        $listEtatsPiscine = [];
        foreach ($etatPiscineBD as $key => $etatPiscine) {
            $listEtatsPiscine[] = new EtatPiscine(
                $etatPiscine['id'],
                $etatPiscine['label']
            );
        }
        return $listEtatsPiscine;
    }
}
