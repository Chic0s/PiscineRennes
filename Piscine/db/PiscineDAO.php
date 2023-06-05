<?php
require_once("DAO.php");
require_once("model/Piscine.php");
require_once("BassinDAO.php");

class PiscineDAO
{
    /**
     * Récupération d'une Piscine à partir d'un identifiant
     * @return Piscine
     */
    public static function readFromId($id)
    {
        $toReturn = null;
        $piscine = DAO::Select('Piscine', array('id' => $id));
        if (isset($piscine[0])) {
            $piscine = $piscine[0];
            $toReturn = new Piscine(
                $id,
                $piscine['nom'],
                $piscine['adresse'],
                $piscine['id_etat_piscine'],
                $piscine['src_image']
            );
        }
        return $toReturn;
    }
    /**
     * Renvoie une liste des Piscines
     * @return Piscine[] $listPiscines
     */
    public static function list()
    {
        $piscinesBD = DAO::Select('Piscine');
        $listPiscines = [];
        foreach ($piscinesBD as $key => $piscine) {
            if (isset($piscine)) {
                $listPiscines[] = new Piscine(
                    $piscine['id'],
                    $piscine['nom'],
                    $piscine['adresse'],
                    $piscine['id_etat_piscine'],
                    $piscine['src_image']
                );
            }
        }
        return $listPiscines;
    }
    /**
     * Insère une Piscine dans la base de données
     * @return int $idDerniereLigneInseree
     */
    public static function create(Piscine $piscine)
    {
        return DAO::Insert(
            'Piscine',
            array(
                'nom' => $piscine->getNom(),
                'adresse' => $piscine->getAdresse(),
                'id_etat_piscine' => $piscine->getIdEtatPiscine(),
                'src_image' => $piscine->getSrcImage()
            )
        );
    }
    /**
     * Modifie une Piscine fournis dans la base
     * @return int $idLigneModifiee
     */
    public static function modify(Piscine $piscine)
    {
        return DAO::Update(
            'Piscine',
            array(
                'nom' => $piscine->getNom(),
                'adresse' => $piscine->getAdresse(),
                'id_etat_piscine' => $piscine->getIdEtatPiscine(),
                'src_image' => $piscine->getSrcImage()
            ),
            array('id' => $piscine->getId())
        );
    }
    /**
     * Supprime la Piscine spécifiée de la base
     * Supprime également les bassins lui étant attachés
     * @return void
     */
    public static function supress(Piscine $piscine)
    {
        $listBassins = BassinDAO::listByPiscineId($piscine->getId());
        $suppressedBassins = [];
        foreach ($listBassins as $key => $bassin) {
            $suppressedBassins[] = BassinDAO::supress($bassin);
        }
        return array(
            DAO::Delete('piscine', array('id' => $piscine->getId())),
            $suppressedBassins
        );
    }
}