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
    if(isset($_POST["agregarAgregar"]) && !empty($_POST["nomMaterial"]) && !empty($_POST["quantitatMaterial"])){
        $conn = connexio();
        $name = $conn->prepare("SELECT nom FROM materials WHERE nom = ?");

        //Conseguir el nombre del archivo
        verificarImatge();
        $img = "";
        if(isset($_POST['arxiuUsuari'])){
            $img = $_POST['arxiuUsuari'];
        }

        $name->execute(array(
            $_POST["nomMaterial"],
        ));
        $resultat = $name->fetch();
        if($resultat !== false && isset($resultat['nom'])){
            $sql = $conn->prepare("UPDATE materials SET quantitat = quantitat + ? WHERE nom = ?");
            $sql->execute(array(
                $_POST["quantitatMaterial"],
                $_POST["nomMaterial"],
            ));
        }else{
            $sql = $conn->prepare("INSERT INTO materials (nom, quantitat, imatge) VALUES (?, ?, ?)");
            $sql->execute(array(
                $_POST["nomMaterial"],
                $_POST["quantitatMaterial"],
                $img,
            ));
            //header("Location: ../View/material.vista.php");
        }
    }
}

function canviarImg(){
    if(empty($_POST["arxiuUsuari"])){

    }else if(isset($_POST["arxiuUsuari"])){
        $conn = connexio();
        verificarImatge();
        $img = "";
        if(isset($_POST['arxiuUsuari'])){
            $img = $_POST['arxiuUsuari'];
        }
        $sql = $conn->prepare("UPDATE materials SET imatge = ? WHERE nom = ?");
        $sql->execute(array(
            $img,
            $_POST["nomMaterial"],
        ));
        //header("Location: ../View/material.vista.php");
    }
}

function verificarImatge(){
    if (isset($_FILES['arxiuUsuari'])) {
        
        $file = $_FILES['arxiuUsuari'];
    
        // Obtener el nombre del archivo
        $fileName = $file['name'];
    
        // Especificar la carpeta de destino
        $destination = '../Assets/img/material/' . $fileName. '.png';
    
        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            echo 'El archivo se ha cargado correctamente.';
        } else {
            echo 'Ocurrió un error al cargar el archivo.';
        }
    }
}

function eliminarMaterial(){
    if(isset($_POST["eliminarMaterial"]) && !empty($_POST["nomMaterial"]) && !empty($_POST["quantitatMaterial"])){
        $conn = connexio();
        $comprovarNum = $conn->prepare("SELECT quantitat FROM materials WHERE nom = ?");
        $comprovarNum->execute(array(
            $_POST["nomMaterial"],
        ));
        $resultat = $comprovarNum->fetch();
        if($resultat !== false && isset($resultat['quantitat']) && $resultat['quantitat'] > $_POST["quantitatMaterial"]){
            $sql = $conn->prepare("UPDATE materials SET quantitat = quantitat - ? WHERE nom = ?");
            $sql->execute(array(
                $_POST["quantitatMaterial"],
                $_POST["nomMaterial"],
            ));
        }else if($resultat !== false && isset($resultat['quantitat']) && $resultat['quantitat'] == $_POST["quantitatMaterial"]){
            $sql = $conn->prepare("DELETE FROM materials WHERE nom = ?");
            $sql->execute(array(
                $_POST["nomMaterial"],
            ));
        }else{
            ?>
            <script>alert("No pots eliminar més material del que hi ha");</script>
            <?php
        }
        //header("Location: ../View/material.vista.php");
    }
}
require '../View/material.vista.php';
?>