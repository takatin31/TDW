<?php
require_once("../ControllerAdmin.php");
$typeUser = $_POST["typeUser"];
$idUser = $_POST["idUser"];
$action = $_POST["action"];

if (strcmp($action, "view") == 0){
    if (strcmp($typeUser, "client") == 0){
        $cc = new ClientController();
        $r = $cc->getClientInfo($idUser);
        echo '<div class="row">
                <div class="col-md-3">
                <div class="form-group">
                    <label class="bmd-label-floating">Nom</label>
                    <input type="text" class="form-control" value="'.$r["Nom"].'" disabled>
                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                    <label class="bmd-label-floating">Prenom</label>
                    <input type="text" class="form-control" value="'.$r["Prenom"].'" disabled>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Email</label>
                    <input type="email" class="form-control" value="'.$r["Email"].'" disabled>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                <div class="form-group">
                    <label class="bmd-label-floating">Wilaya</label>
                    <input type="text" class="form-control" value="'.$r["wilaya"].'" disabled>
                </div>
                </div>
                <div class="col-md-2">
                <div class="form-group">
                    <label class="bmd-label-floating">Commune</label>
                    <input type="text" class="form-control" value="'.$r["commune"].'" disabled>
                </div>
                </div>
                <div class="col-md-8">
                <div class="form-group">
                    <label class="bmd-label-floating">Adresse</label>
                    <input type="text" class="form-control" value="'.$r["Adresse"].'" disabled>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Numero de telephone</label>
                    <input type="text" class="form-control" value="'.$r["Phone"].'" disabled>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Fax</label>
                    <select class="custom-select">';
                    $uc = new UserController();
                    $faxes = $uc->getUserFaxes($idUser);
                    foreach($faxes as $fax){
                        echo '<option>'.$fax["fax"].'</option>';
                    }
                                    
          echo '</select>
                </div>
                </div>
            </div>';
        
    }else{
        $cc = new TraducteurController();
        $r = $cc->getTraducteurInfo($idUser);
        echo '<div class="row">
                <div class="col-md-3">
                <div class="form-group">
                    <label class="bmd-label-floating">Nom</label>
                    <input type="text" class="form-control" value="'.$r["Nom"].'" disabled>
                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                    <label class="bmd-label-floating">Prenom</label>
                    <input type="text" class="form-control" value="'.$r["Prenom"].'" disabled>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Email</label>
                    <input type="email" class="form-control" value="'.$r["Email"].'" disabled>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                <div class="form-group">
                    <label class="bmd-label-floating">Wilaya</label>
                    <input type="text" class="form-control" value="'.$r["wilaya"].'" disabled>
                </div>
                </div>
                <div class="col-md-2">
                <div class="form-group">
                    <label class="bmd-label-floating">Commune</label>
                    <input type="text" class="form-control" value="'.$r["commune"].'" disabled>
                </div>
                </div>
                <div class="col-md-8">
                <div class="form-group">
                    <label class="bmd-label-floating">Adresse</label>
                    <input type="text" class="form-control" value="'.$r["Adresse"].'" disabled>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                    <label class="bmd-label-floating">Lanuges</label>
                    <select class="custom-select">';
                    $langues = $cc->getTraducteurLangues($idUser);
                    foreach($langues as $langue){
                        echo '<option>'.$langue["Nom"].'</option>';
                    }
                                    
          echo '</select>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label class="bmd-label-floating">Type de traduction</label>
                    <select class="custom-select">';
                    $types = $cc->getTraducteurTypes($idUser);
                    foreach($types as $type){
                        echo '<option>'.$type["Type"].'</option>';
                    }
                                    
          echo '</select>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label class="bmd-label-floating">Fax</label>
                    <select class="custom-select">';
                    $uc = new UserController();
                    $faxes = $uc->getUserFaxes($idUser);
                    foreach($faxes as $fax){
                        echo '<option>'.$fax["fax"].'</option>';
                    }
                                    
          echo '</select>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating">Numero de telephone</label>
                    <input type="text" class="form-control" value="'.$r["Phone"].'" disabled>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label class="bmd-label-floating">Assermenté</label>
                    <input type="text" class="form-control" value="'.$r["AssermenteEtat"].'" disabled>
                </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-5">
                <div class="form-group">
                    <label class="bmd-label-floating">Cv</label>
                    </br>
                    <a class="btn btn-primary btn-sm" href="../../uploads/CVs/'.$r["Cv"].'">Telecharger le CV</a>
                </div>
                </div>';
    
        $refs = $cc->getTraducteurReferences($idUser);
        foreach($refs as $ref){
            echo '<div class="col-md-2">
                <div class="form-group">
                    <label class="bmd-label-floating">Ref</label>
                    </br>
                    <a class="btn btn-primary btn-sm" href="../../uploads/References/'.$ref["Document"].'">Telecharger la Ref</a>
                </div>
                </div>';
        }
              
        echo '</div>';
    }
}else{
    if (strcmp($typeUser, "client") == 0){
        $cc = new ClientController();
        $r = $cc->getClientInfo($idUser);
        echo '<div class="col-md-2 mt-2 text-center">
                    <img src="../../uploads/profile_pics/'.$r["Image"].'" class="img-fluid"/>
                    <a href="#">Uploader une image</a>
                </div>
                <div class="col-md-10">
                <form>
                    <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label class="bmd-label-floating">Nom</label>
                        <input type="text" class="form-control" value="'.$r["Nom"].'">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label class="bmd-label-floating">Prenom</label>
                        <input type="text" class="form-control" value="'.$r["Prenom"].'">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="bmd-label-floating">Email</label>
                        <input type="email" class="form-control" value="'.$r["Email"].'">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="bmd-label-floating">Numero de telephone</label>
                        <input type="text" class="form-control" value="'.$r["Phone"].'">
                        </div>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Modifier Profile</button>
                    <div class="clearfix"></div>
                </form>
                </div>';
    }else{
        $cc = new TraducteurController();
        $r = $cc->getTraducteurInfo($idUser);
        echo '<div class="col-md-2 mt-2 text-center">
                    <img src="../../uploads/profile_pics/'.$r["Image"].'" class="img-fluid"/>
                    <a href="#">Uploader une image</a>
                </div>
                <div class="col-md-10">
                <form>
                    <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label class="bmd-label-floating">Nom</label>
                        <input type="text" class="form-control" value="'.$r["Nom"].'">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label class="bmd-label-floating">Prenom</label>
                        <input type="text" class="form-control" value="'.$r["Prenom"].'">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="bmd-label-floating">Email</label>
                        <input type="email" class="form-control" value="'.$r["Email"].'">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="bmd-label-floating">Numero de telephone</label>
                        <input type="text" class="form-control" value="'.$r["Phone"].'">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label class="bmd-label-floating">Assermenté</label>
                        <input type="text" class="form-control" value="'.$r["AssermenteEtat"].'">
                        </div>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Modifier Profile</button>
                    <div class="clearfix"></div>
                </form>
                </div>';
    }
}




?>