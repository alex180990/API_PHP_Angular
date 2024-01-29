<?php

require_once '../inclus/DB.php';
require_once '../inclus/headers.php';

require_once '../controlleurs/ControlleurAvis.php';

$ControlleurAvis = new ControlleurAvis;

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])) {
        } else {
            $ControlleurAvis->afficherJSON();
        }
        break;
    case 'POST': 
            $corpsJSON = file_get_contents('php://input');
            $data = json_decode($corpsJSON, TRUE);
            $ControlleurAvis->ajouterJSON($data);
        break;

    case 'DELETE':
        if(isset($_GET['id'])) {
            $ControlleurAvis->supprimerJSON($_GET['id']);
        }
        break;
    default:
} 

?>