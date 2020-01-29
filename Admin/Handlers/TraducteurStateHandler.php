<?php
require_once("../ControllerAdmin.php");

$idUser = $_POST["idUser"];
$action = $_POST["action"];

$uc = new TraducteurController();

if (strcmp($action, "accept") == 0){
    $uc->acceptTraducteur($idUser);
}

if (strcmp($action, "decline") == 0){
    $uc->declineTraducteur($idUser);
}

?>