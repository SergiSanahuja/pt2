<?php
//Comprovar que tiene la session iniciada
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

include_once '../model/material.model.php';

function afegirMaterial(){
    if(isset($_POST["agregarMaterial"]) && !empty($_POST["nomMaterialAfegir"]) && isset($_POST["quantitatMaterialAfegir"])){
        afegirMaterialBD();
    }
}

function modificarMaterial() {
    if (isset($_POST["modificarMaterial"]) && !empty($_POST["nomMaterialModificar"]) && isset($_POST["quantitatMaterialModificar"])) {
        modificarMaterialBD();
    }
}

function verificarImatge_Guardar($id) {
    if (isset($_FILES[$id])) {
        $file = $_FILES[$id];
        
        // Verifica si hay errores al subir el archivo
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return;
        }

        // Obtener el nombre del archivo
        $fileName = basename($file['name']); // Solo el nombre del archivo, sin ruta

        // Obtener la extensión del archivo
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Verificar si la extensión es válida
        if (!in_array($fileExtension, ['png', 'jpg', 'svg'])) {
            return;
        }

        // Especificar la carpeta de destino
        $destination = '../Assets/img/material/' . $fileName;

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $fileName;
        } else {
        }
    }
}

function eliminarMaterial(){
    try {
        if(isset($_POST["accio"]) && $_POST["accio"] == "eliminarMaterial" && isset($_POST["nomMaterialEliminar"]) && !empty($_POST["nomMaterialEliminar"])){
            eliminarMaterialBD();
        } else {
            echo json_encode(array("success" => false, "message" => "Falta omplir algun camp"));
        }
    } catch (PDOException $e) {
        echo json_encode(array("success" => false, "message" => "Error al eliminar material: " . $e->getMessage()));
    }
}


//llamar a las respectivas funciones para mostrar, añadir, modificar y eliminar materiales
if(isset($_POST["agregarMaterial"])){
    afegirMaterial();
}
if(isset($_POST["modificarMaterial"])){
    modificarMaterial();
}
if(isset($_POST["accio"]) && $_POST["accio"] == "eliminarMaterial"){
    eliminarMaterial();
}


if(isset($_POST["agregarMaterial"]) || isset($_POST["eliminarMaterial"]) || isset($_POST["modificarMaterial"])){
    header("Refresh:0");
}

require '../View/material.vista.php';
?>