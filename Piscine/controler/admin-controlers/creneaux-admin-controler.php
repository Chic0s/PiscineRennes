<?php
//Génération du tableau
$piscines = PiscineDAO::list();
foreach ($piscines as $key => $piscine) {
    $bassins = BassinDAO::listByPiscineId($piscine->getId());
    foreach ($bassins as $key => $bassin) {
        $creneaux = CreneauDAO::listByBassinId($bassin->getId());
        foreach ($creneaux as $key => $creneau) {
            echo '<tr>
                <td>' . $creneau->getId() . '</td>
                <td><select name="bassin_' . $creneau->getId() . '" required>';
            foreach ($piscines as $key => $piscineOption) {
                $bassinsOption = BassinDAO::listByPiscineId($piscineOption->getId());
                foreach ($bassinsOption as $key => $bassinOption) {
                    if ($bassinOption->getId() == $creneau->getIdBassin()) {
                        echo '<option value="' . $bassinOption->getId() . '" selected>Bassin ' .
                            $bassinOption->getDescription() . ' - Piscine ' . $piscineOption->getNom() . '</option>';
                    } else {
                        echo '<option value="' . $bassinOption->getId() . '">Bassin ' .
                            $bassinOption->getDescription() . ' - Piscine ' . $piscineOption->getNom() . '</option>';
                    }
                }
            }
            echo '</select></td>
                <td><input type="datetime-local" name="debutCreneau_' . $creneau->getId() . '" value="' .
                date("Y-m-d\\TH:i", $creneau->getDateDebutCours()) . '" required></td>
                <td><input type="datetime-local" name="finCreneau_' . $creneau->getId() . '" value="' .
                date("Y-m-d\\TH:i", $creneau->getDateFinCours()) . '" required></td>
                <td><input type="number" name="nbPlaces_' . $creneau->getId() .
                '" value="' . $creneau->getNbPlaces() . '" max="30" required></td>
                <td>';
                if (null !== ReservationDAO::listByCreneauId($creneau->getId())) {
                    echo count(ReservationDAO::listByCreneauId($creneau->getId()));
                } else {
                    echo '0';
                }
                echo '</td>
                <td class="noborder"><input type="submit" name="modifierCreneau_' . $creneau->getId() . '" value="Modifier"></td>
                <td class="noborder"><input type="submit" name="supprimerCreneau_' . $creneau->getId() . '" value="Supprimer"></td>
            </tr>';
        }
    }
}
//Génération du tableau d'ajout
echo '</table></form>
<form action="admin" method="post">
<table aria-describedby="Ajout de créneau">
<caption>Ajout de créneau</caption>
<tr>
<th scope="col">Bassin</th>
<th scope="col">Date/heure de début</th>
<th scope="col">Date/heure de fin</th>
<th scope="col">Nombre de places</th>
</tr>
<tr>
<td><select name="bassin_nouveauCreneau" required>';
foreach ($piscines as $key => $piscineOption) {
    $bassinsOption = BassinDAO::listByPiscineId($piscineOption->getId());
    foreach ($bassinsOption as $key => $bassinOption) {
        echo '<option value="' . $bassinOption->getId() . '">Bassin ' .
            $bassinOption->getDescription() . ' - Piscine ' . $piscineOption->getNom() . '</option>';
    }
}
echo '</select></td>
<td><input type="datetime-local" name="debutCreneau_nouveauCreneau" value="" min="' .
    date("Y-m-d\\TH:i", time()) . '" required></td>
<td><input type="datetime-local" name="finCreneau_nouveauCreneau" value="" min="' .
    date("Y-m-d\\TH:i", time()) . '" required></td>
<td><input type="number" name="nbPlaces_nouveauCreneau" value="" max="30" required></td>
<td class="noborder"><input type="submit" name="ajouterCreneau_nouveauCreneau" value="Ajouter"></td>
</tr>';
