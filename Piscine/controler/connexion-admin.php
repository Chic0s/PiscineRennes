<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Piscine/db/AdminpageDAO.php';

if (!isset($_SESSION["authorized"])) {
    $_SESSION["authorized"] = false;
} elseif (!$_SESSION["authorized"] && isset($_POST["identifiant"])) {
    //Si l'utilisateur n'entre pas des identifiants de connexion valides,
    //afficher une erreur
    $_SESSION["showError"] = "<p class='error centrer'>Identifiant ou mot de passe incorrect(s)</p>";
}
//Si un identifiant et un mot de passe ont été entrés et le formualaire validé,
//vérification dans la base de données si ils correspondent à un couple identifiant/mdp
//stocké
if (isset($_POST["identifiant"])) {
    $adminpages=AdminpageDAO::list();
    $successfulAminpage = null;
    if ($adminpages !== null) {
        foreach ($adminpages as $key => $adminpage) {
            if (htmlspecialchars($_POST["identifiant"], ENT_QUOTES) == $adminpage->getIdentifiant() &&
            htmlspecialchars($_POST["mdp"], ENT_QUOTES) == $adminpage->getMdp()) {
                $successfulAminpage = $adminpage;
                $_SESSION["authorized"] = true;
            }
        }
    }

    //Log des connexions et des échecs de connexion
    $fileLocation = "adminFiles/loginLogs.log";
    $statusAuth = "Échec d'authentification";
    
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d H:i:s');
    if ($_SESSION["authorized"]) {
        $statusAuth = "Authentification réussie pour ".$successfulAminpage->getIdentifiant();
    }
    $contentToWrite = "$date - $statusAuth";
    if (file_exists($fileLocation)) {
        file_put_contents($fileLocation, "\n$contentToWrite", FILE_APPEND);
    } else {
        file_put_contents($fileLocation, $contentToWrite);
    }
}