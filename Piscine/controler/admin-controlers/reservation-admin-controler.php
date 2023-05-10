<?php
$piscines = PiscineDAO::list();
foreach ($piscines as $key => $piscine) {
    $bassins = BassinDAO::listByPiscineId($piscine->getId());
    foreach ($bassins as $key => $bassin) {
        $creneaux = CreneauDAO::listByBassinId($bassin->getId());
        foreach ($creneaux as $key => $creneau) {
            if (null !== ReservationDAO::listByCreneauId($creneau->getId())) {
                $reservations = ReservationDAO::listByCreneauId($creneau->getId());
                foreach ($reservations as $key => $reservation) {
                    echo '<tr>
                    <td>' . $reservation->getId() . '</td>
                    <td>Bassin ' . $bassin->getDescription() . ' - Piscine ' . $piscine->getNom() .
                    ' - ' . date("Y-m-d H:i", $creneau->getDateDebutCours()).'</td>
                    <td>'.date("Y-m-d H:i", $reservation->getHeureRes()).'</td>
                    <td>'.$reservation->getCode().'</td>
                    <td class="noborder"><input type="submit" name="supprimerReservation_' . $reservation->getId() . '" value="Supprimer"></td>
                    </tr>';
                }
            }
        }
    }
}
echo '</table></form>
<form action="admin" method="post">
<table aria-describedby="Ajout de créneau">
<caption>Ajout de créneau</caption>
<tr>
<th scope="col">Créneau</th>
<th scope="col">Code</th>
</tr>
<tr>
<td><select name="creneau_nouvelleReservation" required>';
foreach ($piscines as $key => $piscineOption) {
    $bassinsOption = BassinDAO::listByPiscineId($piscineOption->getId());
    foreach ($bassinsOption as $key => $bassinOption) {
        $creneauxOption = CreneauDAO::listByBassinId($bassinOption->getId());
        foreach ($creneauxOption as $key => $creneauOption) {
            if (CreneauDAO::verifyCount($creneauOption) < $creneauOption->getNbPlaces()) {
                echo '<option value="' . $creneauOption->getId() . '">Bassin ' . $bassinOption->getDescription() .
                ' - Piscine ' . $piscineOption->getNom() . ' - ' . date("Y-m-d H:i", $creneauOption->getDateDebutCours()) .
                '</option>';
            }
        }
    }
}
echo '</select></td>
<td><select name="code_nouvelleReservation" required>';
$codes = CodeDAO::list();
foreach ($codes as $key => $code) {
    if (CodeDAO::verify($code) == 0) {
        echo '<option value="' . $code->getId() . '">' . $code->getCode() . '</option>';
    }
}
echo '</select></td>
<td class="noborder"><input type="submit" name="ajouterReservation_nouvelleReservation" value="Ajouter"></td>
</tr>';
