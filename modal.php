<?php

require_once('controller.php');
class projet_modal{
    
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "secret";
    private $dbname = "tdw";

    private function connexion($servername, $username, $password, $dbname){
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        return $conn;
    }

    private function deconnexion($conn){
        mysqli_close($conn);
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
        $this->deconnexion($conn);
    }
}




?>