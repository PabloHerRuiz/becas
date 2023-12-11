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

if (!empty($_GET['idConvocatorias'])) {
    $idConvocatorias = Validator::validateInput(INPUT_GET, 'idConvocatorias');
}
if (!empty($_GET['id'])) {
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
    $pdf_files = array();

    // Verifica si se han cargado archivos
    if (!empty($_FILES)) {

        foreach ($_FILES as $key => $file) {
            $fichero_nombre_pdf = $file['name'];
            $fichero_tipo_pdf = $file['type'];

            // Verificar si es un PDF
            if (strpos($fichero_tipo_pdf, 'pdf') !== false) {
                $fichero_subido = $dir_pdfs . basename($fichero_nombre_pdf);
                $fichero_temporal = $file['tmp_name'];

               
                if (move_uploaded_file($fichero_temporal, $fichero_subido)) {
                    
                    $pdf_files[$key] = $fichero_nombre_pdf;
                } else {
                    echo "Hubo un error al cargar el archivo $fichero_nombre_pdf.\n";
                }
            }
        }
    }

    // Convierte el array a una cadena JSON
    $pdf_files_str = json_encode($pdf_files);

    $candidato_convocatoria = new Candidato_convocatorias($id, $idConvocatorias, $nombre, $apellidos, $email, $curso, $domicilio, $dni, $telefono, null, $pdf_files_str);
    if ($candidato_convocatoriaRepository->checkConvo($id, $idConvocatorias)) {
        echo json_encode(["error" => "Ya has enviado una solicitud a esta convocatoria."]);
        exit;
    } else if ($candidato_convocatoriaRepository->createCandidato_convocatorias($candidato_convocatoria)) {
        header('Location:../?menu=home&id=' . $id);
        exit;
    } else {
        echo "Error al  crear la solicitud. Por favor, inténtalo de nuevo.";
        exit;
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['comprobacion'])) {
        echo json_encode($candidato_convocatoriaRepository->checkConvo($id, $idConvocatorias));   
    } else  {
        try{
            $convocatorias=$candidato_convocatoriaRepository->getAllSoliById($id);
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
}

?>