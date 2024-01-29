<?php

require_once "./inclus/DB.php";
require_once "./models/modelAuteur.php";
require_once "./models/modelAvis.php";

require_once "./inclus/fonctions.php";

class video{

    public $id;
    public $nom;
    public $description;
    public $code;
    public $auteur;
    public $date_publication;
    public $duree;
    public $nombre_vues;
    public $score;
    public $sous_titres;
    public $avis;

    public function __construct($id, $nom, $description, $code, $date_publication, $duree, $nombre_vues, $score, $sous_titres){
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->code = $code;
        $this->date_publication = $date_publication;
        $this->duree = $duree;
        $this->nombre_vues = $nombre_vues;
        $this->score = $score;
        $this->sous_titres = $sous_titres;

    }


    static function connecter() {
        
        $mysqli = new mysqli(Db::$host, Db::$username, Db::$password, Db::$database);

        if ($mysqli -> connect_errno) {
            echo "Échec de connexion à la base de données MySQL: " . $mysqli -> connect_error;
            exit();
        } 

        return $mysqli;
    }

    private static function ajouterAuteur(Auteur $auteur)
    {
        $mysqli = self::connecter();
        $message = '';

        if ($requete = $mysqli->prepare("INSERT INTO auteur(nom_auteur, utilisateur_auteur, verifie_auteur, courriel, facebook, instagram, twitch, site_web, description_auteur) VALUES(?,?,?,?,?,?,?,?,?)")) {
            $requete->bind_param("ssissssss", $auteur->nom_auteur, $auteur->utilisateur_auteur, $auteur->verifie_auteur, $auteur->courriel, $auteur->facebook, $auteur->instagram, $auteur->twitch, $auteur->site_web, $auteur->description_auteur);

            if ($requete->execute()) {
                $message = "Auteur ajouté";
                $idAuteur = $mysqli->insert_id;
            } else {
                $message = "Une erreur est survenue lors de l'ajout: " . $requete->error;
            }
            $requete->close();
        } else {
            echo "Une erreur a été détectée dans la requête utilisée : ";
            echo $mysqli->error;
            echo "<br>";
            exit();
        }

        return array('message' => $message, 'idAuteur' => $idAuteur);
    }

    private static function modifierAuteur(Auteur $auteur){
        $mysqli = self::connecter();
        $message = '';
        $idAuteur = null;
    
        if ($requete = $mysqli->prepare("UPDATE auteur SET nom_auteur=?, utilisateur_auteur=?, verifie_auteur=?, courriel=?, facebook=?, instagram=?, twitch=?, site_web=?, description_auteur=? WHERE id_auteur=?")) {
            $requete->bind_param("ssissssssi", $auteur->nom_auteur, $auteur->utilisateur_auteur, $auteur->verifie_auteur, $auteur->courriel, $auteur->facebook, $auteur->instagram, $auteur->twitch, $auteur->site_web, $auteur->description_auteur, $auteur->id_auteur);
    
            if ($requete->execute()) {
                $idAuteur = $auteur->id_auteur;
                $message = "Auteur modifié";

            } else {
                $message = "Une erreur est survenue lors de la modification : " . $requete->error;
            }
    
            $requete->close();
        } else {
            echo "Une erreur a été détectée dans la requête utilisée : " . $mysqli->error;
            echo "<br>";
            exit();
        }
    
        return array('message' => $message, 'id_auteur' => $idAuteur);
    }

    private static function auteurExiste($idAuteur) {
        $mysqli = self::connecter();
    
        if ($requete = $mysqli->prepare("SELECT id_auteur FROM auteur WHERE id_auteur = ?")) {
            $requete->bind_param("i", $idAuteur);
            $requete->execute();
    
            $result = $requete->get_result();
            $auteurExiste = $result->num_rows > 0;
    
            $requete->close();
    
            return $auteurExiste;
        } else {
            echo "Une erreur a été détectée dans la requête utilisée : " . $mysqli->error;
            echo "<br>";
            exit();
        }
    }

    private static function supprimerAuteur(Auteur $auteur){
        $mysqli = self::connecter();
        $message ="";
        $idAuteur = null;

        if($requete = $mysqli->prepare("DELETE FROM auteur WHERE id_auteur=?")){
            $requete->bind_param("i", $auteur->id_auteur);
        
            if($requete->execute()) {
                $idAuteur = $auteur->id_auteur;
                $message = "Auteur supprimée";
            } else {
                $message =  "Une erreur est survenue lors de la suppression: " . $requete->error;
            }
        
            $requete->close();
        }else  {
            echo "Une erreur a été détectée dans la requête utilisée : ". $mysqli->error;
            echo "<br>";
            exit();
        }

        return array('message' => $message, 'id_auteur' => $idAuteur);
    }

    private static function obtenirAvisParVideoId($id)
    {
        $avis_liste = [];
        $mysqli = self::connecter();
    
        $resultatRequete = $mysqli->prepare("SELECT id_avis, note_avis, commentaire_avis, fk_video FROM avis WHERE fk_video = ?");
        
        if ($resultatRequete) {
            $resultatRequete->bind_param("i", $id);
            $resultatRequete->execute();
            $result = $resultatRequete->get_result();
    
            while ($enregistrement = $result->fetch_assoc()) {
                $avis_liste[] = new Avis($enregistrement['id_avis'], $enregistrement['note_avis'], $enregistrement['commentaire_avis'], $enregistrement['fk_video']);
            }
    
            $resultatRequete->close();
        } else {
            echo "Erreur dans la requête SQL : " . $mysqli->error;
        }
    
        return $avis_liste;
    }

    public static function ObtenirTous()
    {
        $liste = [];
        $mysqli = self::connecter();

        $resultatRequete = $mysqli->query("SELECT video.*, auteur.* FROM video INNER JOIN auteur ON video.fk_auteur = auteur.id_auteur");

        if ($resultatRequete) {
            while ($enregistrement = $resultatRequete->fetch_assoc()) {

                $video = new Video($enregistrement['id'], $enregistrement['nom'], $enregistrement['description'], $enregistrement['code'], $enregistrement['date_publication'], $enregistrement['duree'], $enregistrement['nombre_vues'], $enregistrement['score'], $enregistrement['sous_titres']);
                
                $avis_liste = self::obtenirAvisParVideoId($enregistrement['id']);
                $video->avis = $avis_liste;

                $auteurSQL = $enregistrement;
                $auteurOBJ = ConversionAuteurSQLEnObjet($auteurSQL);

                $video->auteur = $auteurOBJ;
                $liste[] = $video;
            }
            $resultatRequete->close();
        } else {
            echo "Erreur dans la requête SQL : " . $mysqli->error;
        }

        return $liste;
    }
    

    public static function ObtenirUn($id)
    {
        $mysqli = self::connecter();

        if ($requete = $mysqli->prepare("SELECT video.*, auteur.* FROM video INNER JOIN auteur ON video.fk_auteur = auteur.id_auteur WHERE video.id=?")) {
            $requete->bind_param("i", $id);
            $requete->execute();

            $result = $requete->get_result();

            if ($enregistrement = $result->fetch_assoc()) {

                $video = new Video($enregistrement['id'], $enregistrement['nom'], $enregistrement['description'], $enregistrement['code'], $enregistrement['date_publication'], $enregistrement['duree'], $enregistrement['nombre_vues'], $enregistrement['score'], $enregistrement['sous_titres']);
            
                $auteurSQL = $enregistrement;
                $auteurOBJ = ConversionAuteurSQLEnObjet($auteurSQL);

                $video->auteur = $auteurOBJ;
            } else {
                return null;
            }

            $requete->close();
        } else {
            echo "Une erreur a été détectée dans la requête utilisée : ";
            echo $mysqli->error;
            return null;
        }

        return $video;
    }

    public static function ajouter($nom, $description, $code, Auteur $auteur, $duree, $nombre_vues, $score, $sous_titres)
    {
        $message = '';
        $mysqli = self::connecter();
    
        $resultAuteur = self::ajouterAuteur($auteur);
    
        if ($resultAuteur['message'] === 'Auteur ajouté') {
            $idAuteur = $resultAuteur['idAuteur'];
    
            if ($requete = $mysqli->prepare("INSERT INTO video(nom, description, code, fk_auteur, date_publication, duree, nombre_vues, score, sous_titres) VALUES(?, ?, ?, ?, NOW(), ?, ?, ?, ?)")) {
                $requete->bind_param("ssisiiis", $nom, $description, $code, $idAuteur, $duree, $nombre_vues, $score, $sous_titres);
    
                if ($requete->execute()) {
                    $message = "Vidéo ajoutée";
                } else {
                    $message =  "Une erreur est survenue lors de l'ajout: " . $requete->error;
                }
    
                $requete->close();
            } else {
                $message = "Une erreur a été détectée dans la requête utilisée : " . $mysqli->error;
                echo "<br>";
                exit();
            }
        } else {
            $message = $resultAuteur['message'];
        }
    
        return $message;
    }

    public static function modifier($id, $nom, $description, $code, Auteur $auteur, $duree, $nombre_vues, $score, $sous_titres) {
        $message = '';
        $mysqli = self::connecter();
    
        $auteurExiste = self::auteurExiste($auteur->id_auteur);
        if (!$auteurExiste) {
            return "L'auteur n'existe pas. Impossible de mettre à jour la vidéo.";
        }
    
        $resultAuteur = self::modifierAuteur($auteur);
        $id_auteur = $resultAuteur['id_auteur'];
    
        if ($requete = $mysqli->prepare("UPDATE video SET nom=?, description=?, code=?, fk_auteur=?, duree=?, nombre_vues=?, score=?, sous_titres=? WHERE id=?")) {
            $requete->bind_param("sssiiiisi", $nom, $description, $code, $id_auteur, $duree, $nombre_vues, $score, $sous_titres, $id);
    
            if($requete->execute()) {
                $message = "Vidéo modifiée";
            } else {
                $message =  "Une erreur est survenue lors de l'édition : " . $requete->error;
            }
    
            $requete->close();
        } else  {
            echo "Une erreur a été détectée dans la requête utilisée : " . $mysqli->error;
            echo "<br>";
            exit();
        }
    
        return $message;
    }

    public static function supprimer($id, Auteur $auteur) {
        $message = '';
        $mysqli = self::connecter();

        $supprimerAvis = $mysqli->prepare("DELETE FROM avis WHERE fk_video = ?");
        $supprimerAvis->bind_param('i', $id);

        if($supprimerAvis){
            $resultAteur = self::supprimerAuteur($auteur);
            $id_auteur =  $resultAteur['id_auteur'];
            
            if ($requete = $mysqli->prepare("DELETE FROM video WHERE id=? AND fk_auteur=?")) {      
                $requete->bind_param("ii", $id, $id_auteur);
            
                if($requete->execute()) {
                    $message = "Vidéo supprimée";
                } else {
                    $message =  "Une erreur est survenue lors de la suppression: " . $requete->error;
                }
            
                $requete->close();
            } else  {
                echo "Une erreur a été détectée dans la requête utilisée : ". $mysqli->error;
                echo "<br>";
                exit();
            }
        }

        return $message;
    }
}
?>