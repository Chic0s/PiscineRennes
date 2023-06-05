<?php
require_once("DAO.php");
require_once("model/Adminpage.php");

class AdminpageDAO
{
    /**
     * Récupération d'un Adminpage à partir de son $id
     * @return Adminpage
     */
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
    /**
     * Liste des Adminpage
     * @return Array<Adminpage> $listAdminPages
     */
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
    /**
     * Insère un Adminpage dans la base de données
     * @return int $idDerniereLigneInseree
     */
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
    /**
     * Modifie un Adminpage fournis dans la base
     * @return int $idLigneModifiee
     */
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
    /**
     * Supprime l'Adminpage spécifié de la base
     * @return void
     */
    public static function supress(Adminpage $adminpage)
    {
        return DAO::Delete('Adminpage', array('id' => $adminpage->getId()));
    }
}
