<?php
// si ha echo submit redirigir a la pagina de home
if (isset($_POST['submit'])) {
    header('Location: home.php');
}


require '../View/login.vista.html';
?>