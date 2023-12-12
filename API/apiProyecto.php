<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Fallo la conexion a la base de datos']);
    exit;
}

$proyectoRepository = new proyectoRepository($conn);

if(!empty($_GET['idConvocatorias'])){
    $idConvocatorias = Validator::validateInput(INPUT_GET,'idConvocatorias');
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET['documento'])) {
        try {
            $nombre = $proyectoRepository->getNomProById($idConvocatorias);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Fallo al cargar proyecto']);
            exit;
        }

        if ($nombre) {
            header('Content-Type: application/json');
            echo json_encode($nombre);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No hay nombre del proyecto"]);
        }
    } else {
        try {
            $proyectos = $proyectoRepository->getAllProyectos();
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Fallo al cargar proyectos']);
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
}
?>