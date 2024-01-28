<?php

function ConversionAuteurSQLEnObjet($auteurSQL) {
    $auteurOBJ = new stdClass();
    $auteurOBJ->nom = $auteurSQL["nom_auteur"];
    $auteurOBJ->utilisateur = $auteurSQL["utilisateur_auteur"];
    $auteurOBJ->verifie = $auteurSQL["verifie_auteur"];
    $auteurOBJ->description = $auteurSQL["description_auteur"];

    $auteurOBJ->coordonnees = new stdClass();
    $auteurOBJ->coordonnees->courriel = $auteurSQL["courriel"];
    $auteurOBJ->coordonnees->facebook = $auteurSQL["facebook"];
    $auteurOBJ->coordonnees->instagram = $auteurSQL["instagram"];
    $auteurOBJ->coordonnees->twitch = $auteurSQL["twitch"];
    $auteurOBJ->coordonnees->site_web = $auteurSQL["site_web"];

    return $auteurOBJ;
}

?>