<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$convocatoriaRepository = new convocatoriaRepository($conn);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = Validator::validateInput(INPUT_POST, 'username');
    $password = Validator::validateInput(INPUT_POST, 'password');

    echo json_encode(["id" => "aqui iria la id de convocatoria"]);
}
?>