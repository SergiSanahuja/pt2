<?php
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
            echo "</div>";
            echo "</div>";
        }
    }
}

function afegirMaterial(){
    if(isset($_POST["agregarMaterial"]) && !empty($_POST["nomMaterialAfegir"]) && isset($_POST["quantitatMaterialAfegir"])){
        $conn = connexio();
        $name = $conn->prepare("SELECT nom FROM materials WHERE nom = ?");

        // Conseguir el nombre del archivo
        $img = verificarImatge_Guardar("arxiuUsuariAfegir") ?? "default.jpg";

        $name->execute(array(
            $_POST["nomMaterialAfegir"],
        ));
        $resultat = $name->fetch();
        if($resultat !== false && isset($resultat['nom'])){
            echo "<script>alert('Ja existeix el material')</script>";
        }else{
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

function modificarMaterial(){
    if(isset($_POST["modificarMaterial"]) && !empty($_POST["nomMaterialModificar"]) && isset($_POST["quantitatMaterialModificar"])){
        $conn = connexio();
        $comprovarNom = $conn->prepare("SELECT * FROM materials WHERE nom = ?");
        $comprovarNom->execute(array(
            $_POST["nomMaterialModificar"],
        ));
        $resultat = $comprovarNom->fetch();
        $img = verificarImatge_Guardar("arxiuUsuariModificar") ?? $resultat['imatge'] ?? "default.jpg";

        if($resultat !== false){
            // Verificar si la cantidad es 0 y actualizar la imagen si es necesario
            if(intval($_POST["quantitatMaterialModificar"]) == 0){
                $sql = $conn->prepare("UPDATE materials SET imatge = ? WHERE nom = ?");
                $sql->execute(array(
                    $img,
                    $_POST["nomMaterialModificar"],
                ));
            }else{
                $pagat = false;
                if(isset($_POST["pagatModificarMat"])){
                    $pagat = true;
                }
                $sql = $conn->prepare("UPDATE materials SET quantitat = ?, imatge = ?, pagat = ? WHERE nom = ?");
                $sql->execute(array(
                    $_POST["quantitatMaterialModificar"],
                    $img,
                    $pagat,
                    $_POST["nomMaterialModificar"],
                ));
            }

        }else {
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
    if(isset($_POST["material.php"]) && !empty($_POST["nomMaterial"]) && !empty($_POST["quantitatMaterial"])){
        $data = $_POST["material.php"];
        echo $data;

        // $conn = connexio();
        // $comprovarNom = $conn->prepare("SELECT * FROM materials WHERE nom = ?");
        // $comprovarNom->execute(array(
        //     $_POST["nomMaterial"],
        // ));
        // $resultat = $comprovarNom->fetch();
        // if($resultat !== false && isset($resultat['quantitat']) && $resultat['quantitat'] > $_POST["quantitatMaterial"]){
        //     $sql = $conn->prepare("UPDATE materials SET quantitat = quantitat - ? WHERE nom = ?");
        //     $sql->execute(array(
        //         $_POST["quantitatMaterial"],
        //         $_POST["nomMaterial"],
        //     ));
        // }else if($resultat !== false && isset($resultat['quantitat']) && $resultat['quantitat'] == $_POST["quantitatMaterial"]){
        //     // Verificar si la imagen está siendo utilizada por otros materiales
        //     $num_usos_imagen = $conn->prepare("SELECT COUNT(*) as total FROM materials WHERE imatge = ?");
        //     $num_usos_imagen->execute(array(
        //         $resultat['imatge'],
        //     ));
        //     $num_usos_result = $num_usos_imagen->fetch();
        //     if ($num_usos_result['total'] <= 1) {
        //         // Solo eliminar la imagen si es el único artículo que la está utilizando
        //         // Ruta de la imagen
        //         $ruta_imagen = "../Assets/img/material/".$resultat['imatge'];
        //         // Verificar si el archivo de imagen existe antes de intentar eliminarlo
        //         if (file_exists($ruta_imagen)) {
        //             // Eliminar la imagen
        //             if (unlink($ruta_imagen)) {
        //                 //echo "La imagen ".$resultat['imatge']." fue eliminada con éxito.";
        //             } else {
        //                 //echo "No se pudo eliminar la imagen ".$resultat['imatge'].".";
        //             }
        //         } else {
        //             //echo "La imagen ".$resultat['imatge']." no existe.";
        //         }
        //     }
        //     // Eliminar el material de la base de datos
        //     $sql = $conn->prepare("DELETE FROM materials WHERE nom = ?");
        //     $sql->execute(array(
        //         $_POST["nomMaterial"],
        //     ));       
        // }else {
        //     echo "<script>alert('No existeix el material')</script>";
        // }
    }else{
        echo "<script>Falta omplir algun camp</script>";
    }
}

if(isset($_POST["data"])){
    if($_POST["accio"] == "eliminarMaterial"){
       echo json_encode(eliminarMaterial($_POST["data"])); 
    }
}

if(isset($_POST["agregarMaterial"]) || isset($_POST["eliminarMaterial"]) || isset($_POST["modificarMaterial"])){
    //header("Refresh:0");
}

require '../View/material.vista.php';
?>