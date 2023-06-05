<?php
//Génération du tableau
foreach ($piscines as $key => $piscine) {
    $bassins = BassinDAO::listByPiscineId($piscine->getId());
    foreach ($bassins as $key => $bassin) {
        echo '<tr>
    <td>' . $bassin->getId() . '</td>
    <td><select name="piscine_' . $bassin->getId() . '" required>';
    $piscinesOption = $piscines;
    foreach ($piscinesOption as $key => $piscineOption) {
        if ($piscineOption->getId() == $bassin->getIdPiscine()) {
            echo '<option value="' . $piscineOption->getId() . '" selected>' .
                $piscineOption->getNom() . '</option>';
        } else {
            echo '<option value="' . $piscineOption->getId() . '">' .
            $piscineOption->getNom() . '</option>';
        }
    }
    echo '</select></td>
    <td><input type="text" name="description_'.$bassin->getId().'" value="'.$bassin->getDescription().'"></td>
    <td class="noborder"><input type="submit" name="modifierBassin_' . $bassin->getId() . '" value="Modifier"></td>
    <td class="noborder"><input type="submit" name="supprimerBassin_' . $bassin->getId() . '" value="Supprimer"></td>
    </tr>';
}

}
//Génération du tableau d'ajout
echo '</table></form>
<form action="admin" method="post">
<table aria-describedby="Ajout de bassin">
<caption>Ajout de bassin</caption>
<tr>
<th scope="col">Piscine</th>
<th scope="col">Description</th>
</tr>
<tr>
<td><select name="piscine_nouveauBassin" required>';
$piscinesOption = $piscines;
foreach ($piscinesOption as $key => $piscineOption) {
    echo '<option value="' . $piscineOption->getId() . '">' .
    $piscineOption->getNom() . '</option>';
}
echo '</select></td>
<td><input type="text" name="description_nouveauBassin"></td>
<td class="noborder"><input type="submit" name="ajouterBassin_nouveauBassin" value="Ajouter"></td>
</tr>';
