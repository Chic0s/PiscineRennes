<?php
require_once("DAO.php");
require_once("model/Vente.php");

class VenteDAO
{
    /**
     * Récupération d'une Vente à partir d'un identifiant
     * @return Vente
     */
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
    /**
     * Insère une Vente dans la base de données
     * @return int $idDerniereLigneInseree
     */
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
    /**
     * Modifie une Vente fournis dans la base
     * @return int $idLigneModifiee
     */
    public static function modify(Vente $vente)
    {
        return DAO::Update(
            'Ventes',
            array(
                'date_commande' => date("Y-m-d H:i:s", $vente->getDateCommande()),
                'date_peremption' => date("Y-m-d H:i:s", $vente->getDatePeremption()),
                'nb_commandes' => $vente->getNbCommandes(),
                'id_formule' => $vente->getIdFormule(),
            ),
            array('id' => $vente->getId())
        );
    }
    /**
     * Supprime la Vente spécifiée de la base
     * Supprime les codes associés à la vente spécifiée
     * @return void
     */
    public static function supress(Vente $vente)
    {
        $codes = CodeDAO::listByVenteId($vente->getId());
        foreach ($codes as $key => $code) {
            CodeDAO::supress($code);
        }
        return DAO::Delete('Ventes', array('id' => $vente->getId()));
    }
    /**
     * Renvoie une liste des Ventes
     * @return Vente[] $listVente
     */
    public static function list()
    {
        $ventesBD = DAO::Select('Ventes');
        $listVentes = [];
        foreach ($ventesBD as $key => $vente) {
            $listVentes[] = new Vente(
                $vente['id'],
                strtotime($vente['date_commande']),
                strtotime($vente['date_peremption']),
                $vente['nb_commandes'],
                $vente['id_formule']
            );
        }
        return $listVentes;
    }
}