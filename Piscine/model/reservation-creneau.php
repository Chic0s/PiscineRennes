<?php
//Import des classes nécessaires
require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/db/CodeDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/db/CreneauDAO.php');

function printReservation($resultVerifCode)
{
    if (isset($_POST['code'])) {
        switch ($resultVerifCode)  {
            case 1:
                $errorMessage = '<p class="error">Code expiré.</p>';
                break;
            case 2:
                $errorMessage = '<p class="error">Ce code a déjà été utilisé.</p>';
                break;
            case 3:
                $errorMessage = '<p class="error">Ce code n\'existe pas. Veuillez réessayer.</p>';
                break;
            default:
                $code = CodeDAO::readFromCode(htmlspecialchars($_POST['code']));
                $creneau = CreneauDAO::readFromId(htmlspecialchars($_GET['creneau']));
                if (CreneauDAO::verificationNombreReservations($code, $creneau)) {
                    CreneauDAO::reserver($code, $creneau);
                    echo '<div id=reservation><h2>Merci de votre réservation !</h2>
                    <p>Votre réservation a bien été prise en compte. <br>
 pour la faire valloir, vous deuvrez seulement présenter le code que vous avez utilisé
 pour cette réservation aux bornes de votre piscine ou, le cas échéant, le préseter à l\'accueil.
Par ailleurs, si vous ne pouvez plus assister au cours que vous avez réservé,
 veuillez utiliser l\'outil de <a href="verification-code">vérifications de code</a>.</p></div>';
                } else {
                    $tropCommandes = true;
                    $errorMessage = '<p id="error">Impossible d\'effectuer une réservation,
 il ne reste pas assez de places disponibles.</p>';
                }
                break;
        }
    } if ($resultVerifCode != 0 || isset($tropCommandes)) {
        echo '<form action="reservation-creneau?creneau='.$_GET['creneau'].'" method="post" id="reservation">
        <p>Veuillez entrer un code pour réserver une place sur ce créneau.<br>
Vous n\'en avez pas encore ? Pas de problèmes ! <br> Dirigez vous vers notre
 <a href="billetterie">billetterie</a>
 avec le lien ci-contre avant de revenir sur cette page !<p>
        <br>';
        if (isset($errorMessage)) {echo $errorMessage;}
        echo '<label for="code">Votre code :</label>
        <br>
        <input type="text" name="code" id="code" minlength="9" maxlength="9" required>
        <br>
        <br>
        <input type="submit" value="Réserver">
    </form>';
    }
}
