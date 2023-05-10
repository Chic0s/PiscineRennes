<?php
$codes = CodeDAO::list();
$formules = FormuleDAO::list();
foreach ($codes as $key => $code) {
    $vente = VenteDAO::readFromId($code->getIdVente());
    echo '<tr>
            <td>' . $code->getId() . '</td>
            <td>' . $code->getCode() . '</td>
            <td>' . date("Y-m-d H:i", $vente->getDateCommande()) . '</td>
            <td><input type="datetime-local" name="datePeremption_' . $code->getId() . '" value="' .
        date("Y-m-d\\TH:i", $vente->getDatePeremption()) . '" required></td>
            <td><select name="formule_' . $code->getId() . '" required>';
    foreach ($formules as $key => $formule) {
        if ($formule->getId() == $vente->getIdFormule()) {
            echo '<option value="' . $formule->getId() . '" selected>' . $formule->getNom() . '</option>';
        } else {
            echo '<option value="' . $formule->getId() . '">' . $formule->getNom() . '</option>';
        }
    }
    echo '</select></td>
        <td>';
    if ($code->getIdReservation() !== null) {
        $reservation = ReservationDAO::readFromId($code->getIdReservation());
        require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/CreneauDAO.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/BassinDAO.php');
        require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/PiscineDAO.php');
        $creneau = CreneauDAO::readFromId($reservation->getIdCreneau());
        $bassin = BassinDAO::readFromId($creneau->getIdBassin());
        $piscine = PiscineDAO::readFromId($bassin->getIdPiscine());
        echo 'Bassin ' . $bassin->getDescription() . ' - Piscine ' . $piscine->getNom() .
            ' - ' . date("Y-m-d H:i", $creneau->getDateDebutCours());
    } else {
        echo 'Aucune';
    }
    echo '</td>
        <td class="noborder"><input type="submit" name="modifierCode_' . $code->getId() . '" value="Modifier"></td>
            <td class="noborder"><input type="submit" name="supprimerCode_' . $code->getId() . '" value="Supprimer"></td>
            </tr>';
}

echo '</table></form>
<br>
<form action="admin" method="post">
<table aria-describedby="Ajout de code(s)">
<caption>Ajout de code(s)</caption>
<tr>
<th scope="col">Date de péremption</th>
<th scope="col">Formule</th>
<th scope="col">Nombre de codes</th>
</tr>
<tr>
<td><input type="datetime-local" name="datePeremption_nouveauCode" value="" required></td>
<td><select name="formule_nouveauCode" required>';
foreach ($formules as $key => $formule) {
    echo '<option value="' . $formule->getId() . '">' . $formule->getNom() . '</option>';
}

echo '</select></td>
<td><input type="number" name="nbCodes_nouveauCode" value="" max="30" required></td>
<td class="noborder"><input type="submit" name="ajouterCode_nouveauCode" value="Ajouter"></td>
</tr>';
