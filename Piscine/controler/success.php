<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/FormuleDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/VenteDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Piscine/db/CodeDAO.php');
    /*
    function CheckPayement() {
        $rep = 1;
        $month = null;
        $year = null;
        $date = getdate(date("U"));
        foreach($_POST as $key=>$value)
        {
            if($key=="Month") {
                $month = $value;
            }
            if($key=="Year") {
                $year = $value;
            }
        }
        if($date["year"] <= $year ){
            if($date["month"] <= $month ){
                $rep = 1;
            }
        }
        return $rep;
    }
    */
function generateCode()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 9; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

function getCodes()
{
    $listeFormules = FormuleDAO::list();
    foreach ($listeFormules as $key => $formule)  {
        if(isset($_SESSION["Formule".$formule->getId()]) && $_SESSION["Formule".$formule->getId()] > 0) {
            $vente = new Vente(null, time(), time() + $formule->getPeriodeValidite(), 1, $formule->getId());
            $idVente = VenteDAO::create($vente);
            $i = 1;
            while ($_SESSION["Formule".$formule->getId()] >= $i) {
                do {
                    $codeObj = new Code(null, generateCode(), $idVente, null);
                } while (null === CodeDAO::checkDuplicate($codeObj));
                CodeDAO::create($codeObj);
                $rep = $formule->getNom().', Code = '.$codeObj->getCode().'<br>';
                echo $rep;
                $i = $i +1 ;
            }
        }
    }
    session_destroy();
}
