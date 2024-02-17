<?php
function connexio(){
    try {
        echo "Conectado a la base de datos<br>";
        return $connexio = new PDO('mysql:host=localhost;dbname=activitat_de_cohesio', 'root', '');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        echo "Error al conectarse a la base de dades!";
    }
}
?>