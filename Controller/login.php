<?php
// si ha echo submit redirigir a la pagina de home
if (isset($_POST['submit'])) {

    $usuario = $_POST['nom'];
    $password = $_POST['pass'];

    if ($usuario == 'admin' && $password == 'admin') {
        session_start();
        $_SESSION['usuario'] = $usuario;
        header('Location: home.php');
    } else {
        echo $error = 'Usuario o contraseña incorrectos';
    }

    // header('Location: home.php');
}


require '../View/login.vista.html';
?>