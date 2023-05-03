<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/DAOs.php');

$listeFormules = FormuleDAO::list();
foreach ($listeFormules as $key => $formule)  {
    if (isset($_POST[$formule->getId()."-"])) {
        if ($_SESSION["Formule".$formule->getId()] > 0) {
            $_SESSION["Formule".$formule->getId()] = $_SESSION["Formule".$formule->getId()] - 1;
        } else {
            echo '<script>alert("Il n\'est pas possible de descendre en dessous de 0")</script>';
        }
    } if (isset($_POST[$formule->getId()."+"])) {
        $_SESSION["Formule".$formule->getId()] = $_SESSION["Formule".$formule->getId()] + 1;
    }

    if (isset($_SESSION["Formule".$formule->getId()])) {
        $countTicket = $_SESSION["Formule".$formule->getId()];
        if ($_SESSION["Formule".$formule->getId()] >= 0){
            $prix = $countTicket * $formule->getPrix();
            echo '<div class ="BoutiqueBox"><input value="'.
            $countTicket.'" min="0"> : '.$formule->getNom().', PRIX : '.$prix.'€';
            echo '<form method="post"><input  class="BoutiqueButton"
 type="submit" name="'.$formule->getId().'+'.'" id="ajouter" value="ajouter" />';
            echo '<form method="post"><input  class="BoutiqueButton"
 type="submit" name="'.$formule->getId().'-'.'" id="retirer" value="retirer" />';
            echo '</div></br>';
        }
    }
}

echo'<a class="PaiementButton" href="/Piscine/paiement">Procéder au paiement</a>';
