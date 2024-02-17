<?php
include_once 'connexio.php';
// Ens connectem a la base de dades	
$connexio = connexio();


require '../View/home.vista.html';
?>