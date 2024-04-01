<?php

require_once '../model/model.php';
session_start();
$_SESSION['email'] = 'Grup1@gmail.com';   

$grup = getGrup($_SESSION['email']);




include '../View/Perfil.vista.php';


?>