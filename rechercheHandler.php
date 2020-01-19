<?php
     require_once('controller.php');
     

     $originL = $_POST['originL'];
     $DestinationL = $_POST['DestinationL'];
     $typeD = $_POST['typeD'];
     $pro_traductorD = $_POST['protraductorD'];

     $langues[0] = $originL;
     $langues[1] = $DestinationL;

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