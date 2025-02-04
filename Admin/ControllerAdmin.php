<?php
require_once("ModalAdmin.php");

class AdminController {
    public function adminInscription($email, $password){
        $am = new AdminModal();
        $r = $am->adminInscription($email, $password);
        return $r;
    }

    public function isAdmin($email, $password){
        $am = new AdminModal();
        $r = $am->isAdmin($email, $password);
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }

    public function getNbrAdminList(){
        $am = new AdminModal();
        $r = $am->getNbrAdminList();
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }
}

class TraducteurController {
    public function getNombreTraducteur($dateDebut, $dateFin){
        $am = new AdminModal();
        $r = $am->getNombreTraducteur($dateDebut, $dateFin);
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }


    public function getTraducteurs(){
        $am = new AdminModal();
        $r = $am->getTraducteurs();
        return $r;
    }

    public function getTraducteurs_before(){
        $am = new AdminModal();
        $r = $am->getTraducteurs_before();
        return $r;
    }

    public function getTraducteurInfo($idTraducteur){
        $am = new AdminModal();
        $r = $am->getTraducteurInfo($idTraducteur);
        $result = $r->fetch_assoc();
        return $result;
    }

    public function getHistoryTraducteur($idTraducteur, $type){
        $am = new AdminModal();
        $r = $am->getHistoryTraducteur($idTraducteur, $type);
        return $r;
    }

    public function getTraducteurReferences($idTraducteur){
        $am = new AdminModal();
        $r = $am->getTraducteurReferences($idTraducteur);
        return $r;
    }

    public function getTraducteurLangues($idTraducteur){
        $am = new AdminModal();
        $r = $am->getTraducteurLangues($idTraducteur);
        return $r;
    }

    public function getTraducteurTypes($idTraducteur){
        $am = new AdminModal();
        $r = $am->getTraducteurTypes($idTraducteur);
        return $r;
    }

    public function filterTraducteurs($nom, $assermente, $type, $langue, $wilaya, $note){
        $am = new AdminModal();
        $r = $am->filterTraducteurs($nom, $assermente, $type, $langue, $wilaya, $note);
        return $r;
    }

    public function getTraducteurEnAttentes(){
        $am = new AdminModal();
        $r = $am->getTraducteurEnAttentes();
        return $r;
    }

    public function acceptTraducteur($idTraducteur){
        $am = new AdminModal();
        $r = $am->acceptTraducteur($idTraducteur);
        return $r;
    }

    public function declineTraducteur($idTraducteur){
        $am = new AdminModal();
        $r = $am->declineTraducteur($idTraducteur);
        return $r;
    }

    public function getNoteHistoryTraducteur($idTraducteur){
        $am = new AdminModal();
        $r = $am->getNoteHistoryTraducteur($idTraducteur);
        return $r;
    }

    public function getSignalementHistoryTraducteur($idTraducteur){
        $am = new AdminModal();
        $r = $am->getSignalementHistoryTraducteur($idTraducteur);
        return $r;
    }

    public function getTraducteurId($traducteurEmail){
        $am = new AdminModal();
        $r = $am->getTraducteurId($traducteurEmail);
        $result = $r->fetch_assoc();
        return $result["Id"];
    }
}

class ClientController {
    public function getNombreClient($dateDebut, $dateFin){
        $am = new AdminModal();
        $r = $am->getNombreClient($dateDebut, $dateFin);
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }

    public function getClients(){
        $am = new AdminModal();
        $r = $am->getClients();
        return $r;
    }

    public function getClientInfo($idClient){
        $am = new AdminModal();
        $r = $am->getClientInfo($idClient);
        $result = $r->fetch_assoc();
        return $result;
    }

    public function filterClients($nom, $wilaya){
        $am = new AdminModal();
        $r = $am->filterClients($nom, $wilaya);
        return $r;
    }

    public function getHistoryClient($idClient, $type){
        $am = new AdminModal();
        $r = $am->getHistoryClient($idClient, $type);
        return $r;
    }

    public function getNoteHistoryClient($idTraducteur){
        $am = new AdminModal();
        $r = $am->getNoteHistoryClient($idTraducteur);
        return $r;
    }

    public function getSignalementHistoryClient($idTraducteur){
        $am = new AdminModal();
        $r = $am->getSignalementHistoryClient($idTraducteur);
        return $r;
    }

    public function getClientId($clientEmail){
        $am = new AdminModal();
        $r = $am->getClientId($clientEmail);
        $result = $r->fetch_assoc();
        return $result["Id"];
    }
}

class UserController {
    public function updateInfoUser($idUser, $nom, $prenom, $email, $phone, $image){
        $am = new AdminModal();
        $r = $am->updateInfoUser($idUser, $nom, $prenom, $email, $phone, $image);
        return $r;
    }

    public function getUserFaxes($idUser){
        $am = new AdminModal();
        $r = $am->getUserFaxes($idUser);
        return $r;
    }

    public function bloquerUser($idUser){
        $am = new AdminModal();
        $r = $am->bloquerUser($idUser);
        return $r;
    }

    public function deBloquerUser($idUser){
        $am = new AdminModal();
        $r = $am->deBloquerUser($idUser);
        return $r;
    }

    public function supprimerUser($idUser){
        $am = new AdminModal();
        $r = $am->supprimerUser($idUser);
        return $r;
    }

}

class DocumentController {
    public function getNombreDocuments(){
        $am = new AdminModal();
        $r = $am->getNombreDocuments();
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }

    public function getDocuments(){
        $am = new AdminModal();
        $r = $am->getDocuments();
        return $r;
    }

    public function getDocumentInfo($idDocument){
        $am = new AdminModal();
        $r = $am->getDocumentInfo($idDocument);
        return $r;
    }

    public function deleteDocument($idDocument){
        $am = new AdminModal();
        $r = $am->deleteDocument($idDocument);
        return $r;
    }

    public function filterDocument($clientId, $traducteurId, $type, $langue){
        $am = new AdminModal();
        $r = $am->filterDocument($clientId, $traducteurId, $type, $langue);
        return $r;
    }
}

class SignalementController {
    public function getSignalementOnTraducteur($idTraducteur){
        $am = new AdminModal();
        $r = $am->getSignalementOnTraducteur($idTraducteur);
        return $r;
    }

    public function getSignalementByClient($idClient){
        $am = new AdminModal();
        $r = $am->getSignalementByClient($idClient);
        return $r;
    }

    public function seeSignalement($idSignalement){
        $am = new AdminModal();
        $r = $am->seeSignalement($idSignalement);
        return $r;
    }

    public function getSignalements(){
        $am = new AdminModal();
        $r = $am->getSignalements();
        return $r;
    }

}

class PaiementController {
    public function getDemandePaiement(){
        $am = new AdminModal();
        $r = $am->getDemandePaiement();
        return $r;
    }

    public function acceptDemandePaiement($idDemande, $type){
        $am = new AdminModal();
        $r = $am->acceptDemandePaiement($idDemande, $type);
        return $r;
    }

    public function declineDemandePaiement($idDemande, $type){
        $am = new AdminModal();
        $r = $am->declineDemandePaiement($idDemande, $type);
        return $r;
    }
}

class DemandeTraductionController {
    public function getNombreTraduction($dateDebut, $dateFin){
        $am = new AdminModal();
        $r = $am->getNombreTraduction($dateDebut, $dateFin);
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }

    public function getNombreTraductionForTraductor($idTraducteur, $dateDebut, $dateFin){
        $am = new AdminModal();
        $r = $am->getNombreTraductionForTraductor($idTraducteur, $dateDebut, $dateFin);
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }

    public function getNombreTraductionByClient($idClient, $dateDebut, $dateFin){
        $am = new AdminModal();
        $r = $am->getNombreTraductionByClient($idClient, $dateDebut, $dateFin);
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }

    public function getNombreTraductionByClientForTraductor($idClient, $idTraducteur, $dateDebut, $dateFin){
        $am = new AdminModal();
        $r = $am->getNombreTraductionByClientForTraductor($idClient, $idTraducteur, $dateDebut, $dateFin);
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }
}

class DemandeDevisController {
    public function getNombreDevis($dateDebut, $dateFin){
        $am = new AdminModal();
        $r = $am->getNombreDevis($dateDebut, $dateFin);
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }

    public function getNombreDevisForTraductor($idTraducteur, $dateDebut, $dateFin){
        $am = new AdminModal();
        $r = $am->getNombreDevisForTraductor($idTraducteur, $dateDebut, $dateFin);
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }

    public function getNombreDevisByClient($idClient, $dateDebut, $dateFin){
        $am = new AdminModal();
        $r = $am->getNombreDevisByClient($idClient, $dateDebut, $dateFin);
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }

    public function getNombreDevisByClientForTraductor($idClient, $idTraducteur, $dateDebut, $dateFin){
        $am = new AdminModal();
        $r = $am->getNombreDevisByClientForTraductor($idClient, $idTraducteur, $dateDebut, $dateFin);
        $result = $r->fetch_assoc();
        return $result["nbr"];
    }
}

?>