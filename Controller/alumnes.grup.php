<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once '../Model/model.php';

$grup = getGrup($_SESSION['email']);

$puntuacio = getPuntuacio($grup->nom); 

$UsuarisGrup = getUsuarisGrup($grup->nom);

require_once '../View/alumne.grup.view.php';


?>