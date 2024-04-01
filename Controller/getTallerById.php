<?php
require_once './connexio.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])) {
    $tallerId = $_POST['id'];
    $db = connexio();

    try {
        $query = $db->prepare("SELECT * FROM tallers WHERE id = ?");
        $query->execute([$tallerId]);
        
        $taller = $query->fetch(PDO::FETCH_ASSOC);
        if($taller) {
            echo json_encode(['success' => true, 'taller' => $taller]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Taller no encontrado.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID del taller no proporcionado.']);
}
?>
