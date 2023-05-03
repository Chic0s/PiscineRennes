<?php
require_once("DAO.php");
require_once("model/Bassin.php");
require_once("CreneauDAO.php");

class BassinDAO
{
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