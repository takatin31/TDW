<?php
class AdminModal{
    
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

    public function adminInscription($user, $email, $pass){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "INSERT INTO Admin (username, email, password) VALUES ('".$user."', '".$email."', MD5('".$pass."'))";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function isAdmin($email, $pass){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT COUNT(*) FROM Admin WHERE email = '".$email."' AND password = MD5('".$pass."')";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getNbrAdminList(){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT COUNT(*) FROM Admin";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    //date format yyyy-mm-dd
    public function getNombreTraducteur($dateDebut, $dateFin){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT COUNT(*) nbr
                FROM Utilisateur U
                JOIN TraducteurData D
                ON U.Id = D.traducteurId
                WHERE Date BETWEEN CAST('".$dateDebut."' AS DATE) AND CAST('".$dateFin."' AS DATE)";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getTraducteurs(){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT U.*, D.*, W.Nom wilaya
                FROM Utilisateur U
                JOIN TraducteurData D
                ON U.Id = D.traducteurId
                JOIN Wilaya W
                ON W.id = U.wilayaId";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getTraducteurInfo($idTraducteur){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT U.*, D.Cv, W.nom wilaya, C.nom commune,
                CASE
                WHEN D.Assermetation_doc IS NULL THEN 'Non Assermente'
                ELSE 'Assermente'
                END AS AssermenteEtat
                FROM Utilisateur U
                JOIN TraducteurData D
                ON U.Id = D.traducteurId
                JOIN Wilaya W
                ON W.id = U.wilayaId
                JOIN Commune C
                ON C.id = U.commune
                WHERE U.id = ".$idTraducteur;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getTraducteurReferences($idTraducteur){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT Document
                FROM Reference
                WHERE TraducteurId = ".$idTraducteur;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getTraducteurLangues($idTraducteur){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT L.Nom
                FROM Langue L
                JOIN MaitriseLangue ML
                ON L.Id = ML.LangueId
                WHERE ML.TraducteurId = ".$idTraducteur;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getTraducteurTypes($idTraducteur){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT Type
                FROM Maitrisetype MT
                WHERE TraducteurId = ".$idTraducteur;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getUserFaxes($idUser){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT fax
                FROM Faxes
                WHERE UtilisateurId = ".$idUser;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getHistoryTraducteur($idTraducteur, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT TF.Date, TF.Id , DT.Type, U.Email
        FROM ".$type."_finie TF
        JOIN ".$type."_debutee TD
        ON TF.".$type."Id = TD.Id
        JOIN demande".$type[0]."_paiement DP
        ON TD.DemandeId = DP.Id
        JOIN demande".$type[0]."_accepte DA
        ON DP.DemandeId = DA.Id
        JOIN demande_".$type." DT
        ON DA.DemandeId = DT.Id
        JOIN utilisateur U
        ON DT.UtilisateurId = U.Id
        WHERE DA.TraducteurId = ".$idTraducteur."
        ORDER BY TF.DATE DESC";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getNoteHistoryTraducteur($idUser){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT N.*, U.Email
                FROM NOTE N
                JOIN Utilisateur U
                ON N.UtilisateurId = U.Id
                WHERE N.TraducteurId = ".$idUser."
                ORDER BY N.Date DESC";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getSignalementHistoryTraducteur($idUser){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT S.*, U.Email
                FROM Signalement S
                JOIN Utilisateur U
                ON S.UtilisateurId = U.Id
                WHERE S.TraducteurId = ".$idUser."
                ORDER BY S.Date DESC";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function filterTraducteurs($nom, $assermente, $type, $langue, $wilaya, $note){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getSignalementOnTraducteur($idTraducteur){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT *
                FROM Signalement
                WHERE TraducteurId = ".$idTraducteur;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getNombreClient($dateDebut, $dateFin){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT COUNT(*) nbr
                FROM Utilisateur
                WHERE Id NOT IN (
                                    SELECT TraducteurId 
                                    FROM TraducteurData)
                AND Date BETWEEN CAST('".$dateDebut."' AS DATE) AND CAST('".$dateFin."' AS DATE)";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getClients(){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT U.*, W.nom wilaya
                FROM Utilisateur U
                JOIN Wilaya W
                ON W.Id = U.wilayaId
                WHERE U.Id NOT IN (
                                    SELECT TraducteurId 
                                    FROM TraducteurData)";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getClientInfo($idClient){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT U.*, W.nom wilaya, C.nom commune
                FROM Utilisateur U
                JOIN Wilaya W
                ON W.Id = U.wilayaId
                JOIN Commune C
                ON C.id = U.commune
                WHERE U.Id NOT IN (
                                    SELECT TraducteurId 
                                    FROM TraducteurData)
                AND U.id = ".$idClient;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function filterClients($nom, $wilaya){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getSignalementByClient($idClient){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT *
                FROM Signalement
                WHERE UtilisateurId = ".$idClient;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function bloquerUser($idUser, $date){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function supprimerUser($idUser){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE Utilisateur SET Etat = -1 WHERE Id = ".$idUser;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function updateInfoUser($idUser, $nom, $prenom, $email, $image){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE Utilisateur SET Nom = '".$nom."', Prenom = '".$prenom."', Email = '".$email."', Image = '".$image."' WHERE Id = ".$idUser;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getHistoryClient($idClient){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getNombreDocuments(){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDocuments(){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDocumentInfo($idDocument){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function deleteDocument($idDocument){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function filterDocument($clientId, $traducteurId, $type, $langue){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getNombreTraduction($dateDebut, $dateFin){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT COUNT(*) nbr
                FROM Traduction_finie
                WHERE Date BETWEEN CAST('".$dateDebut."' AS DATE) AND CAST('".$dateFin."' AS DATE)";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getNombreTraductionForTraductor($idTraducteur, $dateDebut, $dateFin){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT COUNT(*) nbr
                FROM Traduction_finie TF
                JOIN Traduction_debutee TD
                ON TF.TraductionId = TD.Id
                JOIN DemandeT_Paiement DP
                ON DP.Id = TD.DemandeId
                JOIN DemandeT_Accepte DA
                ON DA.Id = DP.DemandeId
                WHERE DA.TraducteurId = ".$idTraducteur."
                AND TF.Date BETWEEN CAST('".$dateDebut."' AS DATE) AND CAST('".$dateFin."' AS DATE)";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getNombreTraductionByClient($idClient, $dateDebut, $dateFin){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT COUNT(*) nbr
                FROM Traduction_finie TF
                JOIN Traduction_debutee TD
                ON TF.TraductionId = TD.Id
                JOIN DemandeT_Paiement DP
                ON DP.Id = TD.DemandeId
                JOIN DemandeT_Accepte DA
                ON DA.Id = DP.DemandeId
                JOIN Demande_Traduction DT
                ON DT.Id = DA.DemandeId
                WHERE DT.UtilisateurId = ".$idClient."
                AND TF.Date BETWEEN CAST('".$dateDebut."' AS DATE) AND CAST('".$dateFin."' AS DATE)";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getNombreDevis($dateDebut, $dateFin){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT COUNT(*) nbr
                FROM Devis_finie
                WHERE Date BETWEEN CAST('".$dateDebut."' AS DATE) AND CAST('".$dateFin."' AS DATE)";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getNombreDevisForTraductor($idTraducteur, $dateDebut, $dateFin){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT COUNT(*) nbr
                FROM Devis_finie DF
                JOIN Devis_debutee DB
                ON TF.DevisId = TD.Id
                JOIN DemandeD_Paiement DP
                ON DP.Id = TD.DemandeId
                JOIN DemandeD_Accepte DA
                ON DA.Id = DP.DemandeId
                WHERE DA.TraducteurId = ".$idTraducteur."
                AND DF.Date BETWEEN CAST('".$dateDebut."' AS DATE) AND CAST('".$dateFin."' AS DATE)";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getNombreDevisByClient($idClient, $dateDebut, $dateFin){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT COUNT(*) nbr
                FROM Devis_finie DF
                JOIN Devis_debutee DB
                ON TF.DevisId = TD.Id
                JOIN DemandeD_Paiement DP
                ON DP.Id = TD.DemandeId
                JOIN DemandeD_Accepte DA
                ON DA.Id = DP.DemandeId
                JOIN Demande_Devis DD
                ON DD.Id = DA.DemandeId
                WHERE DD.UtilisateurId = ".$idClient."
                AND DF.Date BETWEEN CAST('".$dateDebut."' AS DATE) AND CAST('".$dateFin."' AS DATE)";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getDemandePaiement($type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT *
                FROM Demande".$type[0]."_Paiement";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function acceptDemandePaiement($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE Demande".$type[0]."_Paiement SET Etat = 1 WHERE Id = ".$idDemande;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function declineDemandePaiement($idDemande, $type){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE Demande".$type[0]."_Paiement SET Etat = -1 WHERE Id = ".$idDemande;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getTraducteurEnAttentes(){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "SELECT *
                FROM Utilisateur U
                JOIN TraducteurData D
                ON U.Id = D.traducteurId
                WHERE Etat = 0";
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function acceptTraducteur($idTraducteur){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE TraducteurData SET Etat = 1 WHERE traducteurId = ".$idTraducteur;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function declineTraducteur($idTraducteur){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE TraducteurData SET Etat = -1 WHERE traducteurId = ".$idTraducteur;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function seeSignalement($idSignalement){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "UPDATE Signalement SET Vu = 1 WHERE Id = ".$idSignalement;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

}

?>