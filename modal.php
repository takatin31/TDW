<?php

require_once('controller.php');
class projet_modal{
    
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $dbname = "tdw";

    private function connexion($servername, $username, $password, $dbname){
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        return $conn;
    }

    private function deconnexion($conn){
        mysqli_close($conn);
    }

    public function isTraductor($idUser){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT 
                CASE
                when (
                select count(*) nbr
                from traducteurdata
                WHERE TraducteurId = ".$idUser.") = 0 THEN false
                else true
                end as result";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getLangues(){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "Select Nom from Langue";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getWilayas(){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "Select Nom from Wilaya";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getCommunes($wilaya){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "Select Commune.Nom from Commune JOIN Wilaya ON Commune.WilayaId = Wilaya.Id WHERE Wilaya.nom = '".$wilaya."'";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getWilayaID($wilaya){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "Select Id from Wilaya WHERE nom = '".$wilaya."'";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getCommuneID($wilayaId, $commune){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "Select Id from Commune WHERE nom = '".$commune."' AND WilayaId = '".$wilayaId."'";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getLangueId($langue){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "Select Id from Langue WHERE nom = '".$langue."'";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }
    
    public function addUser($nom ,$prenom,$email,$password,$phone,$wilaya,$commune,$adresse){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "INSERT INTO Utilisateur (Nom, Prenom, Email, Password, WilayaId, Commune, Adresse, Phone)
                values(
                    '".$nom."',
                    '".$prenom."',
                    '".$email."',
                    '".$password."',
                    ".$wilaya.",
                    ".$commune.",
                    '".$adresse."',
                    ".$phone."
                    );";

        $r = $conn->query($rq);
        $id = $conn->insert_id;
        $this->deconnexion($conn);
        return $id;
    }

    public function getTraductor_Ass_Type_Lng($asserm, $langues, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        
        if (strcmp($asserm, 'true') == 0){
            $asser_doc = 'NOT NULL';
        }else{
            $asser_doc = 'NULL';
        }

        $rq = "SELECT t3.*, t4.note, t5.nbr
                FROM
                (
                select U.id userid, GROUP_CONCAT(L.Nom SEPARATOR ' ') langues
                from utilisateur U
                JOIN maitriselangue ML
                ON U.Id = ML.TraducteurId
                JOIN langue L
                ON L.Id = ML.LangueId
                group by U.id
                HAVING GROUP_CONCAT(L.Nom SEPARATOR ' ') like '%".$langues[0]."%'
                and GROUP_CONCAT(L.Nom SEPARATOR ' ') like '%".$langues[1]."%'
                ) as t1
                JOIN
                (
                select U.id userid, MT.Type
                from utilisateur U
                JOIN maitrisetype MT
                ON U.Id = MT.TraducteurId
                    where mt.Type in ('Generale')
                ) as t2
                on t1.userid = t2.userid
                JOIN
                (
                    select U.Id userid, U.Image Image, U.Nom Nom, U.Prenom Prenom
                from utilisateur U
                JOIN traducteurdata TD
                ON U.Id = TD.TraducteurId
                WHERE TD.Assermetation_doc is ".$asser_doc."
                    )as t3
                    on t3.userid = t2.userid
                JOIN (
                    select U.id userid, 
                    CASE
                    when AVG(N.valeur) is NULL then 0
                    when AVG(N.valeur) is NOT NULL then AVG(N.valeur)
                    END as note
                    from utilisateur U
                    LEfT Join note N
                    On U.Id = N.TraducteurId
                    group by u.Id
                    ) as t4
                    on t3.userid = t4.userid
                JOIN (
                    select u.id userid, COUNT(tf.Id) nbr
                    from utilisateur u
                    LEFT join demandet_accepte da
                    on u.Id = da.TraducteurId
                    left join traduction_debutee td
                    on td.DemandeId = da.Id
                    left join traduction_finie tf
                    on tf.TraductionId = td.Id
                    group by u.id
                    )as t5
                    on t4.userid = t5.userid";

                
        $result = $conn->query($rq);     
        $this->deconnexion($conn);
        return $result;
    }

    public function insertTraductionDemande($Userid, $nom, $prenom, $email, $adresse, $wilaya, $commune, $phone, $langueO, $langueD, $type, $comment, $assermente, $file, $typeDemande){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $docName = $this->addDemandeDocument($file);

        $r = $this->getLangueId($langueO);
        $langueOrigine = array_values($r->fetch_assoc())[0];

        $r = $this->getLangueId($langueD);
        $langueDest = array_values($r->fetch_assoc())[0];

        $r = $this->getWilayaID($wilaya);
        $wilayaId = array_values($r->fetch_assoc())[0];
        $r = $this->getCommuneID($wilayaId, $commune);
        $communeId = array_values($r->fetch_assoc())[0];
 
        $rq = "INSERT INTO Demande_".$typeDemande." (UtilisateurId, Nom, Prenom, Email, WilayaId, CommuneId, Adresse, Phone, LangueO, LangueD, Type, Comment, Assermente, Document)
                values(
                    ".$Userid.",
                    '".$nom."',
                    '".$prenom."',
                    '".$email."',
                    ".$wilayaId.",
                    ".$communeId.",
                    '".$adresse."',
                    ".$phone.",
                    '".$langueOrigine."',
                    '".$langueDest."',
                    '".$type."',
                    '".$comment."',
                    ".$assermente.",
                    '".$docName."'
                    );";
                
        $r = $conn->query($rq);
       
        $id = $conn->insert_id;
        $this->deconnexion($conn);
        return $id;
    }

    public function acceptDemandeTraduction($idDemande, $traductorId, $prix){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "INSERT INTO DemandeT_Accepte (DemandeId, TraducteurId, Prix) VALUES (".$idDemande.", ".$traductorId.", ".$prix.");";
        $r = $conn->query($rq);
        $rq = "UPDATE RecevoireDemandeT SET Vu = true WHERE DemandeId= ".$idDemande." AND TraducteurId = ".$traductorId.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function acceptDemandeDevis($idDemande, $traductorId, $prix){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "INSERT INTO DemandeD_Accepte (DemandeId, TraducteurId, Prix) VALUES (".$idDemande.", ".$traductorId.", ".$prix.");";
        $r = $conn->query($rq);
        $rq = "UPDATE RecevoireDemandeD SET Vu = true WHERE DemandeId= ".$idDemande." AND TraducteurId = ".$traductorId.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function seeDemandeTraduction($idDemande, $file){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $docName = $this->addPaymentDocument($file);
        $rq1 = "INSERT INTO DemandeT_paiement (DemandeId, Etat, Document) VALUES (".$idDemande.", 1, '".$docName."');";
        $r = $conn->query($rq1);
        $rq = "UPDATE DemandeT_Accepte SET Vu = true WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq1;
    }

    public function seeDemandeDevis($idDemande, $file){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $docName = $this->addPaymentDocument($file);
        $rq = "INSERT INTO DemandeD_paiement (DemandeId, Etat, Document) VALUES (".$idDemande.", 1, '".$docName."');";
        $r = $conn->query($rq);
        $rq = "UPDATE DemandeD_Accepte SET Vu = true WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function seePaiementClientTraduction($idDemande){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE DemandeT_paiement SET VuClient = true WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function seePaiementClientDevis($idDemande){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE DemandeD_paiement SET VuClient = true WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function startWorkTraduction($idDemande){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq1 = "INSERT INTO Traduction_debutee (DemandeId) VALUES (".$idDemande.");";
        $r = $conn->query($rq1);
        $rq = "UPDATE DemandeT_paiement SET Vutraductor = true WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq1;
    }

    public function startWorkDevis($idDemande){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "INSERT INTO Devis_debutee (DemandeId) VALUES (".$idDemande.");";
        $r = $conn->query($rq);
        $rq = "UPDATE DemandeD_paiement SET Vutraductor = true WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function seeStartTraduction($idDemande){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE Traduction_debutee SET Vu = true WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function seeStartDevis($idDemande){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE Devis_debutee SET Vu = true WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function getDemandeInfoFromRecieved($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT Nom, Prenom, Email, Phone, LangueO, LangueD,Type, Comment
                FROM demande_".$type."
                WHERE Id = ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeInfoFromAccepted($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT Nom, Prenom, Email, Phone, LangueO, LangueD,Type, Comment
                FROM demande_".$type." T1
                JOIN Demande".$type[0]."_Accepte DA
                ON T1.Id = DA.DemandeId
                WHERE DA.Id = ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeInfoFromPaiement($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT Nom, Prenom, Email, Phone, LangueO, LangueD,Type, Comment
                FROM demande_".$type." T1
                JOIN Demande".$type[0]."_Accepte DA
                ON T1.Id = DA.DemandeId
                JOIN Demande".$type[0]."_paiement DP
                ON DA.Id = DP.DemandeId
                WHERE DP.Id = ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeInfoFromStarted($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT Nom, Prenom, Email, Phone, LangueO, LangueD,Type, Comment
                FROM demande_".$type." T1
                JOIN Demande".$type[0]."_Accepte DA
                ON T1.Id = DA.DemandeId
                JOIN Demande".$type[0]."_paiement DP
                ON DA.Id = DP.DemandeId
                JOIN ".$type."_debutee DB
                ON DP.Id = DB.DemandeId
                WHERE DB.Id = ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeInfoFromFinished($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT Nom, Prenom, Email, Phone, LangueO, LangueD,Type, Comment
                FROM demande_".$type." T1
                JOIN Demande".$type[0]."_Accepte DA
                ON T1.Id = DA.DemandeId
                JOIN Demande".$type[0]."_paiement DP
                ON DA.Id = DP.DemandeId
                JOIN ".$type."_debutee DB
                ON DP.Id = DB.DemandeId
                JOIN ".$type."_finie DF
                ON DB.Id = DF.DemandeId
                WHERE DF.Id = ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification demande de traduction
    public function getDemandeTNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DemandeId FROM RecevoireDemandeT WHERE TraducteurId = ".$userID." AND Vu = 0;";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification demande de devis
    public function getDemandeDNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DemandeId FROM RecevoireDemandeD WHERE TraducteurId = ".$userID." AND Vu = 0;";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification demande de traduction acceptée
    public function getDemandeTANotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DA.Id DemandeId, TraducteurId, Prix
                FROM DemandeT_Accepte DA 
                JOIN Demande_traduction DT
                ON DA.DemandeId = DT.Id
                WHERE Vu = 0
                AND UtilisateurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification demande de devis acceptée
    public function getDemandeDANotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DA.Id DemandeId, TraducteurId, Prix 
                FROM DemandeD_Accepte DA 
                JOIN Demande_devis DD
                ON DA.DemandeId = DD.Id
                WHERE Vu = 0
                AND UtilisateurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification demande de traduction paiement accepte
    public function getDemandeTPANotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DP.Id DemandeId
                FROM DemandeT_paiement DP
                JOIN DemandeT_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_traduction DT
                ON DA.DemandeId = DT.Id
                WHERE VuClient = 0
                AND Etat = 1
                AND UtilisateurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification demande de devis paiement accepte
    public function getDemandeDPANotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DP.Id DemandeId
                FROM DemandeD_paiement DP
                JOIN DemandeD_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_devis DD
                ON DA.DemandeId = DD.Id
                WHERE VuClient = 0
                AND Etat = 1
                AND UtilisateurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification demande de traduction paiement refusé
    public function getDemandeTPDNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DP.Id DemandeId
                FROM DemandeT_paiement DP
                JOIN DemandeT_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_traduction DT
                ON DA.DemandeId = DT.Id
                WHERE VuClient = 0
                AND Etat = -1
                AND UtilisateurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification demande de devis paiement refusé
    public function getDemandeDPDNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DP.Id DemandeId
                FROM DemandeD_paiement DP
                JOIN DemandeD_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_devis DD
                ON DA.DemandeId = DD.Id
                WHERE VuClient = 0
                AND Etat = -1
                AND UtilisateurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeTPRNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DP.Id DemandeId
                FROM DemandeT_paiement DP
                JOIN DemandeT_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_traduction DT
                ON DA.DemandeId = DT.Id
                WHERE Vutraductor = 0
                AND Etat = 1
                AND TraducteurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeDPRNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DP.Id DemandeId
                FROM DemandeD_paiement DP
                JOIN DemandeD_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_devis DD
                ON DA.DemandeId = DD.Id
                WHERE Vutraductor = 0
                AND Etat = 1
                AND TraducteurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification de traduction debutée
    public function getDemandeTDNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT TD.Id DemandeId
                FROM Traduction_debutee TD
                JOIN DemandeT_paiement DP
                ON DP.Id = TD.DemandeId
                JOIN DemandeT_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_traduction DT
                ON DA.DemandeId = DT.Id
                WHERE TD.Vu = 0
                AND UtilisateurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification de devis débutée
    public function getDemandeDDNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DB.Id DemandeId
                FROM Devis_debutee DB
                JOIN DemandeD_paiement DP
                ON DP.Id = DB.DemandeId
                JOIN DemandeD_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_devis DD
                ON DA.DemandeId = DD.Id
                WHERE DB.Vu = 0
                AND UtilisateurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

     // notification de traduction debutée
     public function getDemandeTDTraductorNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT TD.Id DemandeId
                FROM Traduction_debutee TD
                JOIN DemandeT_paiement DP
                ON DP.Id = TD.DemandeId
                JOIN DemandeT_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_traduction DT
                ON DA.DemandeId = DT.Id
                WHERE TraducteurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification de devis débutée
    public function getDemandeDDTraductorNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DB.Id DemandeId
                FROM Devis_debutee DB
                JOIN DemandeD_paiement DP
                ON DP.Id = DB.DemandeId
                JOIN DemandeD_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_devis DD
                ON DA.DemandeId = DD.Id
                WHERE TraducteurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification de traduction finie
    public function getDemandeTFNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT TF.Id DemandeId
                FROM Traduction_finie TF
                JOIN Traduction_debutee TD
                ON TF.TraductionId = TD.Id
                JOIN DemandeT_paiement DP
                ON TD.DemandeId = DP.Id
                JOIN DemandeT_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_traduction DT
                ON DA.DemandeId = DT.Id
                WHERE TF.VuClient = 0
                AND UtilisateurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeTFANotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT TF.Id DemandeId
                FROM Traduction_finie TF
                JOIN Traduction_debutee TD
                ON TF.TraductionId = TD.Id
                JOIN DemandeT_paiement DP
                ON TD.DemandeId = DP.Id
                JOIN DemandeT_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_traduction DT
                ON DA.DemandeId = DT.Id
                WHERE TF.VuTraductor = 0
                AND TF.Etat = 1
                AND TraducteurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeTFDNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT TF.Id DemandeId
                FROM Traduction_finie TF
                JOIN Traduction_debutee TD
                ON TF.TraductionId = TD.Id
                JOIN DemandeT_paiement DP
                ON TD.DemandeId = DP.Id
                JOIN DemandeT_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_traduction DT
                ON DA.DemandeId = DT.Id
                WHERE TF.VuTraductor = 0
                AND TF.Etat = 0
                AND TraducteurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification de devis finie
    public function getDemandeDFNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DF.Id DemandeId
                FROM Devis_finie DF
                JOIN Devis_debutee DB
                ON DF.DeviId = DB.Id
                JOIN DemandeD_paiement DP
                ON DP.Id = DB.DemandeId
                JOIN DemandeD_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_devis DD
                ON DA.DemandeId = DD.Id
                WHERE DF.VuClient = 0
                AND UtilisateurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function addFinalFile($idDemande, $type, $file){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $docName = $this->addPaymentDocument($file);
        $rq = "INSERT INTO ".$type."_finie (TraductionId, Document)
                VALUES
                (".$idDemande.",
                '".$docName."');";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function clientValideFinal($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE ".$type."_finie SET VuClient = 1, Etat = 1 WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function clientDeclineFinal($idDemande, $type, $file){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE ".$type."_finie SET VuClient = 1, Etat = -1 WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function TraductorValideFinal($idDemande, $type, $file){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = $rq = "UPDATE Traduction_finie SET VuTraductor = 1, Etat = 1 WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function addRecevoirDemandeT($demandeId, $traductorId, $typeDemande){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "INSERT INTO RecevoireDemande".$typeDemande[0]." (DemandeId, TraducteurId)
                values(
                    ".$demandeId.",
                    ".$traductorId."
                    );";
        $r = $conn->query($rq);
       
        $this->deconnexion($conn);
    }

    public function addFaxes($faxes, $idUser){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $arrlength = count($faxes);
        for($x = 0; $x < $arrlength; $x++) {
            $rq = "INSERT INTO Faxes (fax, UtilisateurId)
                values(
                    ".$faxes[$x].",
                    ".$idUser."
                    );";

            $r = $conn->query($rq);
        }

        $this->deconnexion($conn);
    }

    public function addLangues($langues, $idTraductor){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $arrlength = count($langues);
        for($x = 0; $x < $arrlength; $x++) {
            $rq = "INSERT INTO MaitriseLangue (LangueId, TraducteurId)
                values(
                    ".$langues[$x].",
                    ".$idTraductor."
                    );";

            $r = $conn->query($rq);
        }

        $this->deconnexion($conn);
    }

    public function addData($traductorId, $cv, $assermentation){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $cvName = $this->addCV($cv);
        $assermentationName = $this->addAssermentation($assermentation);
        if (strcmp($assermentationName, ' ') == 0){
            $rq = "INSERT INTO Traducteurdata (TraducteurId, Cv, Assermetation_doc)
            values(
                ".$traductorId.",
                '".$cvName."',
                NULL
                );";
        }else{
            $rq = "INSERT INTO Traducteurdata (TraducteurId, Cv, Assermetation_doc)
            values(
                ".$traductorId.",
                '".$cvName."',
                '".$assermentationName."'
                );";
        }
        

        $r = $conn->query($rq);
        $this->deconnexion($conn);

    }

    public function addReferences($idUser, $references){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $arrlength = count($references);
        
        for($x = 0; $x < $arrlength; $x++) {
           
            $referenceName = $this->addReference($references[$x]);
            if (strcmp($referenceName, '') != 0){
                $rq = "INSERT INTO Reference (Document, TraducteurId)
                    values(
                        '".$referenceName."',
                        ".$idUser."
                        );";
    
                $r = $conn->query($rq);
            }
            
        }
        $this->deconnexion($conn);
    }

    public function findUser($email, $pass){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT Id FROM Utilisateur WHERE Email = '".$email."' AND Password = '".$pass."'";
        $r = $conn->query($rq);
        $result = $r->fetch_assoc(); // fetch it first
        $this->deconnexion($conn);
        return $result['Id'];
    }

    public function addTypes($idUser, $types){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $arrlength = count($types);
        
        for($x = 0; $x < $arrlength; $x++) {
           
            
            $rq = "INSERT INTO MaitriseType (type, TraducteurId)
                values(
                    '".$types[$x]."',
                    ".$idUser."
                    );";

            $r = $conn->query($rq);
            
        }
        $this->deconnexion($conn);
    }

    public function addCV($cv){
        $targetDir = "uploads/CVs/";
        $fileName = basename($cv["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($cv["tmp_name"], $targetFilePath)){
                return $fileName;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
        return $statusMsg;

    }

    public function addReference($ref){
        $targetDir = "uploads/References/";
        $fileName = basename($ref["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($ref["tmp_name"], $targetFilePath)){
                return $fileName;
            }
        }
        
        return '';
    }

    public function addAssermentation($preuve){
        $targetDir = "uploads/PreuveAssermentation/";
        $fileName = basename($preuve["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($preuve["tmp_name"], $targetFilePath)){
                return $fileName;
            }
        }

        return ' ';
    }

    public function addDemandeDocument($doc){
        $targetDir = "uploads/DemandeDocs/";
        $fileName = basename($doc["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($doc["tmp_name"], $targetFilePath)){
                return $fileName;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
        return $statusMsg;
    }

    public function addPaymentDocument($doc){
        $targetDir = "uploads/Paiement/";
        $fileName = basename($doc["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($doc["tmp_name"], $targetFilePath)){
                return $fileName;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
        return $statusMsg;
    }

    public function addFinalDocument($doc){
        $targetDir = "uploads/Output/";
        $fileName = basename($doc["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($doc["tmp_name"], $targetFilePath)){
                return $fileName;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
        return $statusMsg;
    }
}




?>