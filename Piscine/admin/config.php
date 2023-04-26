<?php

if (isset($_POST['identifiants']) && isset($_POST['mdp'])) {
    $identifiants = $_POST['identifiants'];
    $mdp = $_POST['mdp'];
    $nom_serveur = "localhost";
    $utilisateur = "root";
    $mot_de_passe = "";
    $nom_base_donnees = "chicosydu2";
    $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_donnees);
    if (!$con) {
        echo 'Erreur BD';
    };
    $req = mysqli_query($con, "SELECT * FROM AdminPage WHERE identifiants='$identifiants' AND mdp = '$mdp';");
    $num_ligne = mysqli_num_rows($req);
    if ($num_ligne >= 1) {
        header("Location: /Piscine/admin/bienvenu.php");
        exit();
    } else {
        echo "Mot de Passe ou Nom d'utilisateur incorrects !";
    };
}
