<?php
require_once "./inclus/DB.php";

class auteur{
    public $id_auteur;
    public $nom_auteur;
    public $utilisateur_auteur;
    public $verifie_auteur;

    public $courriel;
    public $facebook;
    public $instagram;
    public $twitch;
    public $site_web;

    public $description_auteur;

    public function __construct($id_auteur, $nom_auteur, $utilisateur_auteur, $verifie_auteur, $courriel, $facebook, $instagram, $twitch, $site_web, $description_auteur){
        $this->id_auteur = $id_auteur;
        $this->nom_auteur = $nom_auteur;
        $this->utilisateur_auteur = $utilisateur_auteur;
        $this->verifie_auteur = $verifie_auteur;

        $this->courriel = $courriel;
        $this->facebook = $facebook;
        $this->instagram = $instagram;
        $this->twitch = $twitch;
        $this->site_web = $site_web;

        $this->description_auteur = $description_auteur;
    }
}

?>