<?php
require_once './connexio.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = connexio(); // Usar la función de conexión que definiste en connexio.php
    
    // Captura de datos del formulario
    $nom = $_POST['nom'] ?? null; 
    $professor = $_POST['professor'] ?? null;
    $material = $_POST['material'] ?? null;
    
    //? ¿Podríamos manejar la carga del archivo si es necesario?
    //! Si estás subiendo una imagen, tendrás que manejar $_FILES['nombre_del_input']
    
    if ($nom && $professor && $material) {
        // Preparación de la sentencia SQL para insertar datos
        $query = $db->prepare("INSERT INTO tallers (nom, material, professor) VALUES (?, ?, ?)");
        $result = $query->execute([$nom, $professor, $material]);
        
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
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}

?>
