<?php
    require_once("controller.php");
    $userId = $_COOKIE["userid"];
    $traducteur = $_POST["traducteur"];
    $cause = $_POST["cause"];

    $sH = new SignalController();
    $r = $sH->signaler($userId, $traducteur, $cause);
    echo $r;

?>