<?php
require_once("../ControllerAdmin.php");
$typeUser = $_POST["typeUser"];
$idUser = $_POST["idUser"];
$typeDemande = $_POST["typeDemande"];

if (strcmp($typeUser, "client") == 0){
    $cc = new ClientController();

}else{
    $tc = new TraducteurController();
    $r = $tc->getHistoryTraducteurTraduction($idUser, $typeDemande);
    foreach($r as $lg){
        echo '<tr>
                <td>'.$lg["Id"].'</td>
                <td>'.$lg["Email"].'</td>
                <td>'.$lg["Type"].'</td>
                <td>'.$lg["Date"].'</td>
            </tr>';
    }
}

?>