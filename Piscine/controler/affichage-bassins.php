<?php
/**
 * Get the necessary functiosn and DAOs from the dedicated files
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/db/BassinDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/db/CreneauDAO.php');
/**
 * All days of the week in a single array to allow the translation and a clean display of the slots
 */
$semaine = array(" Dimanche "," Lundi "," Mardi "," Mercredi "," Jeudi ",
" vendredi "," samedi ");
/**
 * All mounths in a single array to allow the translation and a clean display of the slots
 */
$mois = array(1=>" janvier "," février "," mars "," avril "," mai "," juin ",
" juillet "," août "," septembre "," octobre "," novembre "," décembre ");
foreach (BassinDAO::listByPiscineId(htmlspecialchars($_GET['piscine'])) as $bassin) {
    echo '<button type="button" class="collapsible-bassin"><h2>' . $bassin->getDescription() . '</h2></button>';
    echo '<div class="collapsible-contenu">';
    foreach (CreneauDAO::listByBassinId($bassin->getId()) as $creneau) {
        $disponible = "disabled";
        if ((int)CreneauDAO::verifyCount($creneau) < $creneau->getNbPlaces()) {
            $disponible = "class=\"creneau-disponible\"";
        }
        echo '<button name="creneau" value="' .$creneau->getId() . '" ' . $disponible .
            '><span class="creneau-corps">' .
        $semaine[date('w', $creneau->getDateFinCours())].
        date(' d ', $creneau->getDateDebutCours()) .
        $mois[date('n', $creneau->getDateFinCours())] .
        date(' \\d\\e G\\hi', $creneau->getDateDebutCours()) .
        ' à ' . date('G\\hi', $creneau->getDateFinCours()) .
        '</span><span class="epuise"> - Epuisé</span></button><br>';
    }
    echo '</div>';
}