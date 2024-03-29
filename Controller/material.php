<?php
//Comprovar que tiene la session iniciada
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

include_once 'connexio.php';

function mostrarMaterial($order){
    $conn = connexio();
    if($order == "default"){
        $sql = $conn->prepare("SELECT * FROM materials");
        $sql->execute();
        $resultat = $sql->fetchAll();
        foreach ($resultat as $material) {
            echo "<div class='card m-2' style='width: 18rem;'>";
            echo "<img src='../Assets/img/material/".$material['imatge']."' class='card-img-top' alt='".$material['imatge']."'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>".$material['nom']."</h5>";
            echo "<p class='card-text'>Quantitat: ".$material['quantitat']."</p>";
            echo "<p class='card-text'>Comprar: ".($material['pagat'] == 0 ? "No" : "Sí")."</p>";
            echo "</div>";
            echo "</div>";
        }
    }else if($order == "nom"){
        $sql = $conn->prepare("SELECT * FROM materials ORDER BY ".$order."");
        $sql->execute();
        $resultat = $sql->fetchAll();
        foreach ($resultat as $material) {
            echo "<div class='card m-2' style='width: 18rem;'>";
            echo "<img src='../Assets/img/material/".$material['imatge']."' class='card-img-top' alt='".$material['imatge']."'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>".$material['nom']."</h5>";
            echo "<p class='card-text'>Quantitat: ".$material['quantitat']."</p>";
            echo "<p class='card-text'>Comprar: ".($material['pagat'] == 0 ? "No" : "Sí")."</p>";
            echo "</div>";
            echo "</div>";
        }
    }else if($order == "quantitat"){
        $sql = $conn->prepare("SELECT * FROM materials ORDER BY ".$order." DESC");
        $sql->execute();
        $resultat = $sql->fetchAll();
        foreach ($resultat as $material) {
            echo "<div class='card m-2' style='width: 18rem;'>";
            echo "<img src='../Assets/img/material/".$material['imatge']."' class='card-img-top' alt='".$material['imatge']."'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>".$material['nom']."</h5>";
            echo "<p class='card-text'>Quantitat: ".$material['quantitat']."</p>";
            echo "<p class='card-text'>Comprar: ".($material['pagat'] == 0 ? "No" : "Sí")."</p>";
            echo "</div>";
            echo "</div>";
        }
    }
}

function afegirMaterial(){
    if(isset($_POST["agregarMaterial"]) && !empty($_POST["nomMaterialAfegir"]) && isset($_POST["quantitatMaterialAfegir"])){
        $conn = connexio();
        $name = $conn->prepare("SELECT nom FROM materials WHERE nom = ?");

        $name->execute(array(
            $_POST["nomMaterialAfegir"],
        ));
        $resultat = $name->fetch();
        if($resultat !== false && isset($resultat['nom'])){
            echo "<script>alert('Ja existeix el material')</script>";
        }else{
            // Conseguir el nombre del archivo
            $img = verificarImatge_Guardar("arxiuUsuariAfegir") ?? "default.jpg";

            $pagat = false;
            if(isset($_POST["pagatAfegirMat"])){
                $pagat = true;
            }
            $sql = $conn->prepare("INSERT INTO materials (nom, quantitat, imatge, pagat) VALUES (?, ?, ?, ?)");
            $sql->execute(array(
                $_POST["nomMaterialAfegir"],
                $_POST["quantitatMaterialAfegir"],
                $img,
                $pagat,
            ));
        }
    }
}

function modificarMaterial() {
    if (isset($_POST["modificarMaterial"]) && !empty($_POST["nomMaterialModificar"]) && isset($_POST["quantitatMaterialModificar"])) {
        $conn = connexio();
        
        $comprovarNom = $conn->prepare("SELECT * FROM materials WHERE nom = ?");
        $comprovarNom->execute(array(
            $_POST["nomMaterialModificar"],
        ));
        
        $resultat = $comprovarNom->fetch();

        if ($resultat !== false) {
            $img = verificarImatge_Guardar("arxiuUsuariModificar") ?? $resultat['imatge'] ?? "default.jpg";

            // Verificar si la cantidad es 0 y actualizar la imagen si es necesario
            if (intval($_POST["quantitatMaterialModificar"]) == 0) {
                // Eliminar la imagen anterior si no la está usando otro artículo
                $oldImage = $resultat['imatge'];
                if ($oldImage != "default.jpg") {
                    $comprovarImatge = $conn->prepare("SELECT COUNT(*) as count FROM materials WHERE imatge = ?");
                    $comprovarImatge->execute(array(
                        $oldImage,
                    ));

                    $resultatImatge = $comprovarImatge->fetch();

                    if ($resultatImatge !== false && $resultatImatge['count'] == 1) {
                        $oldImagePath = '../Assets/img/material/' . $oldImage;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }
                
                $sql = $conn->prepare("UPDATE materials SET imatge = ? WHERE nom = ?");
                $sql->execute(array(
                    $img,
                    $_POST["nomMaterialModificar"],
                ));
            } else {
                $oldImage = $resultat['imatge'];
                if ($oldImage != "default.jpg") {
                    $comprovarImatge = $conn->prepare("SELECT COUNT(*) as count FROM materials WHERE imatge = ?");
                    $comprovarImatge->execute(array(
                        $oldImage,
                    ));

                    $resultatImatge = $comprovarImatge->fetch();

                    if ($resultatImatge !== false && $resultatImatge['count'] == 1) {
                        $oldImagePath = '../Assets/img/material/' . $oldImage;
                        if (file_exists($oldImagePath) && isset($_FILES["arxiuUsuariModificar"]) && $_FILES["arxiuUsuariModificar"]["error"] !== UPLOAD_ERR_NO_FILE) {
                            unlink($oldImagePath);
                        }
                    }
                }

                $pagat = isset($_POST["pagatModificarMat"]) ? true : false;
                
                $sql = $conn->prepare("UPDATE materials SET quantitat = ?, imatge = ?, pagat = ? WHERE nom = ?");
                $sql->execute(array(
                    $_POST["quantitatMaterialModificar"],
                    $img,
                    $pagat,
                    $_POST["nomMaterialModificar"],
                ));
            }
        } else {
            echo "<script>alert('No existeix el material')</script>";
        }
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
            $nomMat = $_POST["nomMaterialEliminar"];
            $conn = connexio();
            $sql = $conn->prepare("SELECT imatge FROM materials WHERE nom = ?");
            $sql->execute(array($nomMat));
            $resultat = $sql->fetch();

            if($resultat !== false){
                $img = $resultat['imatge'];
                $comprovarImatge = $conn->prepare("SELECT COUNT(*) as count FROM materials WHERE imatge = ?");
                $comprovarImatge->execute(array($img));
                $resultatImatge = $comprovarImatge->fetch();

                if($resultatImatge !== false && $resultatImatge['count'] == 1 && $img != "default.jpg"){
                    $oldImagePath = '../Assets/img/material/' . $img;
                    if(file_exists($oldImagePath)){
                        unlink($oldImagePath);
                    }
                }

                $sql = $conn->prepare("DELETE FROM materials WHERE nom = ?");
                $sql->execute(array($nomMat));

                if($sql->rowCount() == 0){
                    echo "No existeix el material";
                } else {
                    echo json_encode(array("success" => true));
                }
            } else {
                echo "No existeix el material";
            }
        } else {
            echo "Falta omplir algun camp";
        }
    } catch (PDOException $e) {
        echo json_encode(array("success" => false, "message" => "Error al eliminar material: " . $e->getMessage()));
    }
}
//llamar a las respectivas funciones para mostrar, añadir, modificar y eliminar materiales
if(isset($_POST["agregarMaterial"])){
    afegirMaterial();
}
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["modificarMaterial"])){
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