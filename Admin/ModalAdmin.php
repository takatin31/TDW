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
        $rq = "SELECT *
                FROM Utilisateur U
                JOIN TraducteurData D
                ON U.Id = D.traducteurId
                WHERE U.id = ".$idTraducteur;
        $r = $conn->query($rq);
        $this->deconnexion($conn);
        return $r;
    }

    public function getHistoryTraducteur($idTraducteur){
        $conn = $this->connexion($this->servername, $this->username, $this->password, $this->dbname);
        $rq = "";
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
        $rq = "SELECT *
                FROM Utilisateur U
                JOIN TraducteurData D
                ON U.Id = D.traducteurId
                WHERE U.id = ".$idTraducteur;
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
                ON TF.DeviId = TD.Id
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
                ON TF.DeviId = TD.Id
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