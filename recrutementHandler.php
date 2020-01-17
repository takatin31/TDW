<?php
require_once('controller.php');
$nom = $_POST["nom"];
$prenom= $_POST["prenom"];
$email= $_POST["email"];
$password= $_POST["password"];
$phone= $_POST["phone"];
$wilaya= $_POST["wilaya"];
$commune= $_POST["commune"];
$adresse= $_POST["adresse"];
$assermentationP= $_POST["assermentationP"];
$cv= $_POST["cv"];
$reference1= $_POST["reference1"];
$reference2= $_POST["reference2"];
$reference3= $_POST["reference3"];


$cf = new recrutement_controller();
$result = $cf->add_user($nom ,$prenom,$email,$password,$phone,$wilaya,$commune,$adresse);

?>