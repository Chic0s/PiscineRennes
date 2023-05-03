<?php
require_once("DAO.php");
require_once("model/Code.php");
require_once("ReservationDAO.php");
require_once("VenteDAO.php");

class CodeDAO
{
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
    public static function create(Code $code)
    {
        return DAO::Insert(
            'Code',
            array(
                'code' => $code->getCode(),
                'id_vente' => $code->getIdVente(),
                'id_reservation' => $code->getIdReservation()
            )
        );
    }
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
    public static function supress(Code $code)
    {
        return DAO::Delete('Code', array('id' => $code->getId()));
    }
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
    public static function checkDuplicate(Code $codeGenere) {
        return DAO::Select('Code', array('code' => $codeGenere->getCode()));
    }
}
