<?php
/*----------------------Imports----------------------*/

require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/db/CreneauDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/db/BassinDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/db/PiscineDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/CodeDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/VenteDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/ReservationDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/EtatPiscineDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/controler/success.php');

/*----------------------Selection de l'onglet----------------------*/

$selectedTab = 0;

//Les ajouts, motifications et suppressions sont vérifiés à chaque rechargemnt de la
//page d'administration

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
    CreneauDAO::reserver($codeToUse, CreneauDAO::readFromId($_POST['creneau_nouvelleReservation']));
    $selectedTab = 3;
}

//Piscines
if (isset($_POST['ajouterPiscine_nouvellePiscine'])) {
    PiscineDAO::create(new Piscine(
        0,
        $_POST['nom_nouvellePiscine'],
        $_POST['adresse_nouvellePiscine'],
        $_POST['etat_nouvellePiscine'],
        $_POST['srcImage_nouvellePiscine']
        )
    );
    $selectedTab = 4;
}

//Bassins
if (isset($_POST['ajouterBassin_nouveauBassin'])) {
    BassinDAO::create(new Bassin(
        0,
        $_POST['piscine_nouveauBassin'],
        $_POST['description_nouveauBassin']
        )
    );
    $selectedTab = 5;
}

//Formules
if (isset($_POST['ajouterFormule_nouvelleFormule'])) {
    FormuleDAO::create(new Formule(
        0,
        $_POST['nom_nouvelleFormule'],
        $_POST['type_nouvelleFormule'],
        $_POST['prix_nouvelleFormule'],
        '0000-00-00',
        $_POST['description_nouvelleFormule']
        )
    );
    $selectedTab = 6;
}

//Adminpage
if (isset($_POST['ajouterAdminpage_nouveauAdminpage'])) {
    AdminpageDAO::create(new Adminpage(
        0,
        $_POST['identifiant_nouveauAdminpage'],
        $_POST['mdp_nouveauAdminpage']
        )
    );
    $selectedTab = 7;
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
$ventes = VenteDAO::list();
foreach ($ventes as $key => $vente) {
    if (isset($_POST['supprimerVente_' . $vente->getId()])) {
        VenteDAO::supress($vente);
        $selectedTab = 2;
    }
    if (isset($_POST['modifierVente_' . $vente->getId()])) {
        $vente->setDatePeremption(strtotime($_POST['datePeremption_' . $vente->getId()]));
        $vente->setIdFormule($_POST['formule_' . $vente->getId()]);
        VenteDAO::modify($vente);
        $selectedTab = 2;
    }
}

//Reservation
$reservations = ReservationDAO::list();
foreach ($reservations as $key => $reservation) {
    if (isset($_POST['supprimerReservation_' . $reservation->getId()])) {
        ReservationDAO::supress($reservation);
        $selectedTab = 3;
    }
}

//Piscine
$piscines = PiscineDAO::list();
foreach ($piscines as $key => $piscine) {
    if (isset($_POST['supprimerPiscine_' . $piscine->getId()])) {
        PiscineDAO::supress($piscine);
        $selectedTab = 4;
    }
    if (isset($_POST['modifierPiscine_' . $piscine->getId()])) {
        $piscine->setNom($_POST['nom_'.$piscine->getId()]);
        $piscine->setAdresse($_POST['adresse_' . $piscine->getId()]);
        $piscine->setIdEtatPiscine($_POST['etat_' . $piscine->getId()]);
        $piscine->setSrcImage($_POST['srcImage_' . $piscine->getId()]);
        PiscineDAO::modify($piscine);
        $selectedTab = 4;
    }
}

//Bassin
foreach ($piscines as $key => $piscine) {
    $bassins = BassinDAO::listByPiscineId($piscine->getid());
    foreach ($bassins as $key => $bassin) {
        if (isset($_POST['supprimerBassin_' . $bassin->getId()])) {
            BassinDAO::supress($bassin);
            $selectedTab = 5;
        }
        if (isset($_POST['modifierBassin_' . $bassin->getId()])) {
            $bassin->setIdPiscine($_POST['piscine_'.$bassin->getId()]);
            $bassin->setDescription($_POST['description_' . $bassin->getId()]);
            BassinDAO::modify($bassin);
            $selectedTab = 5;
        }
    }
}

//Formule
$formules = FormuleDAO::list();
foreach ($formules as $key => $formule) {
    if (isset($_POST['supprimerFormule_' . $formule->getId()])) {
        FormuleDAO::supress($formule);
        $selectedTab = 6;
    }
    if (isset($_POST['modifierFormule_' . $formule->getId()])) {
        $formule->setNom($_POST['nom_'.$formule->getId()]);
        $formule->setType($_POST['type_' . $formule->getId()]);
        $formule->setPrix($_POST['prix_' . $formule->getId()]);
        $formule->setDescription($_POST['description_' . $formule->getId()]);
        FormuleDAO::modify($formule);
        $selectedTab = 6;
    }
}

//Adminpage
$adminpages = AdminpageDAO::list();
foreach ($adminpages as $key => $adminpage) {
    if (isset($_POST['supprimerAdminpage_' . $adminpage->getId()])) {
        AdminpageDAO::supress($adminpage);
        $selectedTab = 7;
    }
    if (isset($_POST['modifierAdminpage_' . $adminpage->getId()])) {
        $adminpage->setIdentifiant($_POST['identifiant_'.$adminpage->getId()]);
        $adminpage->setMdp($_POST['mdp_' . $adminpage->getId()]);
        AdminpageDAO::modify($adminpage);
        $selectedTab = 7;
    }
}
