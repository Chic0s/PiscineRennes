<?php
class ConnexionBD
{
    private static $instance;
    //Singleton
    private function __construct()
    {
    }
    //Singleton
    private function __clone()
    {
    }
    public static function getInstance()
    {
        if (!isset($instance)) {
            try {
                $nomServeur = "localhost";
                $utilisateur = "root";
                $motDePasse = "";
                $nomBaseDonnees = "SaveData";
                $instance = new PDO(
                    'mysql:host=' . $nomServeur .
                        ';dbname=' . $nomBaseDonnees .
                        ';charset=utf8',
                    $utilisateur,
                    $motDePasse
                );
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $instance;
    }
}
