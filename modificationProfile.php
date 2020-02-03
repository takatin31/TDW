<?php
require_once("controller.php");

$userId = $_COOKIE["userid"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$pass = $_POST["password"];
$phone = $_POST["phone"];
$wilaya = $_POST["wilaya"];
$commune = $_POST["commune"];
$adresse = $_POST["adresse"];


$uc = new users_controller();

$uc->updateInfo($userId, $nom, $prenom, $email, $pass, $phone, $wilaya, $commune, $adresse);

header('location: main.php');


?>