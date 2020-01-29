<?php
require_once("../ControllerAdmin.php");

$idUser = $_POST["userId"];
$nom = $_POST["Nom"];
$prenom = $_POST["Prenom"];
$email = $_POST["Email"];
$phone = $_POST["Phone"];
$image = $_FILES["profilePicInput"];


$uc = new UserController();
$uc->updateInfoUser($idUser, $nom, $prenom, $email, $phone, $image);

header('location: ../Vues/tablesTraducteurs.php');

?>