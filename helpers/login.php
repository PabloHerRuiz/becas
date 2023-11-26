<?php
class Login
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }
    //funcion que inicia sesion del usuario
    public function user_login($usuario)
    {
        if ($usuario != null) {
            // Verificar la contraseña
            if (password_verify($_POST['password'], $usuario->getPassword())) {
                // Inicio de sesión exitoso
                $user = new Usuario($usuario->getNombre(), $usuario->getApellidos(), $usuario->getEmail(),$usuario->getPassword(), $usuario->getRol(), $usuario->getIdUser());
                Sesion::login_sesion($user);
                return true;
            } else {
                // Contraseña incorrecta
                return false;
            }
        } else {
            // Usuario no existe
            return false;
        }
    }

    //funcion que cierra la sesion del usuario
    public function user_logout()
    {

    }
}
?>