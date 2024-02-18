<?php
function connexio(){
    try {
        return $connexio = new PDO('mysql:host=localhost;dbname=activitat_de_cohesio', 'root', '');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        echo "Error al conectarse a la base de dades!";
    }
}
?>