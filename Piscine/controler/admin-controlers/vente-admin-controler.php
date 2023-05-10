<?php
$ventes = VenteDAO::list();
$formules = FormuleDAO::list();
foreach ($ventes as $key => $vente) {
    if (isset($_POST['supprimerVente_' . $vente->getId()])) {
        $codes = CodeDAO::listByVenteId($vente->getId());
        foreach ($codes as $key => $code) {
            CodeDAO::supress($code);
            if (null !== $code->getIdReservation()) {
                require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/ReservationDAO.php');
                ReservationDAO::supress(ReservationDAO::readFromId($code->getIdReservation()));
            }
        }
        VenteDAO::supress($vente);
    } else {
        if (isset($_POST['modifierVente_' . $vente->getId()])) {
            $vente->setDatePeremption(strtotime($_POST['datePeremption_' . $vente->getId()]));
            $vente->setIdFormule($_POST['formule_' . $vente->getId()]);
            VenteDAO::modify($vente);
        }
        echo '<tr>
            <td>' . $vente->getId() . '</td>
            <td>' . date("Y-m-d H:i", $vente->getDateCommande()) . '</td>
            <td><input type="datetime-local" name="datePeremption_' . $vente->getId() . '" value="' .
            date("Y-m-d\\TH:i", $vente->getDatePeremption()) . '" required></td>
            <td>';
            if (null !== CodeDAO::listByVenteId($vente->getId())) {
                echo count(CodeDAO::listByVenteId($vente->getId()));
            } else {
                echo '0';
            }
            echo '</td>
            <td><select name="formule_' . $vente->getId() . '" required>';
        foreach ($formules as $key => $formule) {
            if ($formule->getId() == $vente->getIdFormule()) {
                echo '<option value="' . $formule->getId() . '" selected>' . $formule->getNom() . '</option>';
            } else {
                echo '<option value="' . $formule->getId() . '">' . $formule->getNom() . '</option>';
            }
        }
        echo '</select></td>
            <td class="noborder"><input type="submit" name="modifierVente_' . $vente->getId() . '" value="Modifier"></td>
            <td class="noborder"><input type="submit" name="supprimerVente_' . $vente->getId() . '" value="Supprimer"></td>
            </tr>';
    }
}
