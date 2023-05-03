<?
   $identifiants = $_POST['identifiants'];
   $mdp = $_POST['mdp'];
   $nom_serveur = "chicosydu2.mysql.db";
   $utilisateur = "chicosydu2";
   $mot_de_passe = "JesuisunmdpBidon35";
   $nom_base_donnees = "chicosydu2";
   $con = mysqli_connect($nom_serveur, $utilisateur, $mot_de_passe,$nom_base_donnees);
   if(!$con) {
       echo '<script>alert("Le service est en Maintenance, Merci de revenir plus tard ! ")</script>';
   };


?>