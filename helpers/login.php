<?php
class Login
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }
    //funcion que inicia sesion del usuario
    public function user_login($candidato)
    {
        if ($candidato != null) {
            // Verificar la contraseña
            if (password_verify($_POST['password'], $candidato->getPassword())) {
                // Inicio de sesión exitoso
                $candi = new Candidato($candidato->getNombre(), $candidato->getApellidos(), $candidato->getDni(),$candidato->getPassword(),$candidato->getCurso(),$candidato->getCorreo(),$candidato->getTelefono(),$candidato->getDomicilio(),$candidato->getFechaNacimiento(),$candidato->getTutor(), $candidato->getRol(), $candidato->getIdCandidato());
                Sesion::login_sesion($candi);
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