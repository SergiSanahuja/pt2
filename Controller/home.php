<?php

// Ens connectem a la base de dades	
try {
    $connexio = new PDO('mysql:host=localhost;dbname=activitat_de_cohesio', 'root', '');
    echo "Conectado a la base de datos<br>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    echo "Error al conectarse a la base de dades!";

}


require '../View/home.vista.html';
?>