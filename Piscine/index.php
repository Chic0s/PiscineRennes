<?php
require_once 'view/head.php';
?>
<body>
<?php require 'view/header.php'; ?>
    <main>
    <?php
// parse_url() analyse une URL et retourne ses composants
$parsed_url = parse_url($_SERVER['REQUEST_URI']);
// soit l'url en question a un chemin et sinon le chemin est la racine
$path = isset($parsed_url['path']) ? $parsed_url['path'] : '/';

$racine = $_SERVER["DOCUMENT_ROOT"].'/Piscine';
$file_dir = '/Piscine';
$getArguments = "";
switch ($path) {
    case $file_dir."/":
        require_once($racine . '/view/accueil.php');
        break;
    case $file_dir . "/piscines":
        require_once($racine . '/view/piscines.php');
        break;
    case $file_dir ."/choix-piscine":
        require_once($racine . '/view/choixpiscines.php');
        break;
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
    default:
        require_once($racine . '/view/erreur.php');
        break;
} ?>
    </main>
</body>
</html>