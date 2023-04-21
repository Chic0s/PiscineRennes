<?php
// if (isset($_POST['form_submit'])) {
//     $DateAndTime = date('m-d-Y h:i:s a', time());
//     $name = htmlspecialchars($_POST['first_last_name']);
//     $email = htmlspecialchars($_POST['email']);
//     $comments = htmlspecialchars($_POST['message']);
//     $to = 'contact@piscinesrennes.com';
//     $subject = "Message contact portefolio - ".$name;
//     $headers = "From: Formulaire de contact Piscines <postmaster@piscinesrennes.fr>";
//     $message = "Horodatage : ".$DateAndTime."
// Nom/prenom : ".$name."
// Email : ".$email."

// Message : ".$comments;
    
//     if (mail($to, $subject, $message, $headers)) {
//         echo "Le message a été envoyé.";
//     } else {
//         echo "Une erreur s'est produite.";
//     }
// }

$fileLocation = "admin/mailLog.txt";
date_default_timezone_set('Europe/Paris');
$date = date('Y-m-d H:i:s');
if (isset($_POST['form_submit'])) {
    $contentToWrite = ' Subject : Message contact portefolio - '.htmlspecialchars($_POST['first_last_name']).
    'From: Formulaire de contact Piscines <postmaster@piscinesrennes.fr>
    Horodatage : '.$date('m-d-Y h:i:s a', time()).'
Nom/prenom : '.htmlspecialchars($_POST['first_last_name']).'
Email : '.htmlspecialchars($_POST['email']).'

Message : '.$comments.'
';
}

if (file_exists($fileLocation)) {
    file_put_contents($fileLocation, "\n$contentToWrite", FILE_APPEND);
} else {
    file_put_contents($fileLocation, $contentToWrite);
}