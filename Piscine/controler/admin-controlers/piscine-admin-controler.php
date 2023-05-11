<?php
$piscines = PiscineDAO::list();
$etatsPiscine = EtatPiscineDAO::list();
foreach ($piscines as $key => $piscine) {
    echo '<tr>
    <td>' . $piscine->getId() . '</td>
    <td><input type="text" name="nom_'.$piscine->getId().'" value="'.$piscine->getNom().'"></td>
    <td><input type="text" name="adresse_'.$piscine->getId().'" value="'.$piscine->getAdresse().'"></td>
    <td><select name="etat_' . $piscine->getId() . '" required>';
    foreach ($etatsPiscine as $key => $etatPiscine) {
        if ($etatPiscine->getId() == $piscine->getIdEtatPiscine()) {
            echo '<option value="' . $etatPiscine->getId() . '" selected>' .
                $etatPiscine->getLabel() . '</option>';
        } else {
            echo '<option value="' . $etatPiscine->getId() . '">' .
            $etatPiscine->getLabel() . '</option>';
        }
    }
    echo '</select></td>
    <td><input type="text" name="srcImage_'.$piscine->getId().'" value="'.$piscine->getSrcImage().'"></td>
    <td class="noborder"><input type="submit" name="modifierPiscine_' . $piscine->getId() . '" value="Modifier"></td>
    <td class="noborder"><input type="submit" name="supprimerPiscine_' . $piscine->getId() . '" value="Supprimer"></td>
    </tr>';
}

echo '</table></form>
<form action="admin" method="post">
<table aria-describedby="Ajout de piscine">
<caption>Ajout de piscine</caption>
<tr>
<th scope="col">Nom</th>
<th scope="col">Adresse</th>
<th scope="col">État</th>
<th scope="col">Emplacement de l\'image</th>
</tr>
<tr>
<td><input type="text" name="nom_nouvellePiscine" value=""></td>
<td><input type="text" name="adresse_nouvellePiscine" value=""></td>
<td><select name="etat_nouvellePiscine" required>';
foreach ($etatsPiscine as $key => $etatPiscine) {
    echo '<option value="' . $etatPiscine->getId() . '">' .
    $etatPiscine->getLabel() . '</option>';
}
echo '</select></td>
<td><input type="text" name="srcImage_nouvellePiscine" value=""></td>
<td class="noborder"><input type="submit" name="ajouterPiscine_nouvellePiscine" value="Ajouter"></td>
</tr>';
