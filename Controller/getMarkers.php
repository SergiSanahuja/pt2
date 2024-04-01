<?php
require_once './connexio.php';

header('Content-Type: application/json');

$db = connexio();
$query = "SELECT * FROM tallers";
$result = $db->prepare($query);

if ($result->execute()) {
    $markers = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $markers[] = $row;
    }
    echo json_encode($markers);
} else {
    echo json_encode(["error" => $result->errorInfo()]);
}
?>