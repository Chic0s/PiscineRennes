<?php
require_once("DAO.php");
require_once("model/Code.php");
require_once("ReservationDAO.php");
require_once("VenteDAO.php");

class CodeDAO
{
    /**
     * Récupération d'un code à partir d'un identifiant
     * @return Code
     */
    public static function readFromId($id)
    {
        $toReturn = null;
        $code = DAO::Select('Code', array('id' => $id));
        if (isset($code[0])) {
            $code = $code[0];
            $toReturn = new Code(
                $id,
                $code['code'],
                $code['id_vente'],
                $code['id_reservation']
            );
        }
        return $toReturn;
    }
    /**
     * Récupération d'un objet code à partir d'un code
     * @return Code
     */
    public static function readFromCode($codeTXT)
    {
        $toReturn = null;
        $code = DAO::Select('Code', array('code' => $codeTXT));
        if (isset($code[0])) {
            $code = $code[0];
            $toReturn = new Code(
                $code['id'],
                $codeTXT,
                $code['id_vente'],
                $code['id_reservation']
            );
        }
        return $toReturn;
    }
    /**
     * Insère un Code dans la base de données
     * @return int $idDerniereLigneInseree
     */
    public static function create(Code $code)
    {
        return DAO::Insert(
            'Code',
            array(
                'code' => $code->getCode(),
                'id_vente' => $code->getIdVente()
            )
        );
    }
    /**
     * Modifie un Code fournis dans la base
     * @return int $idLigneModifiee
     */
    public static function modify(Code $code)
    {
        return DAO::Update(
            'Code',
            array(
                'code' => $code->getCode(),
                'id_vente' => $code->getIdVente(),
                'id_reservation' => $code->getIdReservation()
            ),
            array('id' => $code->getId())
        );
    }
    /**
     * Supprime le Code spécifié de la base
     * @return void
     */
    public static function supress(Code $code)
    {
        if (null !== $code->getIdReservation()) {
            ReservationDAO::supress(ReservationDAO::readFromId($code->getIdReservation()));
        }
        return DAO::Delete('Code', array('id' => $code->getId()));
    }
    /**
     * Vérifie la validité du code et renvoie
     * 4 status :
     * 0 = Code valide
     * 1 = Code expiré
     * 2 = Code déjà utilisé
     * 3 = Le code n'existe pas
     * @return int
     */
    public static function verify(Code $code)
    {
        $codeObj = CodeDAO::readFromCode($code->getCode());
        if (null !== $codeObj) {
            if ($codeObj->getIdReservation() != null) {
                $reservation = ReservationDAO::readFromId($codeObj->getIdReservation());
            }
            if ($codeObj->getIdVente() != null) {
                $vente = VenteDAO::readFromId($codeObj->getIdVente());
            }
        }
        if (null !== $codeObj && isset($vente)) {
            if (time() >= $vente->getDatePeremption() + 86400) {
                //Code expiré
                $result = 1;
            } elseif (isset($reservation)) {
                //Code déjà utilisé
                $result = 2;
            } else {
                //Code valide
                $result = 0;
            }
        } else {
            //Le code n'existe pas
            $result = 3;
        }
        return $result;
    }
    /**
     * Vérifie si le code fournis n'existe pas déjà dans la base
     * Si le code existe, le renvoie, sinon revoie null
     * @return mixed
     */
    public static function checkDuplicate(Code $codeGenere) {
        return DAO::Select('Code', array('code' => $codeGenere->getCode()));
    }
    /**
     * Renvoie une liste des Codes
     * @return Code[] $listCodes
     */
    public static function list()
    {
        $codesBD = DAO::Select('Code');
        $listCodes = [];
        foreach ($codesBD as $key => $code) {
            $listCodes[] = new Code(
                $code['id'],
                $code['code'],
                $code['id_vente'],
                $code['id_reservation']
            );
        }
        return $listCodes;
    }
    /**
     * Liste les codes correspondant à une vente
     * @return Array<Code> $listCodes
     */
    public static function listByVenteId($idVente)
    {
        $codesBD = DAO::Select('Code', array('id_vente' => $idVente));
        $listCodes =  [];
        foreach ($codesBD as $key => $code) {
            if (isset($code)) {
                $listCodes[] = new Code(
                    $code['id'],
                    $code['code'],
                    $idVente,
                    $code['id_reservation']
                );
            }
        }
        return $listCodes;
    }
}
