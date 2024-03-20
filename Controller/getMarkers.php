<?php
require_once './connexio.php';

header('Content-Type: application/json');

$db = connexio();
$result = $db->query("SELECT * FROM tallers");

$markers = [];

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $markers[] = $row;
}

echo json_encode($markers);
