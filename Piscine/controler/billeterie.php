<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/FormuleDAO.php');

$listeFormules = FormuleDAO::list();
foreach ($listeFormules as $key => $formule) {
    if (isset($_POST[$formule->getId()]) && $_POST[$formule->getId()] > 0) {
        //echo '<script>console.log('.$formule->getId().' + " formuleat : " +  '.$_POST[$formule->getId()].')</script>';
        if ($_POST[$formule->getId()] != null && $_POST[$formule->getId()] >= 0 ) {
            $_SESSION["Formule".$formule->getId()] = $_POST[$formule->getId()];
            header("Location: /Piscine/boutique");
        }
    } else {
        //echo '<script>console.log("Variable inconnue : " + "'.$formule->getId().'")</script>';
    }
}
foreach ($listeFormules as $key => $formule) {
    $reponse = "0"; //réponse
    if (isset($_POST[$formule->getId()]) != null && $_POST[$formule->getId()] > 0 ) {
        $reponse = $_POST[$formule->getId()];
    } elseif (isset($_SESSION["Formule".$formule->getId()]) &&
    $_SESSION["Formule".$formule->getId()] != null && $_SESSION["Formule".$formule->getId()] > 0) {
        $reponse = $_SESSION["Formule".$formule->getId()];
    }
     echo '<div class="FormPost billetterie-element">
     <p class="Formule">' .$formule->getNom().'</p>
     <input type="number" id="'.$formule->getId().'" name="'.$formule->getId().'" value="'.$reponse.'"  min="0">
     <p>Prix : '.$formule->getPrix().'€</p></div>';
}
