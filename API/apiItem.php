<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Fallo la conexion a la base de datos']);
    exit;
}

$item_baremableRepository = new item_baremableRepository($conn);
$convocatoria_baremoRepository = new convocatoria_baremoRepository($conn);
if (!empty($_GET['presenta'])) {
    $presenta = Validator::validateInput(INPUT_GET, 'presenta');
}
if (!empty($_GET['idConvocatorias'])) {
    $idConvocatorias = Validator::validateInput(INPUT_GET, 'idConvocatorias');
}

if (!empty($_GET['nombre'])) {
    $nombre = Validator::validateInput(INPUT_GET, 'nombre');
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($nombre)) {
        try {
            $nombres = $convocatoria_baremoRepository->getAllNomPresenta($idConvocatorias);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Fallo al cargar nombres']);
            exit;
        }
        if ($nombres) {
            header('Content-Type: application/json');
            echo json_encode($nombres);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No hay nombres"]);
        }
    } else if (!empty($presenta)) {
        try {
            $total = $convocatoria_baremoRepository->getAllItemPresenta($idConvocatorias);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Fallo al cargar total']);
            exit;
        }
        if ($total) {
            header('Content-Type: application/json');
            echo json_encode($total);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No hay total"]);
        }
    } else {
        try {
            $items = $item_baremableRepository->getAllItem_baremables();
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Fallo al cargar items']);
            exit;
        }
        if ($items) {
            header('Content-Type: application/json');
            echo json_encode($items);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No hay items"]);
        }
    }
}
?>