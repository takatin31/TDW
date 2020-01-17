<?php
     require_once('controller.php');
     $wilaya = $_POST['wilaya'] ;
     $cf = new recrutement_controller();
     $result = $cf->get_commune($wilaya);

     foreach($result as $rs){
          echo '<option>'.$rs['Nom'].'</option>';
     }

?>