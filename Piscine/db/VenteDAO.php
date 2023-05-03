<?php
require_once("DAO.php");
require_once("model/Vente.php");

class VenteDAO
{
    public static function readFromId($id)
    {
        $vente = DAO::Select('Ventes', array('id' => $id))[0];
        return new Vente(
            $id,
            strtotime($vente['date_commande']),
            strtotime($vente['date_peremption']),
            $vente['nb_commandes'],
            $vente['id_formule']
        );
    }
    public static function create(Vente $vente)
    {
        return DAO::Insert(
            'Ventes',
            array(
                'date_commande' => date("Y-m-d H:i:s", $vente->getDateCommande()),
                'date_peremption' => date("Y-m-d H:i:s", $vente->getDatePeremption()),
                'nb_commandes' => $vente->getNbCommandes(),
                'id_formule' => $vente->getIdFormule()
            )
        );
    }
    public static function supress(Vente $vente)
    {
        return DAO::Delete('Vente', array('id' => $vente->getId()));
    }
}