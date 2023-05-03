<h1>Choix du bassin</h1>
<br>
<form action="reservation-creneau" method="get">
    <?php
    //Import du modèle affichage-bassins.php qui permet de lister les bassins et les crénaux
    //leur étant associés.
    require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/controler/affichage-bassins.php');
    ?>
</form>