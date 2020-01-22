<?php
     require_once('controller.php');
     

     $langue = $_POST['langue'];
     $type_traduction = $_POST['type_traduction'];
     $nom = $_POST['nom'];
     $pro_traductorD = $_POST['type_traducteur'];

     

     $tc = new traductor_controller();
     $result = $tc->getTraductor_Asserm_Type_Lang($pro_traductorD, $langues, $typeD);
 
     foreach($result as $rs){
         
        echo '<tr class="traductor">
                <td><a href=#>'.$rs["userid"].'</a></td>
                <td style="vertical-align: middle;">
                    <img src="./assests/images/personal.jpg" width="60px"/>
                </td>
                <td style="vertical-align: middle;">'.$rs["Nom"].' '.$rs["Prenom"].'</td>
                <td>'.$rs["nbr"].'</td>
                <td>'.$rs["note"].'</td>
                <td>
                    <input type="checkbox">
                </td>
            </tr>';

            
    }

    
?>