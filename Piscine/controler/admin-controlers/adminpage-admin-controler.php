<?php

//Génération du tableau
$adminpages = AdminpageDAO::list();
foreach ($adminpages as $key => $adminpage) {
    echo '<tr>
        <td>' . $adminpage->getId() . '</td>
        <td><input type="text" name="identifiant_' . $adminpage->getId() . '" value="' .
        $adminpage->getIdentifiant() . '" required></td>
        <td><input type="text" name="mdp_' . $adminpage->getId() . '" value="' .
        $adminpage->getMdp() . '" required></td>
        <td class="noborder"><input type="submit" name="modifierAdminpage_' .
        $adminpage->getId() . '" value="Modifier"></td>
        <td class="noborder"><input type="submit" name="supprimerAdminpage_' .
        $adminpage->getId() . '" value="Supprimer"></td>
        </tr>';
}
//Génération du tableau d'ajout
echo '</table></form>
<form action="admin" method="post">
<table aria-describedby="Ajout de compte administrateur">
<caption>Ajout de compte administrateur</caption>
<tr>
<th scope="col">Nom d\'utilisateur</th>
<th scope="col">Mot de passe</th>
</tr>
<tr>
<td><input type="text" name="identifiant_nouveauAdminpage" value="" required></td>
<td><input type="text" name="mdp_nouveauAdminpage" value="" required></td>
<td class="noborder"><input type="submit" name="ajouterAdminpage_nouveauAdminpage" value="Ajouter"></td>
</tr>';
