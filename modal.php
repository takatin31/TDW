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

    public function getName($userId){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "Select Nom, Prenom from Utilisateur WHERE Id =".$userId;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getPhoto($userId){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "Select Image from Utilisateur WHERE Id =".$userId;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function addPhoto($userId, $image){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $imageName = $this->addImagePic($image);
        $rq = "UPDATE Utilisateur SET Image = '".$imageName."' WHERE Id =".$userId;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $imageName;
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
                where mt.Type in ('".$type."')
                ) as t2
                on t1.userid = t2.userid
                JOIN
                (
                    select U.Id userid, U.Image Image, U.Nom Nom, U.Prenom Prenom
                from utilisateur U
                JOIN traducteurdata TD
                ON U.Id = TD.TraducteurId
                WHERE TD.Etat = 1
                AND TD.Assermetation_doc is ".$asser_doc."
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

    public function getTraductor_Nom_Asserm_Type_Lang($nom, $asserm, $langue, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $connditionName = "";
        if (strcmp($nom, "") != 0){
            $connditionName = "WHERE U.Nom LIKE '%".$nom."%' OR U.prenom LIKE '%".$nom."%'";
        }

        $conditionAsserm = "";
        if (strcmp($asserm, "") != 0){
            if (strcmp($asserm, 'true') == 0){
                $asser_doc = 'NOT NULL';
            }else{
                $asser_doc = 'NULL';
            }
            
            if (strcmp($nom, "") != 0)
                $conditionAsserm ="AND TD.Assermetation_doc is ".$asser_doc;
            else
                $conditionAsserm ="WHERE TD.Assermetation_doc is ".$asser_doc;
        }

        $conditionLng = "";
        if (strcmp($langue, "") != 0){
            $conditionLng = "HAVING GROUP_CONCAT(L.Nom SEPARATOR ' ') like '%".$langue."%'";
        }

        $conditionType= "";
        if (strcmp($type, "") != 0){
            $conditionType = "WHERE mt.Type in ('".$type."')";
        }
        
        

        $rq = "SELECT t3.*, t4.note
                FROM
                (
                select U.id userid, GROUP_CONCAT(L.Nom SEPARATOR ' ') langues
                from utilisateur U
                JOIN maitriselangue ML
                ON U.Id = ML.TraducteurId
                JOIN langue L
                ON L.Id = ML.LangueId
                group by U.id
                ".$conditionLng."
                ) as t1
                JOIN
                (
                select U.id userid, MT.Type
                from utilisateur U
                JOIN maitrisetype MT
                ON U.Id = MT.TraducteurId
                ".$conditionType."
                ) as t2
                on t1.userid = t2.userid
                JOIN
                (
                    select U.Id userid, U.Image Image, U.Nom Nom, U.Prenom Prenom
                from utilisateur U
                JOIN traducteurdata TD
                ON U.Id = TD.TraducteurId
                ".$connditionName."
                ".$conditionAsserm."
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
                    group by t4.userid";

                
        $result = $conn->query($rq);   
        $this->deconnexion($conn);
        return $result;
    }

    public function getTypes($idUser){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT Type FROM MaitriseType WHERE TraducteurId = ".$idUser;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
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
        $rq = "UPDATE DemandeT_paiement SET Etat = 0, Document = '".$docName."' WHERE DemandeId= ".$idDemande.";";
        $r = $conn->query($rq);
        $rq = "SELECT * FROM DemandeT_paiement WHERE DemandeId= ".$idDemande.";";
        $r = $conn->query($rq);
        $row_cnt = mysqli_num_rows($r);
        if ($row_cnt == 0){
            $rq1 = "INSERT INTO DemandeT_paiement (DemandeId, Etat, Document) VALUES (".$idDemande.", 0, '".$docName."');";
            $r = $conn->query($rq1);
            $rq = "UPDATE DemandeT_Accepte SET Vu = true WHERE Id= ".$idDemande.";";
            $r = $conn->query($rq);
            $this->deconnexion($conn);
            return $rq1;
        }
       
    }

    public function seeDemandeDevis($idDemande, $file){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $docName = $this->addPaymentDocument($file);
        $rq = "UPDATE DemandeD_paiement SET Etat = 0, Document = '".$docName."' WHERE DemandeId= ".$idDemande.";";
        $r = $conn->query($rq);
        $rq = "SELECT * FROM DemandeD_paiement WHERE DemandeId= ".$idDemande.";";
        $r = $conn->query($rq);
        $row_cnt = mysqli_num_rows($r);
        if ($row_cnt == 0){
            $rq = "INSERT INTO DemandeD_paiement (DemandeId, Etat, Document) VALUES (".$idDemande.", 0, '".$docName."');";
            $r = $conn->query($rq);
            $rq = "UPDATE DemandeD_Accepte SET Vu = true WHERE Id= ".$idDemande.";";
            $r = $conn->query($rq);
            $this->deconnexion($conn);
            return $rq;
        }
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

    public function seeAcceptedTraduction($idDemande){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE Traduction_finie SET VuTraductor = true WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function seeAcceptedDevis($idDemande){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE Devis_finie SET VuTraductor = true WHERE Id= ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function getArticles($start, $nbr){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT * FROM Articles ORDER By Date DESC LIMIT ".$start.", ".$nbr.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getNbrArticles(){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT COUNT(*) nbr FROM Articles ;";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getHistoryClient($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DA.*,U.Nom, 'Traduction' Type
                FROM demandet_accepte DA
                JOIN utilisateur U
                ON U.Id = DA.TraducteurId
                JOIN demande_traduction DT
                ON DT.Id = DA.DemandeId
                WHERE DT.UtilisateurId = ".$userID."
                UNION 
                SELECT DA.*,U.Nom, 'Devi' Type
                FROM demanded_accepte DA
                JOIN utilisateur U
                ON U.Id = DA.TraducteurId
                JOIN demande_devis DD
                ON DD.Id = DA.DemandeId
                WHERE DD.UtilisateurId = ".$userID;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getHistoryTraductor($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DA.*,U.Nom, 'Traduction' Type
                FROM demandet_accepte DA
                JOIN demande_traduction DT
                ON DT.Id = DA.DemandeId
                JOIN utilisateur U
                ON U.Id = DT.UtilisateurId
                WHERE DA.TraducteurId = ".$userID."
                UNION 
                SELECT DA.*,U.Nom, 'Devi' Type
                FROM demanded_accepte DA
                JOIN demande_devis DD
                ON DD.Id = DA.DemandeId
                JOIN utilisateur U
                ON U.Id = DD.UtilisateurId
                WHERE DA.TraducteurId = ".$userID;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }
    

    public function getTraductorData($idUser){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT U.Nom, U.Prenom, U.Email, U.Phone, U.Image, W.Nom wilaya, C.Nom commune,N.note,
                CASE
                WHEN TD.Assermetation_doc IS NULL THEN FALSE
                ELSE TRUE
                END Assermente,
                CASE 
                WHEN T.nbr IS NULL THEN 0
                ELSE T.nbr
                END nbr,
                CASE
                WHEN N.note IS NULL THEN 0
                ELSE N.note
                END note
                FROM Utilisateur U
                JOIN traducteurdata TD
                ON U.Id = TD.TraducteurId
                JOIN wilaya W
                ON W.Id = U.WilayaId
                JOIN Commune C
                ON C.Id = U.Commune
                LEFT JOIN (
                    SELECT traducteurId, COUNT(*) nbr
                    FROM(
                        SELECT traducteurId 
                        from demandet_accepte
                        UNION ALL
                        SELECT traducteurId
                        from demanded_accepte
                        )AS Tab
                        GROUP BY traducteurId
                )AS T
                ON T.traducteurId = U.Id
                LEFT JOIN (
                    SELECT traducteurId ,AVG(N.valeur) note
                    FROM note N
                    GROUP BY traducteurId
                    ) AS N
                    ON N.traducteurId = U.Id
                WHERE U.Id = ".$idUser;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeInfoFromRecieved($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT T1.Nom, Prenom, Email, Phone, L1.nom LangueO, L2.nom LangueD,Type, Comment
                FROM demande_".$type." T1
                JOIN Langue L1
                ON L1.Id = T1.LangueO
                JOIN Langue L2
                ON L2.Id = T1.LangueD
                WHERE T1.Id = ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeInfoFromAccepted($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT T1.Nom, Prenom, Email, Phone, L1.nom LangueO,L2.nom LangueD,Type, Comment
                FROM demande_".$type." T1
                JOIN Demande".$type[0]."_Accepte DA
                ON T1.Id = DA.DemandeId
                JOIN Langue L1
                ON L1.Id = T1.LangueO
                JOIN Langue L2
                ON L2.Id = T1.LangueD
                WHERE DA.Id = ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeInfoFromPaiement($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT T1.Nom, Prenom, Email, Phone, L1.nom LangueO,L2.nom LangueD,Type, Comment
                FROM demande_".$type." T1
                JOIN Demande".$type[0]."_Accepte DA
                ON T1.Id = DA.DemandeId
                JOIN Demande".$type[0]."_paiement DP
                ON DA.Id = DP.DemandeId
                JOIN Langue L1
                ON L1.Id = T1.LangueO
                JOIN Langue L2
                ON L2.Id = T1.LangueD
                WHERE DP.Id = ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function signaler($userId, $traductorId, $cause){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "INSERT INTO Signalement (UtilisateurId, TraducteurId, Cause) 
        VALUES (
            ".$userId.",
            ".$traductorId.",
            '".$cause."'
        )";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function getDemandeInfoFromStarted($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT T1.Nom, Prenom, Email, Phone,L1.nom LangueO,L2.nom LangueD,Type, Comment
                FROM demande_".$type." T1
                JOIN Demande".$type[0]."_Accepte DA
                ON T1.Id = DA.DemandeId
                JOIN Demande".$type[0]."_paiement DP
                ON DA.Id = DP.DemandeId
                JOIN ".$type."_debutee DB
                ON DP.Id = DB.DemandeId
                JOIN Langue L1
                ON L1.Id = T1.LangueO
                JOIN Langue L2
                ON L2.Id = T1.LangueD
                WHERE DB.Id = ".$idDemande.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandeInfoFromFinished($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT T1.Nom, Prenom, Email, Phone, L1.nom LangueO,L2.nom LangueD,Type, Comment
                FROM demande_".$type." T1
                JOIN Demande".$type[0]."_Accepte DA
                ON T1.Id = DA.DemandeId
                JOIN Demande".$type[0]."_paiement DP
                ON DA.Id = DP.DemandeId
                JOIN ".$type."_debutee DB
                ON DP.Id = DB.DemandeId
                JOIN ".$type."_finie DF
                ON DB.Id = DF.DemandeId
                JOIN Langue L1
                ON L1.Id = T1.LangueO
                JOIN Langue L2
                ON L2.Id = T1.LangueD
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
        $rq = "SELECT DA.Id DemandeId
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
        $rq = "SELECT DA.Id DemandeId
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
                WHERE TD.Id NOT IN 
                (SELECT traductionid 
                 FROM traduction_finie
                 WHERE Etat = 1
                )
                AND TraducteurId = ".$userID.";";
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
                WHERE DB.Id NOT IN 
                (SELECT devisid 
                 FROM devis_finie
                )
                AND TraducteurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification de traduction finie
    public function getDemandeTFNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT TF.Id DemandeId, TF.Document
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
                AND TF.Etat = -1
                AND TraducteurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    // notification de devis finie
    public function getDemandeDFCNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DF.Id DemandeId, DF.Document
                FROM Devis_finie DF
                JOIN Devis_debutee DB
                ON DF.DevisId = DB.Id
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

    public function getDemandeDFTNotifications($userID){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DF.Id DemandeId, DF.Document
                FROM Devis_finie DF
                JOIN Devis_debutee DB
                ON DF.DevisId = DB.Id
                JOIN DemandeD_paiement DP
                ON DP.Id = DB.DemandeId
                JOIN DemandeD_Accepte DA
                ON DP.DemandeId = DA.Id
                JOIN Demande_devis DD
                ON DA.DemandeId = DD.Id
                WHERE DF.VuTraductor = 0
                AND TraducteurId = ".$userID.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getTraductorIdfromDemandeId($demandeId, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT DA.TraducteurId Id
                FROM ".$type."_finie DF
                JOIN ".$type."_debutee DB
                ON DF.".$type."Id = DB.Id
                JOIN Demande".$type[0]."_paiement DP
                ON DP.Id = DB.DemandeId
                JOIN Demande".$type[0]."_Accepte DA
                ON DP.DemandeId = DA.Id
                WHERE DF.Id = ".$demandeId.";";
        $r = $conn->query($rq);
        $result = $r->fetch_assoc(); 
        $this->deconnexion($conn);
        return $result['Id'];
    }

    public function noter($demandeId, $userId, $note, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $traductorId = $this->getTraductorIdfromDemandeId($demandeId, $type);
        $rq = "INSERT INTO Note (TraducteurId, UtilisateurId, valeur)
                VALUES
                (".$traductorId.",
                ".$userId.",
                ".$note.")
                ON DUPLICATE KEY UPDATE    
                valeur = ".$note;
        $r = $conn->query($rq);
        if (strcmp($type, "Traduction") == 0)
            $rq = "UPDATE ".$type."_finie SET VuClient = 1, Etat = 1 WHERE Id= ".$demandeId.";";
        else
            $rq = "UPDATE ".$type."_finie SET VuClient = 1 WHERE Id= ".$demandeId.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function doNotNoter($demandeId, $userId, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $traductorId = $this->getTraductorIdfromDemandeId($demandeId, $type);
        if (strcmp($type, "traduction") == 0)
            $rq = "UPDATE ".$type."_finie SET VuClient = 1, Etat = 1 WHERE Id= ".$demandeId.";";
        else
            $rq = "UPDATE ".$type."_finie SET VuClient = 1 WHERE Id= ".$demandeId.";";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $rq;
    }

    public function addFinalFile($idDemande, $type, $file){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $docName = $this->addFinalDocument($file);
        $rq = "INSERT INTO ".$type."_finie (".$type."Id, Document)
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
        $rq = $rq = "UPDATE ".$type."_finie SET VuTraductor = 1, Etat = 1 WHERE Id= ".$idDemande.";";
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
        $rq = "SELECT Id FROM Utilisateur WHERE Etat = 0 AND Email = '".$email."' AND Password = '".$pass."'";
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

    public function addImagePic($image){
        $targetDir = "uploads/profile_pics/";
        $fileName = basename($image["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($image["tmp_name"], $targetFilePath)){
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