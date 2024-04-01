<?php
include_once '../model/model.php';  // Replace with the correct path

if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

//if the user pressed the button to log out
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');  // Redirect to login page after logging out
    exit();
}

// If user is already logged in, redirect to home page
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: home.php');
    exit();
}

// Create an admin user and password
$adminEmail = 'admin@example.com';
$adminPassword = 'admin123';
$provaEmail = 'prova@example.com';
$provaPassword = 'prova123';

// Check if the admin user exists in the database
if (!getUserByEmail($adminEmail)) {
    // Hash the admin password
    $hashedAdminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);
    
    // Create the admin user in the database
    createUser($adminEmail, $hashedAdminPassword);
}
if (!getUserByEmail($provaEmail)) {
    // Hash the admin password
    $hashedProvaPassword = password_hash($provaPassword, PASSWORD_DEFAULT);
    
    // Create the admin user in the database
    createUser($provaEmail, $hashedProvaPassword);
}

$error = '';

if (isset($_POST['submit']) && !empty($_POST['correu']) && !empty($_POST['pass'])){
    $email = $_POST['correu'];
    $password = $_POST['pass'];

    //Check if the email and password are empty
    if (empty($email) || empty($password)) {
        $error = "Empty email or password";
    }

    //Check if the user exists in the database
    if (!getUserByEmail($email)) {
        $error = "Credencials incorrectes";
    }

    // Retrieve the hashed password from the database
    $hashed_password = getPasswordByEmail($email);

    if ($hashed_password && password_verify($password, $hashed_password)) {
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email; // Guardar el correo electrónico en la sesión
        header('Location: home.php');  // Redirigir a la página de inicio después de un inicio de sesión exitoso
        exit();
    } else {
        $error = "Credencials incorrectes";
    }
}

if (!empty($error)) {
    echo $error;
}

require '../View/login.vista.html';
?>