<?php

$formules = FormuleDAO::list();
foreach ($formules as $key => $formule) {
        echo '<tr>
    <td>' . $formule->getId() . '</td>
    <td><input type="text" name="nom_'.$formule->getId().'" value="'.$formule->getNom().'"></td>
    <td><select name="type_' . $formule->getId() . '" required>';
    $formuleTypes = ['Entrée simple', 'Entrée simple avec dispositif Sortir',
'Forfait horaire', 'Forfait horaire avec dispositif Sortir'];
    for ($i=0; $i < count($formuleTypes); $i++) {
        if ($formule->getType() == $formuleTypes[$i]) {
            echo '<option value="' . $formuleTypes[$i] . '" selected>' .
            $formuleTypes[$i]. '</option>';
        } else {
            echo '<option value="' . $formuleTypes[$i] . '">' .
            $formuleTypes[$i]. '</option>';
        }
    }
    echo '</select></td>
    <td><input type="number" name="prix_'.$formule->getId().'" value="'.$formule->getPrix().'"></td>
    <td><input type="text" name="description_'.$formule->getId().'" value="'.$formule->getDescription().'"></td>
    <td class="noborder"><input type="submit" name="modifierFormule_' . $formule->getId() . '" value="Modifier"></td>
    <td class="noborder"><input type="submit" name="supprimerFormule_' . $formule->getId() . '" value="Supprimer"></td>
    </tr>';
}
    
echo '</table></form>
<form action="admin" method="post">
<table aria-describedby="Ajout de formule">
<caption>Ajout de formule</caption>
<tr>
<th scope="col">Nom</th>
<th scope="col">Type</th>
<th scope="col">Prix</th>
<th scope="col">Description</th>
</tr>
<tr>
<td><input type="text" name="nom_nouvelleFormule" value=""></td>
<td><select name="type_nouvelleFormule" required>';
for ($i=0; $i < count($formuleTypes); $i++) {
    echo '<option value="' . $formuleTypes[$i] . '" selected>' .
        $formuleTypes[$i]. '</option>';
}
echo '</select></td>
<td><input type="number" name="prix_nouvelleFormule" value=""></td>
<td><input type="text" name="description_nouvelleFormule" value=""></td>
<td class="noborder"><input type="submit" name="ajouterFormule_nouvelleFormule" value="Ajouter"></td>
</tr>';
