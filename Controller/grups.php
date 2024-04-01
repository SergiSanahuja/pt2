<?php
//Comprovar que tiene la session iniciada
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

require '../model/model.php';

if (isset($_POST['data'])) {

    $data = $_POST['data'];
    $data = json_decode($data);

    switch ($_POST['accio']) {
        case 'getUsuaris':
            
            echo json_encode(mostrarNom());
            
            exit();
            break;
        case 'eliminar':
            eliminarUsuari();
            break;
        case 'crearGrup':

            

            insertGrup($data);
       
            break;
        case 'afegirUsuari':
            // echo json_encode($data);
            insertUsuariGrup($data);
            break;

        case 'eliminarGrups':
            eliminarGrup($data);
            break;
      
       case 'getNumGrups':
            echo json_encode(getNumGrups());

            exit();
            break;
        case 'canviarGrup':
          
            canviarGrup($data);
            break;


        
    }
}

require '../View/grups.vista.php';
?>