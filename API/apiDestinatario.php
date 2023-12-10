<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Fallo la conexion a la base de datos']);
    exit;
}

$destinatarioRepository = new destinatarioRepository($conn);
if (!empty($_GET['id'])) {
    $id = Validator::validateInput(INPUT_GET, 'id');
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($id)) {
        try {
            $destinatarios = $destinatarioRepository->getCodGrupoPorId($id);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Fallo al cargar el codigo de grupo']);
            exit;
        }
        if ($destinatarios) {
            header('Content-Type: application/json');
            echo json_encode($destinatarios);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No hay codigo de grupo"]);
        }

    } else {
        try {
            $destinatarios = $destinatarioRepository->getAllDestinatarios();
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Fallo al cargar destinatarios']);
            exit;
        }
        if ($destinatarios) {
            header('Content-Type: application/json');
            echo json_encode($destinatarios);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No hay destinatarios"]);
        }
    }
}
?>