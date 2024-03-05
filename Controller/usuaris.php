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

        exit(); 
    }else if(($_POST['accio'])=='eliminar'){
        
        eliminarUsuari();

        exit();
    
    }
   
}
        
    
 

    // Insert the data
    
    


require '../View/usuaris.vista.html';
?>