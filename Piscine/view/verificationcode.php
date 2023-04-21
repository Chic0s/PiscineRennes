<h1>Verification de code</h1>
<br>
<br>
<p>Veuillez saisir dans le champ ci-dessous le code que vous souhaitez <br>
vérifier ou dont vous souhaitez annuler la réservation.</p>
<br>
<form action="verification-code" method="post">
  <label for="code">Votre code :</label><br>
  <input type="text" name="code" id="code" minlength="9" maxlength="9">
  <br>
  <br>
  <button type="submit">Valider</button>
</form>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Piscine/model/verification-code.php');
?>