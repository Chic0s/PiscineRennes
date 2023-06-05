<?php
require_once("DAO.php");
require_once("model/Formule.php");

class FormuleDAO
{
    /**
     * Récupération d'une Formule à partir d'un identifiant
     * @return Formule
     */
    public static function readFromId($id)
    {
        $formule = DAO::Select('Formule', array('id' => $id))[0];
        return new Formule(
            $id,
            $formule['nom'],
            $formule['type'],
            $formule['prix'],
            $formule['periode_validite'],
            $formule['description']
        );
    }
    /**
     * Renvoie une liste des Formules
     * @return Formule[] $listFromules
     */
    public static function list()
    {
        $formulesBD = DAO::Select('Formule');
        $listFromules = [];
        foreach ($formulesBD as $key => $formule) {
            $listFromules[] = new Formule(
                $formule['id'],
                $formule['nom'],
                $formule['type'],
                $formule['prix'],
                $formule['periode_validite'],
                $formule['description']
            );
        }
        return $listFromules;
    }
    /**
     * Insère une Formule dans la base de données
     * @return int $idDerniereLigneInseree
     */
    public static function create(Formule $formule)
    {
        return DAO::Insert(
            'Formule',
            array(
                'nom' => $formule->getNom(),
                'type' => $formule->getType(),
                'prix' => $formule->getPrix(),
                'periode_validite' => $formule->getPeriodeValidite(),
                'description' => $formule->getDescription()
            )
        );
    }
    /**
     * Modifie une Formule fournis dans la base
     * @return int $idLigneModifiee
     */
    public static function modify(Formule $formule)
    {
        return DAO::Update(
            'Formule',
            array(
                'nom' => $formule->getNom(),
                'type' => $formule->getType(),
                'prix' => $formule->getPrix(),
                'periode_validite' => $formule->getPeriodeValidite(),
                'description' => $formule->getDescription()
            ),
            array('id' => $formule->getId())
        );
    }
    /**
     * Supprime la Formule spécifiée de la base
     * Supprime également les ventes lui étant rattachées
     * @return void
     */
    public static function supress(Formule $formule)
    {
        $ventes = VenteDAO::list();
        foreach ($ventes as $key => $vente) {
            if ($vente->getIdFormule() == $formule->getId()) {
                VenteDAO::supress($vente);
            }
        }
        return DAO::Delete('Formule', array('id' => $formule->getId()));
    }
}
