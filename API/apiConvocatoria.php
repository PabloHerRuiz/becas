<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Fallo la conexion a la base de datos']);
    exit;
}

$convocatoriaRepository = new convocatoriaRepository($conn);
$candidato_convocatoriaRepository = new candidato_convocatoriaRepository($conn);

if (!empty($_GET['id'])) {
    $id = Validator::validateInput(INPUT_GET, 'id');
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['baremacion'])) {
        try {
            $convocatorias = $convocatoriaRepository->getAllConvocatorias();
            $candidato_convocatoria = $candidato_convocatoriaRepository->getAllCandidato_convocatorias();
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Fallo al cargar datos baremacion']);
            exit;
        }

        $baremacion = [
            "convocatorias" => $convocatorias,
            "solicitudes" => $candidato_convocatoria
        ];

        if ($baremacion) {
            header('Content-Type: application/json');
            echo json_encode($baremacion);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No hay datos de baremacion cargados"]);
        }
    } else {
        if (!empty($_GET["todas"])) {
            try {
                $convocatorias = $convocatoriaRepository->getAllConvocatorias();
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Fallo al cargar convocatorias']);
                exit;
            }
            if ($convocatorias) {
                header('Content-Type: application/json');
                echo json_encode($convocatorias);
            } else {
                http_response_code(404);
                echo json_encode(["mensaje" => "No hay convocatorias cargadas"]);
            }
        } else {
            try {
                $convocatorias = $convocatoriaRepository->getAllConvoDest($id);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Fallo al cargar becas']);
                exit;
            }
            if ($convocatorias) {
                header('Content-Type: application/json');
                echo json_encode($convocatorias);
            } else {
                http_response_code(404);
                echo json_encode(["mensaje" => "No hay becas cargadas"]);
            }
        }
    }
}
?>