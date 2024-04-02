<?php

require_once '../model/model.php';
session_start();
$_SESSION['email'] = 'Grup1@gmail.com';   

$grup = getGrup($_SESSION['email']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    
  
    
}


include '../View/Perfil.vista.php';


?>