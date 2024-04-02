<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['alumno']) && $_SESSION['alumno'] === true){
    header('Location: alumnes.activitats.php');
    exit();
}

if (!isset($_SESSION['prof'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

require '../View/home.vista.php';
?>