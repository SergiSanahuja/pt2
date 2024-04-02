<?php
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

include_once '../Model/canviarContrasenya.model.php';

function canviarContrasenya() {
    if (isset($_POST['btnCanviarContrasenya']) && !empty($_POST['passActual']) && !empty($_POST['pass']) && !empty($_POST['pass2'])) {
        $passActual = $_POST['passActual'];
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];

        if ($pass === $pass2) {
            if (canviarContrasenyaBD($passActual, $pass)) {
                echo "<script>alert('Contrasenya canviada correctament')</script>";
            } else {
                echo "<script>alert('Contrasenya actual incorrecta')</script>";
            }
        } else {
            echo "<script>alert('Les contrasenyes no coincideixen')</script>";
        }
    }
}

if (isset($_POST['btnCanviarContrasenya'])) {
    canviarContrasenya();
    header('Refresh:0');
}

require '../View/canviarContrasenya.vista.php';
?>