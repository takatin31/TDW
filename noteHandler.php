<?php
require_once('controller.php');

$idDemande = $_POST["demandeid"];
$type= $_POST["type"];
$userId = $_COOKIE["userid"];
$nc = new NoteController();

if (isset($_POST["note"])){
    $note = $_POST["note"];
    $r = $nc->noter($idDemande, $userId, $note, $type);
}else{
    $r = $nc->doNotNoter($idDemande, $userId, $type);
}








?>