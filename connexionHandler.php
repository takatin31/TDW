<?php
require_once('controller.php');

$email= $_POST["email"];
$password= $_POST["password"];



$userController = new users_controller();
$idUser = $userController->find_user($email,$password);

if (strcmp($idUser, '') == 0){
    //user not existing
}else{
    session_start();
    $_SESSION['username'] = $idUser;
    setcookie("userid", $idUser, time() + (24 * 60 * 60 * 7), "/");
    $tc = new traductor_controller();
    $r = $tc->isTraductor($idUser);
    if ($r == 0){
        setcookie("type", "client", time() + (24 * 60 * 60 * 7), "/");
    }else{
        setcookie("type", "traducteur", time() + (24 * 60 * 60 * 7), "/");
    }
  	header('location: main.php');
}



?>