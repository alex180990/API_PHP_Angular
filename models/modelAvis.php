<?php

class avis {

    public $id_avis;
    public $note_avis;
    public $commentaire_avis;
    public $fk_video;

    public function __construct($id_avis, $note_avis, $commentaire_avis, $fk_video){
        $this->id_avis = $id_avis;
        $this->note_avis = $note_avis;
        $this->commentaire_avis = $commentaire_avis;
        $this->fk_video = $fk_video;
    }

    static function connecter() {
        
        $mysqli = new mysqli(Db::$host, Db::$username, Db::$password, Db::$database);

        if ($mysqli -> connect_errno) {
            echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;
            exit();
        } 

        return $mysqli;
    }

    public static function ObtenirTous() {
        $avis_liste = [];
        $mysqli = self::connecter();
    
        $resultatRequete = $mysqli->query("SELECT id_avis, note_avis, commentaire_avis, fk_video FROM avis ORDER BY id_avis");
    
        if ($resultatRequete) {
            foreach ($resultatRequete as $enregistrement) {
                $avis_liste[] = new avis($enregistrement['id_avis'], $enregistrement['note_avis'], $enregistrement['commentaire_avis'], $enregistrement['fk_video']);
            }
            $resultatRequete->close();
        } else {
            echo "Erreur dans la requête SQL : " . $mysqli->error;
        }
    
        return $avis_liste;
    }

    public static function ajouter($note_avis, $commentaire_avis, $fk_video)
    {
        $message = '';
        $mysqli = self::connecter();

        if ($requete = $mysqli->prepare("INSERT INTO avis(note_avis, commentaire_avis, fk_video) VALUES(?, ?, ?)")) {

            $requete->bind_param("isi", $note_avis, $commentaire_avis, $fk_video);

            if ($requete->execute()) {
                $message = "Avis ajouté";
            } else {
                $message =  "Une erreur est survenue lors de l'ajout: " . $requete->error;
            }

            $requete->close();
        } else {
            echo "Une erreur a été détectée dans la requête utilisée : ";
            echo $mysqli->error;
            echo "<br>";
            exit();
        }

        return $message;
    }
}

?>