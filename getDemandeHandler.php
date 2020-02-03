<?php
require_once('controller.php');
$idDemande = $_POST["id"];
$type = $_POST["type"];
$action = $_POST["action"];



$notification_Controller = new demandeController();

if (strcmp($action, "recieved") == 0){
    $r = $notification_Controller->getDemandeInfoFromRecieved($idDemande, $type);
}

if (strcmp($action, "accepted") == 0){
    $r = $notification_Controller->getDemandeInfoFromAccepted($idDemande, $type);
}

if (strcmp($action, "paiement") == 0){
    $r = $notification_Controller->getDemandeInfoFromPaiement($idDemande, $type);
}

if (strcmp($action, "started") == 0){
    $r = $notification_Controller->getDemandeInfoFromStarted($idDemande, $type);
}

if (strcmp($action, "finished") == 0){
    $r = $notification_Controller->getDemandeInfoFromFinished($idDemande, $type);
}

echo '<input type="hidden" id="demandeId" value="'.$idDemande.'"></input>';

foreach ($r as $lg){
    foreach($lg as $key => $value){
        echo '<div class="row">
                    <div>
                        <label class="titre"> <h2> <b>'.$key.' </b>: </h2></label>
                    </div>
                    <div>
                        <label class="valeur"> <h2> '.$value.' </h2> </label>
                    </div>
                </div>';
    }
}



if (strcmp($action, "started") == 0){
    $tc = new traductor_controller();
    
    $r = $tc->isTraductor($_COOKIE["userid"]);
    
    if (strcmp($r, "1") == 0){
        echo '<button class="btn btn-primary float-right" id="send'.$type.'" data-toggle="modal" data-target="#modalfinalFile'.$type.'">Envoyer fichier finale</button>';
    }
}


?>