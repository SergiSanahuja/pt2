<?php
require_once './connexio.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = connexio(); // Usar la función de conexión que definiste en connexio.php

    // Captura de datos del formulario
    $nom = $_POST['nom'] ?? null; 
    $professor = $_POST['professor'] ?? null;
    $material = $_POST['material'] ?? null;
    $lat = $_POST['lat'] ?? null; 
    $lng = $_POST['lng'] ?? null;
    
    
    if ($nom && $professor && $material && $lat && $lng) {
        $query = $db->prepare("INSERT INTO tallers (nom, material, professor, lat, lng) VALUES (?, ?, ?, ?, ?)");
        $result = $query->execute([$nom, $material, $professor, $lat, $lng]);

        if($result) {
            echo json_encode(['success' => true]);
        } else {
            // Obtén información sobre el error
            $errorInfo = $query->errorInfo();
            echo json_encode(['success' => false, 'error' => $errorInfo[2]]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método de solicitud no permitido']);
}

?>
