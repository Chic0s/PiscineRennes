<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/DAOs.php';
$listePiscines = PiscineDAO::list();
foreach ($listePiscines as $key => $piscine) {
    $listeBassins = BassinDAO::listByPiscineId($piscine->getId());
    echo '<div class = "piscine">
    <p class=piscineNom>'.$piscine->getNom().'</p>
    <p>Adresse : '.$piscine->getAdresse().'</p>
    <p>État de service : '.EtatPiscineDAO::readFromId($piscine->getIdEtatPiscine())->getLabel().'</p>
    <img src='.$piscine->getSrcImage().' alt="Photo de la piscine '.$piscine->getNom().'" width=300>
    <p>Bassins :</p>';
foreach ($listeBassins as $key => $bassin) {
echo '<div class = "bassin">
<p>- '.$bassin->getDescription().'</p>
</div>';
}
echo '</div>';
}