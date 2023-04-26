<?php

$identifiants = $_POST['identifiants'];

$mdp = $_POST['mdp'];

$nom_serveur = "localhost";

$utilisateur = "root";

$mot_de_passe = "";

$nom_base_donnees = "chicosydu2";

$con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe, $nom_base_donnees);

if (!$con) {

    echo '<script>alert("Le service est en Maintenance, Merci de revenir plus tard ! ")</script>';
};
