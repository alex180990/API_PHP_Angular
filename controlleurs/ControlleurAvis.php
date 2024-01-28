<?php

require_once '../models/modelAvis.php';

class ControlleurAvis {
    function afficherJSON() {
        $avis = avis::ObtenirTous();
        echo json_encode($avis);
    }
    
    function ajouterJSON($data) {

        $resultat = new stdClass();
        if(isset($data['note_avis']) && isset($data['commentaire_avis']) && isset($data['fk_video'])) {
            
        $resultat->message = avis::ajouter($data['note_avis'], $data['commentaire_avis'], $data['fk_video']);
            
        } else {
            $resultat->message = "Impossible d'ajouter l'avis. Des informations sont manquantes";
        }
        echo json_encode($resultat);
    }
}
?>