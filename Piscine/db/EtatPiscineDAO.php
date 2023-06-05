<?php
require_once("DAO.php");
require_once("model/EtatPiscine.php");

class EtatPiscineDAO
{
    /**
     * Récupération d'un EtatPiscine à partir d'un identifiant
     * @return EtatPiscine
     */
    public static function readFromId($id)
    {
        $etatPiscine = DAO::Select('Etat_piscine', array('id' => $id))[0];
        return new EtatPiscine(
            $id,
            $etatPiscine['label']
        );
    }
    /**
     * Renvoie une liste des EtatPiscine
     * @return EtatPiscine[] $listEtatsPiscine
     */
    public static function list()
    {
        $etatPiscineBD = DAO::Select('Etat_piscine');
        $listEtatsPiscine = [];
        foreach ($etatPiscineBD as $key => $etatPiscine) {
            $listEtatsPiscine[] = new EtatPiscine(
                $etatPiscine['id'],
                $etatPiscine['label']
            );
        }
        return $listEtatsPiscine;
    }
}
