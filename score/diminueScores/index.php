<?php

require_once '../../inclus/DB.php';
require_once '../../inclus/headers.php';

$mysqli = new mysqli(Db::$host, Db::$username, Db::$password, Db::$database);

if ($mysqli->connect_errno) {
    echo 'Échec de connexion à la base de données MySQL: ' . $mysqli->connect_errno;
    exit();
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'PATCH':
        $reponse = new stdClass();
        $reponse->message = 'Le score a été diminué !';

        if (isset($_GET['id'])) {
            if ($requete = $mysqli->prepare("UPDATE video SET score = score - 10 WHERE id=?")) {
                $requete->bind_param("i", $_GET['id']);
                if ($requete->execute()) {
                    $requete->close();
                } else {
                    $reponse->message = 'Une erreur est survenue lors de l\'exécution de la requête : ' . $requete->error;
                }
            } else {
                $reponse->message = 'Une erreur a été détectée dans la préparation de la requête : ' . $mysqli->error;
            }
        } else {
            $reponse->message = 'L\'ID de la vidéo n\'est pas spécifié.';
        }
        break;
    default:
        
}

echo json_encode($reponse);

?>