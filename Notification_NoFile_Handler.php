<?php
require_once('controller.php');
$idDemande = $_POST["id"];
$action= $_POST["action"];
$target= $_POST["target"];
$prix = $_POST["prix"];
$fileExist = $_POST["fileExist"];
$userId = $_COOKIE["userid"];

$file = "";

if ($fileExist){
    $file = $_FILES["customFile"];
}

$notification_Controller = new NotificationInterractionController();

if (strcmp($action, "accept") == 0){
    $r = $notification_Controller->acceptDemande($idDemande, $userId, $target, $prix);
    echo $r;
}

if (strcmp($action, "vu") == 0){
    $r = $notification_Controller->seeDemande($idDemande, $target, $file);
    echo $r;
}

if (strcmp($action, "vuPaiementClient") == 0){
    $r = $notification_Controller->seePaiementClient($idDemande, $target);
    echo $r;
}


if (strcmp($action, "startWork") == 0){
    $r = $notification_Controller->startWork($idDemande, $target);
    echo $r;
}

if (strcmp($action, "startVu") == 0){
    $r = $notification_Controller->seeStart($idDemande, $target);
    echo $r;
}

if (strcmp($action, "finishedVu") == 0){
    $r = $notification_Controller->seeAccepted($idDemande, $target);
    echo $r;
}


?>