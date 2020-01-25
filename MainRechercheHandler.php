<?php
     require_once('controller.php');
     

     $langue = $_POST['langue'];
     $type_traduction = $_POST['type_traduction'];
     $nom = $_POST['nom'];
     $pro_traductorD = $_POST['type_traducteur'];

     

     $tc = new traductor_controller();
     $result = $tc->getTraductor_Nom_Asserm_Type_Lang($nom,$pro_traductorD, $langue, $type_traduction);
 
     foreach($result as $rs){


    echo '<div class="row result">
            <div class="col-2">
              <img src="./uploads/profile_pics/'.$rs["Image"].'" class="img-fluid"/>
            </div>

            <div class="col-10 row justify-content-center">
              <div class="col-5">
                <div>
                  <h4>'.$rs["Nom"].' '.$rs["Prenom"].'</h4>
                  <br/>
                </div>
                <div>';
                
    $r = $tc->getTypes($rs['userid']);

    foreach($r as $type){
        echo '<div class="btn btn-default '.$type["Type"].'-tag">'.$type["Type"].'</div>';
    }
    
    echo '</div>
            </div>

            <div class="col-7 d-flex flex-column align-items-end justify-content-between pr-5">
            <div class="row">
                <h6 class="mr-2">Rating</h6>';
                
    for ($i =0; $i < $rs["note"]; $i++){
        echo '<i class="fa fa-star active-star"></i>';
    }

    for ($i = $rs["note"]; $i < 5; $i++){
        echo ' <i class="fa fa-star"></i>';
    }
                  
    echo '<br/>
                </div>
                <br/>
                <div class="btn btn-default visit-profil-btn">Visiter Profil</div>
            </div>
            
            </div>
            </div>
            <hr style="width: 75%;"/>';           
            
    }

  

    
?>