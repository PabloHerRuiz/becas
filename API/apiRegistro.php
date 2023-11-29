<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';


$conn = db::abreconexion();
$candidatoRepository = new candidatoRepository($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = Validator::validateInput(INPUT_POST, 'dni');
    $nombre = Validator::validateInput(INPUT_POST, 'nombre');
    $password = Validator::validateInput(INPUT_POST, 'pass');
    $correo = Validator::validateInput(INPUT_POST, 'correo');

    $password = password_hash($password, PASSWORD_DEFAULT);

    $candidato = new Candidato($nombre, null, $dni, $password, null, $correo,null,null,null,null,"alumno",null);

    $errores = Validator::validateCandidato($candidato);
    // Si hay errores, manejarlos
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo $error . "\n";
        }
        die();
    }

    if ($candidatoRepository->createCandidato($candidato)) {
        header('Location:../?menu=login');
        exit;
    } else {
        echo "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
        exit;
    }
}

?>