<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/DAOs.php');
$listeFormules = FormuleDAO::list();
$price = 0;
foreach ($listeFormules as $key => $formule) {
    if (isset($_SESSION["Formule".$formule->getId()]) && $_SESSION["Formule".$formule->getId()] > 0) {
        $prixUnitaire = $formule->getPrix() * $_SESSION["Formule".$formule->getId()];
        $price += $prixUnitaire;
    }
}
echo 'Prix total : ' . $price . ' €';
