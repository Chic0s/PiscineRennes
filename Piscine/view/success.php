<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/Piscine/controler/success.php';
echo'<a class="PayementAccepted">Paiement Accepté !</a>';
getCodes();
?>
