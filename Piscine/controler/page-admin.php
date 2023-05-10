<?php
if (isset($_POST["disconnect"])) {
    unset($_SESSION["authorized"]);
    unset($_SESSION["showError"]);
    header("Location: /Piscine/admin");
}

