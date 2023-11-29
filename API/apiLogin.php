<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';


$conn = db::abreconexion();
$candidatoRepository = new candidatoRepository($conn);
$login = new login($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = Validator::validateInput(INPUT_POST, 'username');
        $password = Validator::validateInput(INPUT_POST, 'password');

        $candidato = $candidatoRepository->login($nombre, $password);

        if ($candidato) {
            if ($login->user_login($candidato)) {
                header('Location:../?menu=home');
                exit;
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