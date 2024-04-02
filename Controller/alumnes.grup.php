<?php

require_once '../Model/model.php';
session_start();

$grup = getGrup($_SESSION['email']);



$UsuarisGrup = getUsuarisGrup($grup->nom);

require_once '../View/alumne.grup.view.php';


?>