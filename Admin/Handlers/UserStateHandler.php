<?php
require_once("../ControllerAdmin.php");

$idUser = $_POST["idUser"];
$action = $_POST["action"];

$uc = new UserController();

if (strcmp($action, "block") == 0){
    $uc->bloquerUser($idUser);
}

if (strcmp($action, "deblock") == 0){
    $uc->debloquerUser($idUser);
}

if (strcmp($action, "delete") == 0){
    $uc->supprimerUser($idUser);
}
?>