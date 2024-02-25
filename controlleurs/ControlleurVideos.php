<?php

require_once './models/modelVideo.php';

class ControlleurVideos {
    function afficherJSON() {
        $video = video::ObtenirTous();
        echo json_encode($video, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    
    function afficherFicheJSON($id) {
        $video = video::ObtenirUn($id);
        echo json_encode($video, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    function ajouterJSON($data) {
        $resultat = new stdClass();
        if(isset($data['nom']) && 
            isset($data['description']) && 
            isset($data['categorie']) && 
            isset($data['code']) && 
            isset($data['auteur']) && 
            isset($data['duree']) && 
            isset($data['nombre_vues']) && 
            isset($data['score']) && 
            isset($data['sous_titres']) && 

            isset($data['auteur']['nom_auteur']) && 
            isset($data['auteur']['utilisateur_auteur']) &&
            isset($data['auteur']['courriel']) &&
            isset($data['auteur']['facebook']) &&
            isset($data['auteur']['instagram']) && 
            isset($data['auteur']['twitch']) && 
            isset($data['auteur']['site_web']) &&  
            isset($data['auteur']['description_auteur']))
            {
            
            $auteur = new Auteur(
                $data['auteur']['id_auteur'], 
                $data['auteur']['nom_auteur'], 
                $data['auteur']['utilisateur_auteur'], 
                $data['auteur']['verifie_auteur'], 

                $data['auteur']['courriel'],
                $data['auteur']['facebook'],
                $data['auteur']['instagram'],
                $data['auteur']['twitch'],
                $data['auteur']['site_web'],

                $data['auteur']['description_auteur']
            );

            $resultat->message = video::ajouter($data['nom'], $data['description'], $data['categorie'], $data['code'], $auteur, $data['duree'], $data['nombre_vues'], $data['score'], $data['sous_titres']);
            
        } else {
            $resultat->message = "Impossible d'ajouter le vidéo. Des informations sont manquantes";
        }
        echo json_encode($resultat, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    function modifierJSON($data) {
        $resultat = new stdClass();
        if(isset($_GET['id']) && 
            isset($data['nom']) && 
            isset($data['description']) && 
            isset($data['categorie']) && 
            isset($data['code']) && 
            isset($data['auteur']) && 
            isset($data['duree']) && 
            isset($data['nombre_vues']) && 
            isset($data['score']) && 
            isset($data['sous_titres']) &&
            
            isset($data['auteur']['nom_auteur']) && 
            isset($data['auteur']['utilisateur_auteur']) &&
            isset($data['auteur']['courriel']) &&
            isset($data['auteur']['facebook']) &&
            isset($data['auteur']['instagram']) && 
            isset($data['auteur']['instagram']) && 
            isset($data['auteur']['instagram']) &&  
            isset($data['auteur']['description_auteur'])) {
            
                $auteur = new Auteur(
                    $data['auteur']['id_auteur'], 
                    $data['auteur']['nom_auteur'], 
                    $data['auteur']['utilisateur_auteur'], 
                    $data['auteur']['verifie_auteur'], 

                    $data['auteur']['courriel'],
                    $data['auteur']['facebook'],
                    $data['auteur']['instagram'],
                    $data['auteur']['twitch'],
                    $data['auteur']['site_web'],
    
                    $data['auteur']['description_auteur']
                );

            $resultat->message = video::modifier($_GET['id'], $data['nom'], $data['description'], $data['categorie'], $data['code'], $auteur, $data['duree'], $data['nombre_vues'], $data['score'], $data['sous_titres']);

        } else {
            $resultat->message = "Impossible de modifier le vidéo. Des informations sont manquantes";
        }
        echo json_encode($resultat, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    function supprimerJSON() {
        $resultat = new stdClass();

        $video = video::ObtenirUn($_GET['id']);

        if ($video) {
            $auteur = $video->auteur;

            $auteurArray = ConversionObjetEnAuteurSQL($auteur);

            $resultat->message = video::supprimer($_GET['id'], $auteurArray);
        } else {
            $resultat->message = "La vidéo n'existe pas.";
        }
        
        echo json_encode($resultat);
    }
}

?>