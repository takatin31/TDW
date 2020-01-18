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
  	$_SESSION['success'] = "You are now logged in";
  	header('location: main.php');
}



?>