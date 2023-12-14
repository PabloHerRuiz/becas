<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Fallo la conexion a la base de datos']);
    exit;
}

$candidatoRepository = new candidatoRepository($conn);
if (!empty($_GET['id'])) {
    $id = Validator::validateInput(INPUT_GET, 'id');
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($id)) {
        try {
            $candidato = $candidatoRepository->getCandidatoById($id);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Fallo al cargar el perfil']);
            exit;
        }

        if ($candidato) {
            header('Content-Type: application/json');
            echo json_encode($candidato);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "No hay perfil"]);
        }
    }
} else if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    if (!empty($id)) {
        $datos = json_decode(file_get_contents("php://input"), true);
        if ($datos) {
            try {
                $candidato = new Candidato($datos['nombre'], $datos['apellidos'], null, null, $datos['curso'], $datos['correo'], $datos['telefono'], $datos['domicilio'], $datos['fecha_nacimiento'], null, null, $datos['foto'],$id);
                $candidatoRepository->updateCandidato($candidato);
                http_response_code(200);
                echo json_encode(['message' => 'Perfil actualizado correctamente']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Fallo al actualizar el perfil']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'No hay datos']);
        }
    }
}
?>