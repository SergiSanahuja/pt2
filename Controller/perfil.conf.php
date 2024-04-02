<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once '../model/model.php';

$grup = getGrup($_SESSION['email']);

if(isset($_POST['nom'])){
    $nom = $_POST['nom'];
    
    // Comprobar si se ha subido una nueva imagen
    if(isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] == 0){
        $fotoPerfil = $_FILES['fotoPerfil']['name'];
        $tmp_name = $_FILES['fotoPerfil']['tmp_name'];
        
        // Mover la imagen a la carpeta deseada
        $uploads_dir = '../Assets/img/grups/';
        move_uploaded_file($tmp_name, $uploads_dir . $fotoPerfil);
    } else {
        $fotoPerfil = null; // No se cambia la imagen
    }
    
    $result = updatePerfil($nom, $fotoPerfil, $grup->nom);
    
    if($result){
        echo "<script>alert('Perfil actualitzat correctament')</script>";
    } else {
        echo "<script>alert('Error al actualitzar el perfil')</script>";
    }
}

include '../View/perfil.vista.php';
?>
