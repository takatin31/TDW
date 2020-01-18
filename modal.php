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
                echo $rq;
            }
            
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
}




?>