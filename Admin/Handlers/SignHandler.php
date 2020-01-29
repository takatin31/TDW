<?php
require_once("../ControllerAdmin.php");
$email = $_POST["email"];
$pass = $_POST["pass"];
$action = $_POST["action"];

$ac = new AdminController();

if (strcmp($action, "connexion") == 0){
    $r = $ac->isAdmin($email, $pass);
    echo $r;
    if (strcmp($r, "0") == 0){
        echo 'problem';
    }else{
        setcookie("adminId", $email, time() + (24 * 60 * 60 * 7), "/");
        echo 'ok';
    }
}else if (strcmp($action, "inscription") == 0){
    $ac->adminInscription($email, $pass);
    echo 'ok';
}else{
    setcookie("adminId", "test", time() - 3600, "/");
    echo 'ok';
}

?>