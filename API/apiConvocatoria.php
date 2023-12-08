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
$id = Validator::validateInput(INPUT_GET, 'id');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try{
    $convocatorias=$convocatoriaRepository->getAllConvoDest($id);
    }catch(Exception $e){
        http_response_code(500);
        echo json_encode(['error' => 'Fallo al cargar becas']);
        exit;
    }
    if($convocatorias){
        header('Content-Type: application/json');
        echo json_encode($convocatorias);
    }else{
        http_response_code(404);
        echo json_encode(["mensaje" => "No hay becas cargadas"]);
    }
}
?>