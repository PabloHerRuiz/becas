<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Fallo la conexion a la base de datos']);
    exit;
}

Sesion::iniciar_sesion();
$user = Sesion::leer_sesion("usuario");

$baremacionRepository = new baremacionRepository($conn);
if (!empty($_GET['id'])) {
    $id = Validator::validateInput(INPUT_GET, 'id');
}
if (!empty($_GET['idConvocatorias'])) {
    $idConvocatorias = Validator::validateInput(INPUT_GET, 'idConvocatorias');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // validamos y recogemos los datos de los id items baremables y el valor de la nota
    if (!isset($_POST['idItem'], $_POST['valor']) || empty($_POST['idItem']) || empty($_POST['valor'])) {
        exit('Datos de baremación no proporcionados o inválidos.');
    }

    // validamos y recogemos los datos de los id items baremables y el valor de la nota
    try {
        Validator::validatePostArray($_POST['idItem']);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $idItems = $_POST['idItem'];

    try {
        Validator::validatePostArray($_POST['valor']);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $valor = $_POST['valor'];

    //creamos la baremacion
    for ($i = 0; $i < count($idItems); $i++) {
        if ($valor[$i] == "") {
            continue;
        }
        $baremacion = new Baremacion(null, $idConvocatorias, $id, $idItems[$i], null, $valor[$i]);

        // Compruebamos si ya existe la baremacion
        $existeBaremacion = $baremacionRepository->getBaremacionesById($id, $idConvocatorias, $idItems[$i]);

        try {
            if ($existeBaremacion) {
                //actualizamos si existe
                $baremacionRepository->updateBaremaciones($baremacion);
            } else {
                //creamos si no existe
                $baremacionRepository->createBaremaciones($baremacion);
            }
        } catch (Exception $e) {
            echo "Error al actualizar o crear la baremación: " . $e->getMessage();
        }
    }

    header('Location:../?menu=bare&rol=' . $user->getRol() . '&id=' . $user->getIdCandidato());

} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $baremacion = $baremacionRepository->getIdItemNota($id, $idConvocatorias);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Fallo al cargar baremacion']);
        exit;
    }
    if ($baremacion) {
        header('Content-Type: application/json');
        echo json_encode($baremacion);
    } else {
        http_response_code(404);
        echo json_encode(["mensaje" => "No hay baremaciones cargadas"]);
    }


}

?>