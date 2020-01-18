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
$faxes = $_POST["fax"];


$userController = new users_controller();
$idUser = $userController->add_user($nom ,$prenom,$email,$password,$phone,$wilaya,$commune,$adresse);
$userController->add_faxes($faxes, $idUser);


ob_start();
    header('Location: main.php');
    ob_end_flush();
    die();
?>