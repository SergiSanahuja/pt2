<?php
//Comprovar que tiene la session iniciada
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

//Comprovar que tiene la session iniciada de admin@example.com
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
if (isset($_SESSION['email'])) {
    $correo = $_SESSION['email'];
    if ($correo !== 'admin@example.com') {
        header('Location: home.php');
        exit();
    }
}

require '../View/crearProfes.vista.html';
?>