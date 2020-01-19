<?php
require_once('controller.php');
session_start();
$Userid = $_COOKIE['userid'];
$nom = $_POST["nom"];
$prenom= $_POST["prenom"];
$email= $_POST["email"];
$phone= $_POST["phone"];
$wilaya= $_POST["wilaya"];
$commune= $_POST["commune"];
$adresse= $_POST["adresse"];
$typeDemande= $_POST["typeDemande"];
$traduteurs = $_POST["traducteurs"];
$langueD = $_POST["desired-lang"];
$langueO = $_POST["origin-lang"];
$comment = $_POST["comment"];
$type = $_POST["traduction-type"];
$assermente = $_POST["assermente"];
$file= $_FILES["customFile"];



$tc = new demande_traduction_controller();

$arrlength = count($traduteurs);
$demandeId = $tc->addDemande($Userid, $nom, $prenom, $email, $adresse, $wilaya, $commune, $phone, $langueO, $langueD, $type, $comment, $assermente, $file, $typeDemande);

for($x = 0; $x < $arrlength; $x++) {
    $tc->addRecevoirDemandeT($demandeId, $traduteurs[$x], $typeDemande);
}
    
?>