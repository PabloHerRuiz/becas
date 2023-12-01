<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$item_baremableRepository = new item_baremableRepository($conn);


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try{
    $items=$item_baremableRepository->getAllItem_baremables();
    }catch(Exception $e){
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch items']);
        exit;
    }
    if($items){
        header('Content-Type: application/json');
        echo json_encode($items);
    }else{
        http_response_code(404);
        echo json_encode(["mensaje" => "No hay items"]);
    }
}
?>