<?php
require_once("../ControllerAdmin.php");

$idDemande = $_POST["idDemande"];
$type = $_POST["type"];
$action = $_POST["action"];

$uc = new PaiementController();

if (strcmp($action, "accept") == 0){
    $uc->acceptDemandePaiement($idDemande, $type);
}

if (strcmp($action, "decline") == 0){
    $uc->declineDemandePaiement($idDemande, $type);
}

?>