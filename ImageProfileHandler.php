<?php
    require_once("controller.php");
    $image = $_FILES["profileImage"];
    $uc = new users_controller();
    $userId = $_COOKIE["userid"];
    $r = $uc->addImage($userId, $image);
    echo $r;
?>