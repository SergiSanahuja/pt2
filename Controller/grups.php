<?php
require '../model/model.php';

if (isset($_POST['data'])) {

    switch ($_POST['accio']) {
        case 'getUsuaris':
            
            echo json_encode(mostrarNom());
            
            exit();
            break;
        case 'eliminar':
    }
}

require '../View/grups.vista.html';
?>