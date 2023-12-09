<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';

try {
    $conn = db::abreconexion();
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Fallo la conexion a la base de datos']);
    exit;
}

$candidato_convocatoriaRepository = new candidato_convocatoriaRepository($conn);
if(!empty($_GET['idConvocatorias'])){
    $idConvocatorias = Validator::validateInput(INPUT_GET, 'idConvocatorias');
}
if(!empty($_GET['id'])){
    $id = Validator::validateInput(INPUT_GET, 'id');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = Validator::validateInput(INPUT_POST, 'dni');
    $nombre = Validator::validateInput(INPUT_POST, 'nombre');
    $apellidos = Validator::validateInput(INPUT_POST, 'apellidos');
    $email = Validator::validateInput(INPUT_POST, 'email');
    $telefono = Validator::validateInput(INPUT_POST, 'telefono');
    $domicilio = Validator::validateInput(INPUT_POST, 'domicilio');
    $curso = Validator::validateInput(INPUT_POST, 'curso');

    //guardar PDF
    $dir_pdfs = '../pdf/';

    // Inicializa un array para almacenar los nombres de los archivos PDF
    $pdf_files = [];

    // Itera sobre cada archivo en $_FILES
    foreach ($_FILES['cv']['name'] as $key => $name) {
        $fichero_nombre_pdf = $name;
        $fichero_tipo_pdf = $_FILES['cv']['type'][$key];

        // Verificar si es un PDF
        if (strpos($fichero_tipo_pdf, 'pdf') !== false) {
            $fichero_subido = $dir_pdfs . basename($fichero_nombre_pdf);
            $fichero_temporal = $_FILES['cv']['tmp_name'][$key];

            // Mover archivo a la carpeta correspondiente
            if (move_uploaded_file($fichero_temporal, $fichero_subido)) {
                $pdf_files[] = $fichero_nombre_pdf;
            } else {
                echo "Hubo un error al cargar el archivo $fichero_nombre_pdf.\n";
            }
        }
    }

    // Une los nombres de los archivos PDF en una sola cadena, separada por comas
    $pdf_files_str = implode(',', $pdf_files);

    $candidato_convocatoria = new Candidato_convocatorias($id, $idConvocatorias, $nombre, $apellidos, $email, $curso, $domicilio, $dni, $telefono, null, $pdf_files_str);
    if ($candidato_convocatoriaRepository->createCandidato_convocatorias($candidato_convocatoria)) {
        header('Location:../?menu=home&id=' . $id);
        exit;
    } else {
        echo "Error al  crear la solicitud. Por favor, inténtalo de nuevo.";
        exit;
    }
}

?>