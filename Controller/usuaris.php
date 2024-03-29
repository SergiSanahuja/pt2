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

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "activitat_de_cohesio";


    
    if (isset($_POST['data'])) {
        // Get the data
        $data = $_POST['data'];
        $data = json_decode($data);
        $servername = "localhost";
        
        
        if(($_POST['accio'])=='guardar'){
            
           
            if($data[0][4] != null){

                modificarUser($data);
                
                
            }else{
                insertarUsuari($data);
                
            }
            echo $data[0][3];
            // print_r((array)$data);
            // echo ((array) $data);
            // echo json_encode(mostrarUsuari());

            exit(); 
        }
        else if(($_POST['accio'])=='eliminar'){
            
            eliminarUsuari();

            exit();
        
        }else if (($_POST['accio'])=='borrar'){
           
            
            borrarUsuari($data);
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
    
    


require '../View/usuaris.vista.php';
?>