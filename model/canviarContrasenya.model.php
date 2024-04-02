<?php
require_once 'connexio.php';

function canviarContrasenyaBD($passActual, $pass) {
    $conn = connexio();
    $email = $_SESSION['email'];
    $sql = "SELECT password FROM usuaris WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if (password_verify($passActual, $result['password'])) {
        $conn = connexio();
        $sql = "UPDATE usuaris SET password = :pass WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pass', password_hash($pass, PASSWORD_DEFAULT));
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $conn = null;
        return true;
    } else {
        return false;
    }
}
?>