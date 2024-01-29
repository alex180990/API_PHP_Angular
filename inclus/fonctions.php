<?php

require_once "./models/modelAuteur.php";

function ConversionAuteurSQLEnObjet($auteurSQL) {
    $auteurOBJ = new stdClass();
    $auteurOBJ->id_auteur = $auteurSQL["id_auteur"];
    $auteurOBJ->nom_auteur = $auteurSQL["nom_auteur"];
    $auteurOBJ->utilisateur_auteur = $auteurSQL["utilisateur_auteur"];
    $auteurOBJ->verifie_auteur = $auteurSQL["verifie_auteur"];
    $auteurOBJ->description_auteur = $auteurSQL["description_auteur"];

    $auteurOBJ->coordonnees = new stdClass();
    $auteurOBJ->coordonnees->courriel = $auteurSQL["courriel"];
    $auteurOBJ->coordonnees->facebook = $auteurSQL["facebook"];
    $auteurOBJ->coordonnees->instagram = $auteurSQL["instagram"];
    $auteurOBJ->coordonnees->twitch = $auteurSQL["twitch"];
    $auteurOBJ->coordonnees->site_web = $auteurSQL["site_web"];

    return $auteurOBJ;
}

function ConversionObjetEnAuteurSQL($auteurOBJ) {
    $auteurSQL = new auteur(
        $auteurOBJ->id_auteur,
        $auteurOBJ->nom_auteur,
        $auteurOBJ->utilisateur_auteur,
        $auteurOBJ->verifie_auteur,

        $auteurOBJ->coordonnees->courriel,
        $auteurOBJ->coordonnees->facebook,
        $auteurOBJ->coordonnees->instagram,
        $auteurOBJ->coordonnees->twitch,
        $auteurOBJ->coordonnees->site_web,

        $auteurOBJ->description_auteur
    );

    return $auteurSQL;
}

?>