<?php

    require_once('modal.php');


    class recrutement_controller {

        public function get_langues(){
            $mp = new projet_modal();
            $r = $mp->getLangues();
            return $r;
        }

        public function get_wilayas(){
            $mp = new projet_modal();
            $r = $mp->getWilayas();
            return $r;
        }

        public function get_commune($wilaya){
            $mp = new projet_modal();
            $r = $mp->getCommunes($wilaya);
            return $r;
        }

        public function getWilayaID($wilaya){
            $mp = new projet_modal();
            $r = $mp->getWilayaID($wilaya);
            foreach($r as $lg){
                $idWilaya = $lg['Id'];
            }
            return $idWilaya;
        }

        public function getCommuneID($wilayaId, $commune){
            $mp = new projet_modal();
            $r = $mp->getCommuneID($wilayaId, $commune);
            foreach($r as $lg){
                $idWilaya = $lg['Id'];
            }
            return $idWilaya;
        }

        public function add_user($nom ,$prenom,$email,$password,$phone,$wilaya,$commune,$adresse){
            $mp = new projet_modal();
            $idWilaya = $this->getWilayaID($wilaya);
            $idCommune = $this->getCommuneID($idWilaya, $commune);
            
            
            
            $r = $mp->addUser($nom ,$prenom,$email,$password,$phone,$idWilaya,$idCommune,$adresse);
        }


    }

?>