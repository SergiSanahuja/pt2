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
        $img = verificarImatge_Guardar() ?? "default.jpg";

        $name->execute(array(
            $_POST["nomMaterial"],
        ));
        $resultat = $name->fetch();
        if($_POST["quantitatMaterial"] == 0){
            $sql = $conn->prepare("UPDATE materials SET imatge = ? WHERE nom = ?");
            $sql->execute(array(
                $img,
                $_POST["nomMaterial"],
            ));
        }
        if($resultat !== false && isset($resultat['nom'])){
            if($img == "default.jpg"){
                $sql = $conn->prepare("UPDATE materials SET quantitat = quantitat + ? WHERE nom = ?");
                $sql->execute(array(
                    $_POST["quantitatMaterial"],
                    $_POST["nomMaterial"],
                ));
            }else{
                $sql = $conn->prepare("UPDATE materials SET quantitat = quantitat + ? , imatge = ? WHERE nom = ?");
                $sql->execute(array(
                    $_POST["quantitatMaterial"],
                    $img,
                    $_POST["nomMaterial"],
                ));
            }

        }else{
            $sql = $conn->prepare("INSERT INTO materials (nom, quantitat, imatge) VALUES (?, ?, ?)");
            $sql->execute(array(
                $_POST["nomMaterial"],
                $_POST["quantitatMaterial"],
                $img,
            ));
        }
    }
}

function canviarImg(){
    if(empty($_POST["arxiuUsuari"])){
    }else if(isset($_POST["arxiuUsuari"])){
        $conn = connexio();
        verificarImatge_Guardar();
        $img = "";
        if(isset($_POST['arxiuUsuari'])){
            $img = $_FILES['arxiuUsuari'];
            echo "arribat";
        }
        echo $img;
        $sql = $conn->prepare("UPDATE materials SET imatge = ? WHERE nom = ?");
        $sql->execute(array(
            $img,
            $_POST["nomMaterial"],
        ));
        //header("Location: ../View/material.vista.php");
    }
}

function verificarImatge_Guardar() {
    if (isset($_FILES['arxiuUsuari'])) {
        $file = $_FILES['arxiuUsuari'];
        
        // Verifica si hay errores al subir el archivo
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return;
        }

        // Obtener el nombre del archivo
        $fileName = basename($file['name']); // Solo el nombre del archivo, sin ruta

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
    if(!empty($_POST["nomMaterial"]) && !empty($_POST["quantitatMaterial"])){
        ?>  <script>
                confirmarEliminar();
            </script> 
        <?php
        $conn = connexio();
        $comprovarNum = $conn->prepare("SELECT * FROM materials WHERE nom = ?");
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
            // Verificar si la imagen está siendo utilizada por otros materiales
            $num_usos_imagen = $conn->prepare("SELECT COUNT(*) as total FROM materials WHERE imatge = ?");
            $num_usos_imagen->execute(array(
                $resultat['imatge'],
            ));
            $num_usos_result = $num_usos_imagen->fetch();
            if ($num_usos_result['total'] <= 1) {
                // Solo eliminar la imagen si es el único artículo que la está utilizando
                // Ruta de la imagen
                $ruta_imagen = "../Assets/img/material/".$resultat['imatge'];
                // Verificar si el archivo de imagen existe antes de intentar eliminarlo
                if (file_exists($ruta_imagen)) {
                    // Eliminar la imagen
                    if (unlink($ruta_imagen)) {
                        //echo "La imagen ".$resultat['imatge']." fue eliminada con éxito.";
                    } else {
                        //echo "No se pudo eliminar la imagen ".$resultat['imatge'].".";
                    }
                } else {
                    //echo "La imagen ".$resultat['imatge']." no existe.";
                }
            }
            // Eliminar el material de la base de datos
            $sql = $conn->prepare("DELETE FROM materials WHERE nom = ?");
            $sql->execute(array(
                $_POST["nomMaterial"],
            ));       
        }else{
            ?>
            <script>alert("No pots eliminar més material del que hi ha o no existeix el material");</script>
            <?php
        }
        ?>

        <?php
    }
}


?>
<script>
    function confirmarEliminar(){
    var confirmar = confirm("Estas segur que vols eliminar aquest material?");
        if(confirmar){
            <?php eliminarMaterial(); ?>
        }else{
            return false;
        }
    }
</script>
<?php

if(isset($_POST["agregarAgregar"]) || isset($_POST["eliminarMaterial"])){
    header("Refresh:0");
}

require '../View/material.vista.php';
?>