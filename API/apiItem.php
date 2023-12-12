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

if (!empty($_GET['idConvocatorias'])) {
    $idConvocatorias = Validator::validateInput(INPUT_GET, 'idConvocatorias');
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['archivos'])) {
        try {
            $nombres = $convocatoria_baremoRepository->getAllNomPresenta($idConvocatorias);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Fallo al cargar archivos']);
            exit;
        }
        if ($nombres) {
            header('Content-Type: application/json');
            echo json_encode($nombres);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No hay archivos cargados"]);
        }
    } else if (!empty($_GET['baremacion'])) {
        try {
            $baremables = $convocatoria_baremoRepository->getAllBaremables($idConvocatorias);
            $nombres = $convocatoria_baremoRepository->getAllNomConvo($idConvocatorias);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Fallo al cargar baremables']);
            exit;
        }
        $baremacion=[
            "baremables"=>$baremables,
            "nombres"=>$nombres
        ];
        
        if ($baremacion) {
            header('Content-Type: application/json');
            echo json_encode($baremacion);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No hay baremables cargados"]);
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