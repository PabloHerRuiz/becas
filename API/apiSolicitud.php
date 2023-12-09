<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Fallo la conexion a la base de datos']);
    exit;
}

$candidato_convocatoriaRepository = new $candidato_convocatoriaRepository($conn);
$idConvocatorias = Validator::validateInput(INPUT_GET, 'idConvocatorias');
$id = Validator::validateInput(INPUT_GET, 'id');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = Validator::validateInput(INPUT_POST, 'dni');
    $nombre = Validator::validateInput(INPUT_POST, 'nombre');
    $apellidos = Validator::validateInput(INPUT_POST, 'apellidos');
    $email = Validator::validateInput(INPUT_POST, 'email');
    $telefono = Validator::validateInput(INPUT_POST, 'telefono');
    $domicilio = Validator::validateInput(INPUT_POST, 'domicilio');
    $curso = Validator::validateInput(INPUT_POST, 'curso');

    //guardar PDF
    $dir_pdfs = '../pdfs/';
    //pdfs
    $fichero_nombre_pdf = $_FILES['cv']['name'];
    $fichero_tipo_pdf = $_FILES['cv']['type'];

    // Verificar si es un PDF
    if (strpos($fichero_tipo_pdf, 'pdf') !== false) {
        $fichero_subido = $dir_pdfs . basename($fichero_nombre_pdf);
        $fichero_temporal = $_FILES['cv']['tmp_name'];
    }

    // Mover archivo a la carpeta correspondiente
    if (move_uploaded_file($fichero_temporal, $fichero_subido)) {
        echo "El archivo se ha cargado correctamente.";
    } else {
        echo "Hubo un error al cargar el archivo.";
    }

    $candidato_convocatoria = new Candidato_convocatorias($id, $idConvocatorias, $nombre, $apellidos, $email, $curso, $domicilio, $dni, $telefono);
    if ($candidato_convocatoriaRepository->createCandidato_convocatorias($candidato_convocatoria)) {
        header('Location:../?menu=home&id=' . $id);
        exit;
    } else {
        echo "Error al  crear la solicitud. Por favor, inténtalo de nuevo.";
        exit;
    }
}

?>