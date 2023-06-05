<?php
session_start();
require_once 'view/head.php';
?>
<body>
<?php require_once 'view/header.php'; ?>
    <main>
    <?php
// parse_url() analyse une URL et retourne ses composants
$parsed_url = parse_url($_SERVER['REQUEST_URI']);
// soit l'url en question a un chemin et sinon le chemin est la racine
$path = isset($parsed_url['path']) ? $parsed_url['path'] : '/';

$racine = $_SERVER["DOCUMENT_ROOT"].'/Piscine';
$file_dir = '/Piscine';
$getArguments = "";
//Routage de chaque page par rapport l'URL
switch ($path) {
    case $file_dir."/":
        require_once($racine . '/view/accueil.php');
        echo '<a href="admin">Page d\'administration</a>';
        break;
    case $file_dir . "/piscines":
        require_once($racine . '/view/piscines.php');
        break;
    case $file_dir ."/choix-piscine":
        require_once($racine . '/view/choixpiscines.php');
        break;
    //Récupération des variables transmises en GET via l'URL
    case (preg_match('/\\'.$file_dir.'\/choix-bassin*/', $path) ? true : false):
        if (strpos($path, "?")) {
            $getArguments = "?".explode("?", $path)[1];
        }
        require_once($racine . '/view/choixbassin.php'. $getArguments);
        break;
    case (preg_match('/\\'.$file_dir.'\/reservation-creneau*/', $path) ? true : false):
        if (strpos($path, "?")) {
            $getArguments = "?".explode("?", $path)[1];
        }
        require_once($racine . '/view/reservationcreneau.php'. $getArguments);
        break;
    case $file_dir ."/billetterie":
        require_once($racine . '/view/billetterie.php');
        break;
    case $file_dir ."/verification-code":
        require_once($racine . '/view/verificationcode.php');
        break;
    case $file_dir ."/boutique":
        require_once($racine . '/view/boutique.php');
        break;
    case $file_dir ."/paiement":
        require_once($racine . '/view/payement.php');
        break;
    case $file_dir ."/success":
        require_once($racine . '/view/success.php');
        break;
    case $file_dir ."/contact":
        require_once($racine . '/view/contact.php');
        break;
    case $file_dir ."/admin":
        require_once($racine . '/controler/connexion-admin.php');
        //Si l'utilisateur est déjà authentifié, il entre directement sur la page d'administration
        if (isset($_SESSION["authorized"]) && $_SESSION["authorized"]) {
            require_once($racine . '/view/pageadmin.php');
        } else {
            require_once($racine . '/view/accessadmin.php');
        }
        break;
    default:
        //Page d'erreur 404
        require_once($racine . '/view/erreur.php');
        break;
} ?>
    </main>
</body>
</html>