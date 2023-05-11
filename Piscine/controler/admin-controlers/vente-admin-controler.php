<?php
$ventes = VenteDAO::list();
$formules = FormuleDAO::list();
foreach ($ventes as $key => $vente) {
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
