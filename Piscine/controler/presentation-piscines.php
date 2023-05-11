<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/PiscineDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/BassinDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/EtatPiscineDAO.php';

$listePiscines = PiscineDAO::list();
foreach ($listePiscines as $key => $piscine) {
    $etatPiscine = EtatPiscineDAO::readFromId($piscine->getIdEtatPiscine());
    switch ($etatPiscine->getId()) {
        case 2:
            $couleurEtat = 'style="background-color: rgb(207, 180, 0); color: white;"';
            break;
        case 3:
            $couleurEtat = 'style="background-color: red; color: white;"';
            break;
        case 4:
            $couleurEtat = 'style="background-color: rgb(183, 183, 183); color: white;"';
            break;
        default:
            $couleurEtat = 'style="background-color: green; color: white;"';
            break;
    }
    $listeBassins = BassinDAO::listByPiscineId($piscine->getId());
    echo '<div class = "piscine">
    <p class=piscineNom>'.$piscine->getNom().'</p>
    <p>Adresse : '.$piscine->getAdresse().'</p>
    <p>État de service : <span '.$couleurEtat.'>'.$etatPiscine->getLabel().'</span></p>
    <img src='.$piscine->getSrcImage().' alt="Photo de la piscine '.$piscine->getNom().'" width=300>
    <p>Bassin(s) :</p>';
foreach ($listeBassins as $key => $bassin) {
echo '<div class = "bassin">
<p>- '.$bassin->getDescription().'</p>
</div>';
}
echo '</div>';
}