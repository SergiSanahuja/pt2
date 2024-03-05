<?php
if(isset($_POST['data'])){
    $data = $_POST['data'];
    $data = json_decode($data);
    $servername = "localhost";
    echo 'hola';   
}
else{
    print_r($_POST);
    // Print the keys inside the $_POST array
    foreach($_POST as $key => $value){
        echo $key . ' ';
    }
    
}
?>