<?php
// Comprobar que tiene la sesión iniciada
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] !== true) {
    header('Location: home.php');
    exit();
}

// Comprobar que tiene la sesión iniciada de admin@example.com
if (!isset($_SESSION['admin'])) {
    header('Location: home.php');
    exit();
}

include_once '../model/profes.model.php';

function mostrarProfes(){
    $profes = consultarProfes();
    foreach($profes as $profe){
        echo "<tr>";
        echo "<td>".(!empty($profe['id']) ? $profe['id'] : "No hi ha id")."</td>";
        echo "<td>".(!empty($profe['nom']) ? $profe['nom'] : "No hi ha nom")."</td>";
        echo "<td>".(!empty($profe['cognom']) ? $profe['cognom'] : "No hi ha cognom")."</td>";
        echo "<td>".(!empty($profe['email']) ? $profe['email'] : "No hi ha email")."</td>";
        echo "</tr>";
    }
}

function afegirProfes(){
  $nom = $_POST['nomProfesAfegir'];
  $cognom = $_POST['cognomProfesAfegir'];
  $email = $_POST['emailProfesAfegir'];
  $password = $_POST['passwordProfesAfegir'];
  if(!empty($nom) && !empty($cognom) && !empty($email) && !empty($password)){
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    afegirProfesBD($nom, $cognom, $email, $hashedPassword);
  }else {
    if(empty($nom)) {
      echo "Error: Falta el campo 'nom' para añadir el profesor.";
    } else if(empty($cognom)) {
      echo "Error: Falta el campo 'cognom' para añadir el profesor.";
    } else if(empty($email)) {
      echo "Error: Falta el campo 'email' para añadir el profesor.";
    } else if(empty($password)) {
      echo "Error: Falta el campo 'password' para añadir el profesor.";
    }
  }
}

function modificarProfes(){
  $id = $_POST['idProfesModificar'];
  $nom = $_POST['nomProfesModificar'];
  $cognom = $_POST['cognomProfesModificar'];
  $email = $_POST['emailProfesModificar'];
  $password = $_POST['passwordProfesModificar'];
  if(!empty($id)){
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    modificarProfesBD($id, $nom, $cognom, $email, $hashedPassword);
  } else {
    if(empty($id)) {
      echo "Error: Falta el campo 'id' para modificar el profesor.";
    }
  }
}

function eliminarProfes(){
  try {
    if(isset($_POST["accio"]) && $_POST["accio"] == "eliminarProfessor" && isset($_POST["idProfesEliminar"]) && !empty($_POST["idProfesEliminar"])){
      eliminarProfesBD($_POST["idProfesEliminar"]);
    } else {
        echo "Falta omplir algun camp";
    }
  } catch (PDOException $e) {
      echo json_encode(array("success" => false, "message" => "Error al eliminar material: " . $e->getMessage()));
  }
}


if(isset($_POST['agregarProfes'])){
  afegirProfes();
}

if(isset($_POST['btnModifyProfes'])){
  modificarProfes();
}

if(isset($_POST["accio"]) && $_POST["accio"] == "eliminarProfessor"){
  eliminarProfes();
}

if(isset($_POST['agregarProfes']) || isset($_POST['btnModifyProfes']) || isset($_POST['eliminarProfes'])){
  header('Refresh:0');
}

require '../View/profes.vista.php';
?>