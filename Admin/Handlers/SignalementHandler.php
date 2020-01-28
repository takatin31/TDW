<?php
require_once("../ControllerAdmin.php");
$typeUser = $_POST["typeUser"];
$idUser = $_POST["idUser"];

if (strcmp($typeUser, "client") == 0){
    $cc = new ClientController();
    $r = $cc->getSignalementHistoryClient($idUser);
    foreach($r as $lg){
        echo '<tr>
                <td>'.$lg["Email"].'</td>
                <td>'.$lg["Date"].'</td>
                <td>'.$lg["Cause"].'</td>
            </tr>';
    }
}else{
    $tc = new TraducteurController();
    $r = $tc->getSignalementHistoryTraducteur($idUser);
    foreach($r as $lg){
        echo '<tr>
                <td>'.$lg["Email"].'</td>
                <td>'.$lg["Date"].'</td>
                <td>'.$lg["Cause"].'</td>
            </tr>';
    }
}

?>