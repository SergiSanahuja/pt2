<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

require '../model/model.php';

$activitats = getActivitats();
$nomGrups = getNomGrups();
$nomGrups = array_chunk($nomGrups, 2);
require '../View/alumne.activitats.vista.php';



?>