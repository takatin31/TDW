<?php
require_once('controller.php');
$idDemande = $_POST["id"];
$type = $_POST["type"];
$action = $_POST["action"];
$fileExist = $_POST["fileExist"];
$userId = $_COOKIE["userid"];

$file = "";

if ($fileExist){
    $file = $_FILES["customFile"];  
}


$resultC = new ResultController();

if (strcmp($action, "sendFile") == 0){
    $r = $resultC->addFinalFile($idDemande, $type, $file);
}

if (strcmp($action, "valideClient") == 0){
    $r = $resultC->clientValideFinal($idDemande, $type);
}

if (strcmp($action, "RefuseClient") == 0){
    $r = $resultC->clientDeclineFinal($idDemande, $type);
}

if (strcmp($action, "valideTraducteur") == 0){
    $r = $resultC->TraductorValideFinal($idDemande, $type);
}

echo $r;
?>