<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$proyectoRepository = new proyectoRepository($conn);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $proyectos = $proyectoRepository->getAllProyectos();
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch projects']);
        exit;
    }

    if ($proyectos) {
        header('Content-Type: application/json');
        echo json_encode($proyectos);
    } else {
        http_response_code(404);
        echo json_encode(["mensaje" => "No hay proyectos"]);
    }
}
?>