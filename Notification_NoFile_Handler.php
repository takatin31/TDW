<?php
require_once('controller.php');
$idDemande = $_POST["id"];
$action= $_POST["action"];
$target= $_POST["target"];
$userId = $_COOKIE["userid"];

$notification_Controller = new NotificationInterractionController();

if (strcmp($action, "accept") == 0){
    $r = $notification_Controller->acceptDemande($idDemande, $userId, $target);
}

if (strcmp($action, "vu") == 0){
    $r = $notification_Controller->seeDemande($idDemande, $target);
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


?>