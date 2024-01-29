<?php

require_once 'inclus/DB.php';
require_once 'inclus/headers.php';

require_once './controlleurs/ControlleurVideos.php';

$ControlleurVideos = new ControlleurVideos;
$message = "";

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])) {
            $ControlleurVideos->afficherFicheJSON($_GET['id']);
        } else {
            $ControlleurVideos->afficherJSON();
        }
        break;
    case 'POST': 
            $corpsJSON = file_get_contents('php://input');
            $data = json_decode($corpsJSON, TRUE);
            $ControlleurVideos->ajouterJSON($data);
        break;
    case 'PUT':
        if(isset($_GET['id'])) {
            $corpsJSON = file_get_contents('php://input');
            $data = json_decode($corpsJSON, TRUE);
            $ControlleurVideos->modifierJSON($data);
        }else{
            echo json_encode(["message" => "Vous devez spécifier l'idantifiant !"]);
        }
        break;
    case 'DELETE':
        if(isset($_GET['id'])) {
            $ControlleurVideos->supprimerJSON($_GET['id']);
        }else{
            echo json_encode(["message" => "Vous devez spécifier l'idantifiant !"]);
        }
        break;
    default:
} 

?>