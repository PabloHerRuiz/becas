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
$convocatoria_baremoRepository = new convocatoria_baremoRepository($conn);
$destinatario_convocatoriaRepository = new destinatario_convocatoriaRepository($conn);
$convocatoria_baremo_idiomaRepository = new convocatoria_baremo_idiomaRepository($conn);

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
} else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {

    $convocatoria = $convocatoriaRepository->getConvocatoriaById($id);

    if ($convocatoria) {
        $result = $convocatoriaRepository->deleteConvocatoria($id);

        if ($result) {
            //comprobamos si hay destinatario convocatoria
            if ($destinatario_convocatoriaRepository->getDestinatarios_convocatoriaById($id)) {
                $resultDestinatario = $destinatario_convocatoriaRepository->deleteDestinatarios_convocatoria($id);
                if (!$resultDestinatario) {
                    http_response_code(500);
                    echo json_encode(["error" => "Error al eliminar el destinatario de la convocatoria"]);
                    return;
                }
            }
            //comprobamos si hay convocatoria baremo
            if ($convocatoria_baremoRepository->getConvocatoria_baremoById($id)) {
                $resultBaremo = $convocatoria_baremoRepository->deleteConvocatoria_baremo($id);
                if (!$resultBaremo) {
                    http_response_code(500);
                    echo json_encode(["error" => "Error al eliminar el baremo de la convocatoria"]);
                    return;
                }
            }
            //comprobamos si hay convocatoria baremo idioma
            if ($convocatoria_baremo_idiomaRepository->getConvocatoria_baremo_idiomaById($id)) {
                $resultBaremoIdioma = $convocatoria_baremo_idiomaRepository->deleteConvocatoria_baremo_idioma($id);
                if (!$resultBaremoIdioma) {
                    http_response_code(500);
                    echo json_encode(["error" => "Error al eliminar el baremo de idioma de la convocatoria"]);
                    return;
                }
            }
            http_response_code(200);
            echo json_encode(["mensaje" => "Convocatoria eliminada exitosamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error al eliminar la convocatoria"]);
        }
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Convocatoria no encontrada"]);
    }
} else if ($_SERVER["REQUEST_METHOD"] == "PUT") {

    // Obtén los datos enviados en la solicitud POST
    $datos = json_decode(file_get_contents("php://input"), true);
    if ($datos) {

        $convocatoria = new Convocatorias($datos['codProyecto'], $datos['movilidades'], $datos['destinos'], $datos['tipo'], $datos['fecha_ini'], $datos['fecha_fin'], $datos['fecha_ini_pruebas'], $datos['fecha_fin_pruebas'], $datos['fecha_lis_definitiva'], $datos['fecha_lis_provisional'], $datos['id']);

        $result = $convocatoriaRepository->updateConvocatoria($convocatoria);

        if ($result) {
            http_response_code(200);
            echo json_encode(["mensaje" => "Convocatoria actualizada exitosamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Error al actualizar la convocatoria"]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "No se han enviado datos"]);

    }
}
?>