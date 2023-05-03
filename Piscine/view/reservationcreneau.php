<h1>Réservation de créneau</h1>
<br>
<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/Piscine/db/DAOs.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/Piscine/controler/reservation-creneau.php');
$result = "";
if (isset($_POST['code'])) {
    $codeObj = CodeDAO::readFromCode(htmlspecialchars($_POST['code']));
    if (null !== $codeObj) {
        $result = CodeDAO::verify($codeObj);
    } else {
        $result = 3;
    }
}
PrintReservation($result);
?>
