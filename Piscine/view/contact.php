<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Piscine/model/sendEmail.php';
?>
<h1>Contact</h1>
<br>
<form method="post" action="contact" class="contact decallage-gauche">
    <label for="first_last_name">Nom :</label>
    <br><input type="text" name="first_last_name" id="first_last_name" required></input>
    <br><label for="email">Votre email :</label>
    <br><input type="email" name="email" id="email" required></input>
    <br><label for="message">Votre message :</label>
    <br><textarea name="message" id="message" rows="7" cols="50" required></textarea>
    <br>
    <br><input type="submit" name="form_submit" value="Envoyer votre message" class="submit-button align-right-button">
    <br>
</form>