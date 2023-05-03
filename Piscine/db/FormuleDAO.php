<?php
require_once("DAO.php");
require_once("model/Formule.php");

class FormuleDAO
{
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
    public static function supress(Formule $formule)
    {
        return DAO::Delete('Formule', array('id' => $formule->getId()));
    }
}
