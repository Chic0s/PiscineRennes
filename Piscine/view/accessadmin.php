<div class="body-admin">
    <section class="section-admin">
        <img src="assets/img/logo.png" alt="Logo du site">
        <h1>Connexion</h1>
        <?php
        if (isset($_SESSION["showError"])) {
            echo $_SESSION["showError"];
        }
        unset($_SESSION["showError"])
        ?>
        <form action="admin" method="POST" class="form-admin">
            <label>Identifiants</label>
            <input type="text" name="identifiant">
            <label>Mot de Passe</label>
            <input type="password" name="mdp">
            <input type="submit" value="Valider">
        </form>
    </section>
</div>