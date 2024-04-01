<?php
require_once './connexio.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $db = connexio();

    $id = $_POST['id'];
    $nom = $_POST['nom'] ?? '';
    $professor = $_POST['professor'] ?? '';
    $material = $_POST['material'] ?? '';

    try {
        $query = $db->prepare("UPDATE tallers SET nom = ?, material = ?, professor = ? WHERE id = ?");
        $result = $query->execute([$nom, $material, $professor, $id]);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            $errorInfo = $query->errorInfo();
            echo json_encode(['success' => false, 'error' => $errorInfo[2]]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos o método de solicitud incorrecto']);
}
?>
