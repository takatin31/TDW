<?php
require_once("../ControllerAdmin.php");
$cas = 0;

if (isset($_POST["client"])){
    $cc = new ClientController();
    $client = $_POST["client"];
    $cas = $cas + 1;
    $idClient = $cc->getClientId($client);
}

if (isset($_POST["traducteur"])){
    $tc = new TraducteurController();
    $traducteur = $_POST["traducteur"];
    $cas = $cas + 10;
    $idClient = $cc->getTraducteurId($traducteur);
}

$dateDebut = $_POST["dateD"]; 
$dateFin = $_POST["dateF"];

$tc = new DemandeTraductionController();
$dv = new DemandeDevisController();

 if ($cas == 0){
    $nbr1 = $tc->getNombreTraduction($dateDebut, $dateFin);
    $nbr2 = $tc->getNombreDevis($dateDebut, $dateFin);
 }

 if ($cas == 1){
    $nbr1 = $tc->getNombreTraductionByClient($idClient, $dateDebut, $dateFin);
    $nbr2 = $tc->getNombreDevisByClient($idClient, $dateDebut, $dateFin);
 }

 if ($cas == 10){
    $nbr1 = $tc->getNombreTraductionForTraductor($idTraducteur, $dateDebut, $dateFin);
    $nbr2 = $tc->getNombreDevisForTraductor($idTraducteur, $dateDebut, $dateFin);
 }

 if ($cas == 11){
    $nbr1 = $tc->getNombreTraductionByClientForTraductor($idClient, $idTraducteur, $dateDebut, $dateFin);
    $nbr2 = $tc->getNombreDevisByClientForTraductor($idClient, $idTraducteur, $dateDebut, $dateFin);
 }



?>