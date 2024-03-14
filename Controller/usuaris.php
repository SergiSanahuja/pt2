<?php

    require '../model/model.php';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "activitat_de_cohesio";


    
    if (isset($_POST['data'])) {
        // Get the data
        if(($_POST['accio'])=='guardar'){
            $data = $_POST['data'];
            $data = json_decode($data);
            $servername = "localhost";
            // print_r((array)$data);
            insertarUsuari((array)$data);
            echo json_encode(mostrarUsuari());

            exit(); 
        }else if(($_POST['accio'])=='eliminar'){
            
            eliminarUsuari();

            

            exit();
        
        }else if(($_POST['accio'])=='mostrar'){
            $usuari = mostrarUsuari();

            echo json_encode($usuari);
            exit();
            
        }else if (($_POST['accio'])=='mostrarPerLletra'){
            
            echo json_encode(mostrarPerLletra());

            exit(); 
        }else if (($_POST['accio'])=='mostrarPerCurs'){
            
            echo json_encode(mostrarPerCurs());

            exit();
        }elseif (($_POST['accio'])=='mostrarPerEdat'){
            
            echo json_encode(mostrarPerEdat());

            exit();
        }
    
    }

   
        
    
 

    // Insert the data
    
    


require '../View/usuaris.vista.html';
?>