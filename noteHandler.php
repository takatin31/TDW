<?php
require_once('controller.php');

$idDemande = $_POST["demandeid"];
$type= $_POST["type"];
$note = $_POST["note"];

$userId = $_COOKIE["userid"];

$nc = new NoteController();

$r = $nc->noter($idDemande, $userId, $note, $type);
echo $r;
?>