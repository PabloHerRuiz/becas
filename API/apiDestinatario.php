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


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try{
    $destinatarios=$destinatarioRepository->getAllDestinatarios();
    }catch(Exception $e){
        http_response_code(500);
        echo json_encode(['error' => 'Fallo al cargar destinatarios']);
        exit;
    }
    if($destinatarios){
        header('Content-Type: application/json');
        echo json_encode($destinatarios);
    }else{
        http_response_code(404);
        echo json_encode(["mensaje" => "No hay destinatarios"]);
    }
}
?>