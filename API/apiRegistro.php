<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/helpers/autocargador.php';


$conn = db::abreconexion();
$usuarioRepository = new UsuariosRepository($conn);

if ($_SESSION['REQUEST_METHOD'] == 'POST') {
    if ($_POST['accion'] == 'registro') {
        $nombre = Validator::validateInput(INPUT_POST, 'nombre');
        $apellidos = Validator::validateInput(INPUT_POST, 'apellidos');
        $correo = Validator::validateInput(INPUT_POST, 'correo');
        $password = Validator::validateInput(INPUT_POST, 'pass');

        $password = password_hash($password, PASSWORD_DEFAULT);

        $usuario = new Usuario($nombre, $apellidos, $correo, $password);

        $errores = Validator::validateUsuario($usuario);
        // Si hay errores, manejarlos
        if (!empty($errores)) {
            foreach ($errores as $error) {
                echo $error . "\n";
            }
            die();
        }

        if ($usuarioRepository->addUsuario($usuario)) {
            header('Location:?menu=login');
            exit;
        } else {
            echo "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
            exit;
        }
    }



}



?>