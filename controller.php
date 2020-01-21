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

        public function find_user($email, $password){
            $mp = new projet_modal();
            $r = $mp->findUser($email, $password);
            return $r;
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

        public function add_Types($idUser, $types){
            $mp = new projet_modal();
            $r = $mp->addTypes($idUser, $types);
        }

        public function getTraductor_Asserm_Type_Lang($asser, $langues, $type){
            $mp = new projet_modal();
            $r = $mp->getTraductor_Ass_Type_Lng($asser, $langues, $type);
            return $r;
        }

        public function getNote($idUser){
            $mp = new projet_modal();
            $r = $mp->getNote($idUser);
            return $r;
        }
    }

    class NotificationController{
        public function getNotifications($userID){
            $this->getDemandeTNotifications($userID);
            $this->getDemandeDNotifications($userID);
            $this->getDemandeTANotifications($userID);
            $this->getDemandeDANotifications($userID);
            $this->getDemandeTPNotifications($userID);
            $this->getDemandeDPNotifications($userID);
            $this->getDemandeTDNotifications($userID);
            $this->getDemandeDDNotifications($userID);
            $this->getDemandeTFNotifications($userID);
            $this->getDemandeDFNotifications($userID);

            
            
        }

        // notification demande de traduction
        public function getDemandeTNotifications($userID){
            $mp = new projet_modal();
            //lorsque le traducteur recoit une nouvelle demande de traduction:traducteur
            $r = $mp->getDemandeTNotifications($userID);

           

            foreach($r as $lg){
                echo '<tr class="good_request demandeTraduction" id="demandeTraduction'.$lg["DemandeId"].'">
                            <td>
                                <div class="float-right">
                                    <button class="btn btn-success">Accepter</button>
                                    <button class="btn btn-danger">Refuser</button>
                                </div> 
                                Vous avez une nouvelle <a href="#">demande de traduction</a>
                            </td>
                        </tr>';
            }
        }

        // notification demande de devis
        public function getDemandeDNotifications($userID){
            $mp = new projet_modal();
            //lorsque le traducteur recoit une demande de devis:traducteur
            $r = $mp->getDemandeDNotifications($userID);

            foreach($r as $lg){
                echo '<tr class="good_request demandeDevis" id="demandeDevis'.$lg["DemandeId"].'">
                            <td>
                                <div class="float-right">
                                    <button class="btn btn-success">Accepter</button>
                                    <button class="btn btn-danger">Refuser</button>
                                </div> 
                                Vous avez une nouvelle <a href="#">demande de devis</a>
                            </td>
                        </tr>';
            }
        }

        // notification demande de traduction acceptée
        public function getDemandeTANotifications($userID){
            $mp = new projet_modal();
            //lorsque le traducteur accepte le demande:client
            $r = $mp->getDemandeTANotifications($userID);

            foreach($r as $lg){
                echo '<tr class="good_request acceptedTraduction" id="acceptedDemandeTraduction'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-secondary">Valider</button>
                            </div> 
                            Votre <a href="#">demande de traduction</a> a ete acceptée par  <a href="#">traducteur</a>
                            </td>
                        </tr>';
            }
        }

        // notification demande de devis acceptée
        public function getDemandeDANotifications($userID){
            $mp = new projet_modal();
            //lorsque le traducteur accepte le demande:client
            $r = $mp->getDemandeDANotifications($userID);

            foreach($r as $lg){
                echo '<tr class="good_request acceptedDevis" id="acceptedDemandeDevis'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-secondary">Valider</button>
                            </div> 
                            Votre <a href="#">demande de devis</a> a ete acceptée par  <a href="#">traducteur</a>
                            </td>
                        </tr>';
            }
        }

        // notification demande de traduction paiement
        public function getDemandeTPNotifications($userID){
            $mp = new projet_modal();
            //lorsque le paiement a ete accepté:client
            $r = $mp->getDemandeTPANotifications($userID);

            foreach($r as $lg){
                echo '<tr class="good_request acceptedPaiementTr" id="acceptedPaiementTr'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-secondary">Valider</button>
                            </div> 
                            Votre paiement de <a href="#">demande de traduction</a> a ete accepté par l\'administrateur
                            </td>
                        </tr>';
            }
            //lorsque le paiement n'a pas ete accepté:client
            $r = $mp->getDemandeTPDNotifications($userID);

            foreach($r as $lg){
                echo '<tr class="bad_request deniedPaiementTr" id="deniedPaiementTr'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-secondary">Payer a nouveau</button>
                            </div> 
                            Votre paiement de <a href="#">demande de traduction</a> a ete refusé par l\'administrateur
                            </td>
                        </tr>';
            }
            //lorsque le paiement a ete recu:traducteur
            $r = $mp->getDemandeTPRNotifications($userID);

            foreach($r as $lg){
                echo '<tr class="good_request receivedMTr" id="recievedPaiementTr'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-secondary">Debuter la traduction</button>
                            </div> 
                            Votre paiement a ete effectué de la <a href="#">demande de traduction</a>
                            </td>
                        </tr>';
            }
        }

        // notification demande de devis paiement
        public function getDemandeDPNotifications($userID){
            $mp = new projet_modal();
            //lorsque le paiement a ete accepté:client
            $r = $mp->getDemandeDPANotifications($userID);

            foreach($r as $lg){
                echo '<tr class="good_request acceptedPaiementDev" id="acceptedPaiementDev'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-secondary">Valider</button>
                            </div> 
                            Votre paiement de <a href="#">demande de devis</a> a ete accepté par l\'administrateur
                            </td>
                        </tr>';
            }
            //lorsque le paiement n'a pas ete accepté:client
            $r = $mp->getDemandeDPDNotifications($userID);

            foreach($r as $lg){
                echo '<tr class="bad_request deniedPaiementDev" id="deniedPaiementDv'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-secondary">Payer a nouveau</button>
                            </div> 
                            Votre paiement de <a href="#">demande de devis</a> a ete refusé par l\'administrateur
                            </td>
                        </tr>';
            }

            //lorsque le paiement a ete recu:traducteur
            $r = $mp->getDemandeDPRNotifications($userID);

            foreach($r as $lg){
                echo '<tr class="good_request receivedMTDv" id="recievedPaiementDv'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-secondary">Debuter la traduction</button>
                            </div> 
                            Votre paiement a ete effectué de <a href="#">demande de devis</a>
                            </td>
                        </tr>';
            }
        }

        // notification de traduction debutée
        public function getDemandeTDNotifications($userID){
            $mp = new projet_modal();
            //lorsque la traduction a debutée:client
            $r = $mp->getDemandeTDNotifications($userID);
           
            foreach($r as $lg){
                echo '<tr class="good_request beganTraduction" id="demandeTraduction'.$lg["DemandeId"].'">
                        <td>
                        <div class="float-right">
                            <button class="btn btn-secondary">Valider</button>
                        </div> 
                        La traduction de la <a href="#">demande de traduction</a> a debutée
                        </td>
                    </tr>';
            }
        }

        // notification de devis débutée
        public function getDemandeDDNotifications($userID){
            $mp = new projet_modal();
            //lorsque le devis a debutée:client
            $r = $mp->getDemandeDDNotifications($userID);

            foreach($r as $lg){
                echo '<tr class="good_request beganDevis" id="demandeDevis'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-secondary">Valider</button>
                            </div> 
                            Le traitement  de vote <a href="#">demande de devis</a> a debutée
                            </td>
                        </tr>';
            }
        }

        // notification de traduction finie
        public function getDemandeTFNotifications($userID){
            $mp = new projet_modal();
            //lorsque le traducteur fini la traduction:client
            $r = $mp->getDemandeTFNotifications($userID);

            foreach($r as $lg){
                echo '<tr class="good_request finishedTraduction" id="finishedTraduction'.$lg["DemandeId"].'">
                            <td>
                                <div>
                                    <div class="float-right">
                                        <button class="btn btn-success">Valider</button>
                                        <button class="btn btn-danger">Refuser</button>
                                    </div> 
                                    Votre traduction de <a href="#">demande de traduction</a> a finie
                                </div>
                                <button class="btn btn-info mt-2">Telecharger le document traduit</button>
                            </td>
                        </tr>';
            }

            //lorsque le client valide la traduction:traducteur
            $r = $mp->getDemandeTFANotifications($userID);

            foreach($r as $lg){
                echo '<tr class="good_request accedptedTraduction" id="accedptedTraduction'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-warning">Valider</button>
                            </div> 
                            Votre traduction de <a href="#">demande de traduction</a> a été accepté par le client
                            </td>
                        </tr>';
                //pour notifier le traducteur que le montant a été payé
                echo '<tr class="good_request paimentRecievedTraduction" id="paimentRecievedTraduction'.$lg["DemandeId"].'">
                        <td>
                           <div class="float-right">
                               <button class="btn btn-warning">Valider</button>
                           </div> 
                           Vous avez recu le paiement pour cette <a href="#">demande de traduction</a>
                        </td>
                    </tr>';
            }

            //lorsque le client refuse la traduction:traducteur
            $r = $mp->getDemandeTFDNotifications($userID);

            foreach($r as $lg){
                echo '<tr class="bad_request deniedTraduction" id="deniedTraduction'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-secondary">Envoyer a nouveau</button>
                            </div> 
                            Votre traduction de <a href="#">demande de traduction</a> a été rejeté par le client
                            </td>
                        </tr>';

                
            }

        }

        // notification de devis finie
        public function getDemandeDFNotifications($userID){
            $mp = new projet_modal();
            //lorsque le traducteur fini le devis:client
            $r = $mp->getDemandeDFNotifications($userID);

            foreach($r as $lg){
                echo '<tr class="good_request finishedDevis" id="finishedDevis'.$lg["DemandeId"].'">
                            <td>
                                <div>
                                    <div class="float-right">
                                        <button class="btn btn-secondary">Valider</button>
                                    </div>
                                    Votre Devis a finie suite a <a href="#">cette demande</a> 
                                </div>
                                <button class="btn btn-info mt-2">Telecharger le document de reponse</button>
                            </td>
                        </tr>';
            }

            //lors de la reception du paiement:traducteur
            $r = $mp->getDemandeDFNotifications($userID);
            foreach($r as $lg){
                echo '<tr class="good_request paimentRecievedDevis" id="paimentRecievedDevis'.$lg["DemandeId"].'">
                            <td>
                            <div class="float-right">
                                <button class="btn btn-warning">Valider</button>
                            </div> 
                            Vous avez recu le paiement pour cette <a href="#">demande de devis</a>
                            </td>
                        </tr>';
            }
        }
    }

    class NotificationInterractionController{
        public function acceptDemande($idDemande, $traductorId, $table){
            $mp = new projet_modal();
            if (strcmp($table, "traduction") == 0){
                $r = $mp->acceptDemandeTraduction($idDemande, $traductorId);
            }else{
                $r = $mp->acceptDemandeDevis($idDemande, $traductorId);
            }
            return $r;
            
        }

        public function seeDemande($idDemande, $table){
            $mp = new projet_modal();
            if (strcmp($table, "traduction") == 0){
                $r = $mp->seeDemandeTraduction($idDemande);
            }else{
                $r = $mp->seeDemandeDevis($idDemande);
            }
            return $r; 
        }

        public function seePaiementClient($idDemande, $table){
            $mp = new projet_modal();
            if (strcmp($table, "traduction") == 0){
                $r = $mp->seePaiementClientTraduction($idDemande);
            }else{
                $r = $mp->seePaiementClientDevis($idDemande);
            }
            return $r; 
        }

        public function startWork($idDemande, $table){
            $mp = new projet_modal();
            if (strcmp($table, "traduction") == 0){
                $r = $mp->startWorkTraduction($idDemande);
            }else{
                $r = $mp->startWorkDevis($idDemande);
            }
            return $r; 
        }

        public function seeStart($idDemande, $table){
            $mp = new projet_modal();
            if (strcmp($table, "traduction") == 0){
                $r = $mp->seeStartTraduction($idDemande);
            }else{
                $r = $mp->seeStartDevis($idDemande);
            }
            return $r; 
        }
        
    }

    class demande_traduction_controller{
        public function addDemande($Userid, $nom, $prenom, $email, $adresse, $wilaya, $commune, $phone, $langueO, $langueD, $type, $comment, $assermente, $file, $typeDemande){
            $mp = new projet_modal();
            $r = $mp->insertTraductionDemande($Userid, $nom, $prenom, $email, $adresse, $wilaya, $commune, $phone, $langueO, $langueD, $type, $comment, $assermente, $file, $typeDemande);
            return $r;
        }

        public function addRecevoirDemandeT($demandeId, $TraductorId, $typeDemande){
            $mp = new projet_modal();
            $r = $mp->addRecevoirDemandeT($demandeId, $TraductorId, $typeDemande);
            return $r;
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
            $idLangue = $r->fetch_assoc(); // fetch it first
            return $idLangue['Id'];
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
            $idWilaya = $r->fetch_assoc(); // fetch it first
            return $idWilaya['Id'];
        }

        public function getCommuneID($wilayaId, $commune){
            $mp = new projet_modal();
            $r = $mp->getCommuneID($wilayaId, $commune);
            $idCommune = $r->fetch_assoc(); // fetch it first
            return $idCommune['Id'];
        }
    }

?>