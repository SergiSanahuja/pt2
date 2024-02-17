<?php
include_once 'connexio.php';


function mostrarMaterial(){
    $conn = connexio();
    $sql = $conn->prepare("SELECT * FROM materials");
    $sql->execute();
    $resultat = $sql->fetchAll();
    foreach ($resultat as $material) {
        echo "<img src='../Assets/img/material/".$material['imatge']."' class='card-img-top' alt='".$material['imatge']."'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>".$material['nom']."</h5>";
        echo "<p class='card-text'>Quantitat: ".$material['quantitat']."</p>";
        echo "</div>";
    }
}

function afegirMaterial(){
    if(isset($_POST["agregarAgregar"]) && !empty($_POST["nomMaterial"]) && !empty($_POST["quantitatMaterial"])){
        $conn = connexio();
        $imatge = isset($_FILES['arxiuPujat']['name']) ? $_FILES['arxiuPujat']['name'] : '';
        $sql = $conn->prepare("INSERT INTO materials (nom, quantitat, imatge) VALUES (?, ?, ?)");
        $sql->execute(array(
            $_POST["nomMaterial"],
            $_POST["quantitatMaterial"],
            $imatge,
        ));
        header("Location: ../View/material.vista.php");
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
        //Hacer que se recargue la página
        header("Location: ../View/material.vista.php");
    }
}

require '../View/material.vista.php';
?>