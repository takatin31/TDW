<?php
require_once("../ControllerAdmin.php");
$typeUser = $_POST["typeUser"];
$idUser = $_POST["idUser"];

if (strcmp($typeUser, "client") == 0){
    $cc = new ClientController();

}else{
    $tc = new TraducteurController();
    $r = $tc->getNoteHistoryTraducteur($idUser);
    foreach($r as $lg){
        echo '<tr>
                <td>'.$lg["Email"].'</td>
                <td>'.$lg["Valeur"].'</td>
                <td>'.$lg["Date"].'</td>
            </tr>';
    }
}

?>