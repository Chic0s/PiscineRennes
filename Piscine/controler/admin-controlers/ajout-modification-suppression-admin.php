<?php
/*----------------------Imports----------------------*/

require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/db/CreneauDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/db/BassinDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/db/PiscineDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/CodeDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/VenteDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/ReservationDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/success.php');

/*----------------------Selection de l'onglet----------------------*/

$selectedTab = 0;

/*----------------------Ajouts----------------------*/

//Créneau
if (isset($_POST['ajouterCreneau_nouveauCreneau'])) {
    CreneauDAO::create(new Creneau(
        0,
        $_POST['bassin_nouveauCreneau'],
        strtotime($_POST['debutCreneau_nouveauCreneau']),
        strtotime($_POST['finCreneau_nouveauCreneau']),
        $_POST['nbPlaces_nouveauCreneau']));
        $selectedTab = 0;
}

//Code
if (isset($_POST['ajouterCode_nouveauCode'])) {
    //Créer une vente
    $idVente = VenteDAO::create(
        new Vente(
            null,
            time(),
            strtotime($_POST['datePeremption_nouveauCode']),
            1,
            $_POST['formule_nouveauCode']
        )
    );
    //Créer les codes
    for ($i = 0; $i < $_POST['nbCodes_nouveauCode']; $i++) {
        do {
            $code = new Code(null, generateCode(), $idVente, null);
        } while (null === CodeDAO::checkDuplicate($code));
        CodeDAO::create($code);
    }
    $selectedTab = 1;
}

//Réservations
if (isset($_POST['ajouterReservation_nouvelleReservation'])) {
    $codeToUse = CodeDAO::readFromId($_POST['code_nouvelleReservation']);
    $reservationToUse = new Reservation(
        null,
        $_POST['creneau_nouvelleReservation'],
        time(),
        $codeToUse->getCode()
        );
    $idReservation = ReservationDAO::create($reservationToUse);
    $codeToUse->setIdReservation($idReservation);
    CodeDAO::modify($codeToUse);
    $selectedTab = 3;
}

/*----------------------Modification/suppression----------------------*/

//Créneau
$piscines = PiscineDAO::list();
foreach ($piscines as $key => $piscine) {
    $bassins = BassinDAO::listByPiscineId($piscine->getId());
    foreach ($bassins as $key => $bassin) {
        $creneaux = CreneauDAO::listByBassinId($bassin->getId());
        foreach ($creneaux as $key => $creneau) {
            if (isset($_POST['supprimerCreneau_'.$creneau->getId()])) {
                //Supprimer les réservations rattachées à ce créneau
                CreneauDAO::supress($creneau);
                $selectedTab = 0;
            }
            if (isset($_POST['modifierCreneau_'.$creneau->getId()])) {
                $creneau->setDateDebutCours(strtotime($_POST['debutCreneau_'.$creneau->getId()]));
                $creneau->setDateFInCours(strtotime($_POST['finCreneau_'.$creneau->getId()]));
                $creneau->setNbPlaces($_POST['nbPlaces_'.$creneau->getId()]);
                CreneauDAO::modify($creneau);
                $selectedTab = 0;
            }
        }
    }
}

//Code
$codes = CodeDAO::list();
foreach ($codes as $key => $code) {
    $vente = VenteDAO::readFromId($code->getIdVente());
    if (isset($_POST['supprimerCode_' . $code->getId()])) {
        CodeDAO::supress($code);
        if (null !== $code->getIdReservation()) {
            ReservationDAO::supress(ReservationDAO::readFromId($code->getIdReservation()));
        }
        $selectedTab = 1;
    }
    if (isset($_POST['modifierCode_' . $code->getId()])) {
        $vente->setDatePeremption(strtotime($_POST['datePeremption_' . $code->getId()]));
        $vente->setIdFormule($_POST['formule_' . $code->getId()]);
        VenteDAO::modify($vente);
        $selectedTab = 1;
    }
}

//Vente
if (isset($_POST['supprimerVente_' . $vente->getId()])) {
    $codes = CodeDAO::listByVenteId($vente->getId());
    foreach ($codes as $key => $code) {
        CodeDAO::supress($code);
        if (null !== $code->getIdReservation()) {
            require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/ReservationDAO.php');
            ReservationDAO::supress(ReservationDAO::readFromId($code->getIdReservation()));
        }
    }
    VenteDAO::supress($vente);
    $selectedTab = 2;
}
if (isset($_POST['modifierVente_' . $vente->getId()])) {
    $vente->setDatePeremption(strtotime($_POST['datePeremption_' . $vente->getId()]));
    $vente->setIdFormule($_POST['formule_' . $vente->getId()]);
    VenteDAO::modify($vente);
    $selectedTab = 2;
}

//Reservation
$reservations = ReservationDAO::list();
foreach ($reservations as $key => $reservation) {
    if (isset($_POST['supprimerReservation_' . $reservation->getId()])) {
        $code = CodeDAO::readFromCode($reservation->getCode());
        var_dump($code);
        $code->setIdReservation(null);
        CodeDAO::modify($code);
        ReservationDAO::supress($reservation);
        $selectedTab = 3;
    }
}