<?php

    require_once('modal.php');


    class users_controller {

        public function add_user($nom ,$prenom,$email,$password,$phone,$wilaya,$commune,$adresse){
            $mp = new projet_modal();
            $ac = new adresse_controller();
            $idWilaya = $ac->getWilayaID($wilaya);
            $idCommune = $ac->getCommuneID($idWilaya, $commune);
            
            $r = $mp->addUser($nom ,$prenom,$email,$password,$phone,$idWilaya,$idCommune,$adresse);
            return $r;
        }

        public function add_faxes($faxes, $userID){
            $mp = new projet_modal();
            $r = $mp->addFaxes($faxes, $userID);
        }
    }

    class traductor_controller {
        public function add_langues($langues, $userID){
            $mp = new projet_modal();
            $lc = new langues_controller();
            $arrlength = count($langues);
            
            for($x = 0; $x < $arrlength; $x++) {
                $languesID[$x] = $lc->get_langueId($langues[$x]);
            }

            $r = $mp->addLangues($languesID, $userID);
        }

        public function add_Data($traductorId, $cv, $assermentation){
            $mp = new projet_modal();
            $r = $mp->addData($traductorId, $cv, $assermentation);
        }

        public function add_References($idUser, $references){
            $mp = new projet_modal();
            $r = $mp->addReferences($idUser, $references);
        }
    }

    class langues_controller {
        public function get_langues(){
            $mp = new projet_modal();
            $r = $mp->getLangues();
            return $r;
        }

        public function get_langueId($langue){
            $mp = new projet_modal();
            $r = $mp->getLangueId($langue);
            foreach($r as $lg){
                $idLangue = $lg['Id'];
            }
            return $idLangue;
        }
    }

    class adresse_controller {

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
    }

?>