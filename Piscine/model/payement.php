<?php
function globalPrice()
{
    require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/model/DAOs.php');
    $listeFormules = FormuleDAO::list();
    $rep = 0;
    foreach ($listeFormules as $key => $formule) {
        if (isset($_SESSION["Formule".$formule->getId()]) && $_SESSION["Formule".$formule->getId()] > 0) {
            $prixUnitaire = $formule->getPrix() * $_SESSION["Formule".$formule->getId()];
            $rep += $prixUnitaire;
        }
    }
    return $rep;
}