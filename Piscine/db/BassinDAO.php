<?php
require_once("DAO.php");
require_once("model/Bassin.php");
require_once("CreneauDAO.php");

class BassinDAO
{
    /**
     * Récupération d'un bassin à partir d'un identifiant
     * @return Bassin
     */
    public static function readFromId($id)
    {
        $toReturn = null;
        $bassinInfos = DAO::Select('Bassin', array('id' => $id));
        if (isset($bassinInfos[0])) {
            $bassinInfos = $bassinInfos[0];
            $toReturn = new Bassin(
                $id,
                $bassinInfos['id_piscine'],
                $bassinInfos['description']
            );
        }
        return $toReturn;
    }
    /**
     * Récupérer une liste des bassins correspondant à une piscine
     * @return Bassin[] $listBassins
     */
    public static function listByPiscineId($idPiscine)
    {
        $bassinsBD = DAO::Select('Bassin', array('id_piscine' => $idPiscine));
        $listBassins =  [];
        foreach ($bassinsBD as $key => $bassin) {
            if (isset($bassin)) {
                $listBassins[] = new Bassin(
                    $bassin['id'],
                    $bassin['id_piscine'],
                    $bassin['description']
                );
            }
        }
        return $listBassins;
    }
    /**
     * Insère un Bassin dans la base de données
     * @return int $idDerniereLigneInseree
     */
    public static function create(Bassin $bassin)
    {
        return DAO::Insert(
            'Bassin',
            array(
                'id_piscine' => $bassin->getIdPiscine(),
                'description' => $bassin->getDescription()
            )
        );
    }
    /**
     * Modifie un Bassin fournis dans la base
     * @return int $idLigneModifiee
     */
    public static function modify(Bassin $bassin)
    {
        return DAO::Update(
            'Bassin',
            array(
                'id_piscine' => $bassin->getIdPiscine(),
                'description' => $bassin->getDescription()
            ),
            array('id' => $bassin->getId())
        );
    }
    /**
     * Supprime le Bassin spécifié de la base
     * Supression également des créneaux liés à ce bassin
     * @return void
     */
    public static function supress(Bassin $bassin)
    {
        $listCreneaux = CreneauDAO::listByBassinId($bassin->getId());
        $suppressedCreneaux = [];
        foreach ($listCreneaux as $key => $creneau) {
            $suppressedCreneaux[] = CreneauDAO::supress($creneau);
        }
        return array(
            DAO::Delete('Bassin', array('id' => $bassin->getId())),
            $suppressedCreneaux
        );
    }
}