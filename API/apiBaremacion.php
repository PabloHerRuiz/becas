<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Fallo la conexion a la base de datos']);
    exit;
}

$baremacionRepository = new baremacionRepository($conn);
$idConvocatorias = Validator::validateInput(INPUT_GET, 'idConvocatorias');
$id = Validator::validateInput(INPUT_GET, 'id');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $baremacion = new Baremacion(null, $idConvocatorias, $id, $email, $telefono);
    if ($baremacionRepository->createBaremaciones($baremacion)) {
        header('Location:../?menu=home&id='.$id);
        exit;
    } else {
        echo "Error al  crear la baremacion. Por favor, inténtalo de nuevo.";
        exit;
    }
}

?>