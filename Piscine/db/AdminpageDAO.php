<?php
require_once("DAO.php");
require_once("model/Adminpage.php");

class AdminpageDAO
{
    public static function readFromId($id)
    {
        $toReturn = null;
        $adminpage = DAO::Select('Adminpage', array('id' => $id));
        if (isset($adminpage[0])) {
            $adminpage = $adminpage[0];
            $toReturn = new Adminpage(
                $id,
                $adminpage['identifiants'],
                $adminpage['mdp']
            );
        }
        return $toReturn;
    }
    public static function list()
    {
        $adminpagesBD = DAO::Select('Adminpage');
        $listAdminpages = [];
        foreach ($adminpagesBD as $key => $adminpage) {
            if (isset($adminpage)) {
                $listAdminpages[] = new Adminpage(
                    $adminpage['id'],
                    $adminpage['identifiants'],
                    $adminpage['mdp']
                );
            }
        }
        return $listAdminpages;
    }
    public static function create(Adminpage $adminpage)
    {
        return DAO::Insert(
            'Adminpage',
            array(
                'identifiants' => $adminpage->getIdentifiant(),
                'mdp' => $adminpage->getMdp()
            )
        );
    }
    public static function modify(Adminpage $adminpage)
    {
        return DAO::Update(
            'Adminpage',
            array(
                'identifiants' => $adminpage->getIdentifiant(),
                'mdp' => $adminpage->getMdp()
            ),
            array('id' => $adminpage->getId())
        );
    }
    public static function supress(Adminpage $adminpage)
    {
        return DAO::Delete('Adminpage', array('id' => $adminpage->getId()));
    }
}
