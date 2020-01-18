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
$assermentationP= $_FILES["assermentationP"];
$cv= $_FILES["cv"];
$reference1= $_FILES["reference1"];
$reference2= $_FILES["reference2"];
$reference3= $_FILES["reference3"];
$faxes = $_POST["fax"];
$langues = $_POST["langues"]; 

$references[0] = $reference1;
$references[1] = $reference2;
$references[2] = $reference3;

echo count($references);

$userController = new users_controller();
$idUser = $userController->add_user($nom ,$prenom,$email,$password,$phone,$wilaya,$commune,$adresse);
$userController->add_faxes($faxes, $idUser);

$traductorController = new traductor_controller();
$traductorController->add_langues($langues, $idUser);

$traductorController->add_Data($idUser, $cv, $assermentationP);
$traductorController->add_References($idUser, $references);
?>