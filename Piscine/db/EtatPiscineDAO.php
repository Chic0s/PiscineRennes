<?php
require_once("DAO.php");
require_once("model/EtatPiscine.php");

class EtatPiscineDAO
{
    public static function readFromId($id)
    {
        $etatPiscine = DAO::Select('Etat_piscine', array('id' => $id))[0];
        return new EtatPiscine(
            $id,
            $etatPiscine['label']
        );
    }
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
