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
$login = new login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = Validator::validateInput(INPUT_POST, 'username');
    $password = Validator::validateInput(INPUT_POST, 'password');

    $candidato = $candidatoRepository->login($nombre, $password);

    if ($candidato) {
        if ($login->user_login($candidato)) {
            if ($candidato->getRol() == 'admin') {
                header('Location:../?menu=home&rol=' . $candidato->getRol(). '&id=' . $candidato->getIdCandidato());
                exit;
            } else {
                header('Location:../?menu=home&id=' . $candidato->getIdCandidato());
                exit;
            }
        } else {
            echo "Error al iniciar sesión. Por favor, inténtalo de nuevo.";
            exit;
        }
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
        exit;
    }
}
?>