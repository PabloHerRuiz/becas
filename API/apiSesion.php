<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

$login = new login();

try {
    $login->user_logout();
    http_response_code(200);
    $response = ['respuesta' => 'OK'];
} catch (Exception $e) {
    http_response_code(500);
    $response = ['respuesta' => 'Error', 'mensaje' => $e->getMessage()];
}

header('Content-Type: application/json');
echo json_encode($response);
?>