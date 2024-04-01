<?php
require_once './connexio.php';

// Asegúrate de que se envíe el encabezado correcto para JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = connexio(); // Usar la función de conexión que definiste en connexio.php

    // Captura de datos del formulario
    $nom = $_POST['nom'] ?? null;
    $professor = $_POST['professor'] ?? null;
    $material = $_POST['material'] ?? null;
    $lat = $_POST['lat'] ?? null;
    $lng = $_POST['lng'] ?? null;

    if ($nom && $professor && $material && $lat && $lng) {
        try {
            $query = $db->prepare("INSERT INTO tallers (nom, material, professor, lat, lng) VALUES (?, ?, ?, ?, ?)");
            $result = $query->execute([$nom, $material, $professor, $lat, $lng]);

            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                // Si no se pudo realizar la inserción por alguna razón no relacionada con una excepción
                $errorInfo = $query->errorInfo();
                echo json_encode(['success' => false, 'error' => $errorInfo[2]]);
            }
        } catch (PDOException $e) {
            // Captura cualquier error de la base de datos y lo devuelve como JSON
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método de solicitud no permitido']);
}
?>
