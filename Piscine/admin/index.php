<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Page de connexion</title>
    <link rel="icon" type="image/x-icon" href="assets/img/ico/favico.ico">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <section>
        <img src="assets/img/logo.png">
        <h1>Connexion</h1>
        <form action="config.php" method="POST">
            <label>Identifiants</label>
            <input type="text" name="identifiants">
            <label>Mot de Passe</label>
            <input type="password" name="mdp">
            <input type="submit" value="Valider">
        </form>
    </section>
</body>
</html>