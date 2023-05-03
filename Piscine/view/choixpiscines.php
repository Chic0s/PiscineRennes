<h1>Choix de la piscine</h1>
<br>
<form action="choix-bassin" class="container">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Piscine/db/PiscineDAO.php';
    
    $listePiscines = PiscineDAO::list();
    // Etats possibles : 
    // - 1 : Normal
    // - 2 : Dégradé
    // - 3 : Fermeture ponctuelle
    // - 4 : Fermeture définitive 

    foreach ($listePiscines as $piscine) {
        if ($piscine->getIdEtatPiscine() != 4) {
            if ($piscine->getIdEtatPiscine() == 3) {
                $status = '" disabled="disabled"';
            } elseif ($piscine->getIdEtatPiscine() == 1) {
                $unavaliable = '';
                $status = 'normal"';
            } else {
                $unavaliable = '';
                $status = 'degrade"';
            }
            echo '<button name="piscine" value="'.$piscine->getId().'" class="box '.$status. '>
            <img src="'.$piscine->getSrcImage().'">
            <div></div>
            <p class="label">'.$piscine->getNom().'</p>
            </button>';
        }
    }
?>