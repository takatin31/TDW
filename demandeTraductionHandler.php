<?php
require_once('controller.php');
session_start();
$Userid = $_SESSION['username'];
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
echo $arrlength;
for($x = 0; $x < $arrlength; $x++) {
    $tc->addDemande($Userid, $nom, $prenom, $email, $adresse, $wilaya, $commune, $phone, $traduteurs[$x], $langueO, $langueD, $type, $comment, $assermente, $file);

}
    



?>