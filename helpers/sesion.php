<?php
class Sesion
{
    //inicia sesion
    public static function iniciar_sesion()
    {
        session_start();
    }
    //destruye la sesion
    public static function cerrar_session()
    {
        session_destroy();
    }

    //guarda una sesion por su clave valor
    public static function guardar_sesion($clave, $valor)
    {
        $_SESSION[$clave] = $valor;
    }

    //muestra un valor segun su clave
    public static function leer_sesion($clave)
    {
        if (isset($_SESSION[$clave])) {
            return $_SESSION[$clave];
        } else {
            return "";
        }

    }
    //borrar clave valor
    public static function borrarClave($clave){
        unset($_SESSION[$clave]);
    }

    //comprueba si existe valor
    public static function esta_logueado()
    {
        return isset($_SESSION['usuario']);
    }

    //inicia y guarda el valor
    public static function login_sesion($valor)
    {
        self::iniciar_sesion();
        self::guardar_sesion('usuario', $valor);
    }

}
?>